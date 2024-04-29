<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CallbackController extends Controller
{
    protected $serverKey, $transaksi;

    public function __construct()
    {
        $this->serverKey = config("xendit.xendit_key");
        $this->transaksi = new Transaksi();
    }

    public function postCallback(Request $request)
    {
        try {

            DB::beginTransaction();

            $reqHeaders = $request->header('x-callback-token');
            $xIncomingCallbackTokenHeader = isset($reqHeaders) ? $reqHeaders : "";

            if ($xIncomingCallbackTokenHeader) {
                if ($request->status == 'PAID' || $request->status == 'SETTLED') {
                    $transaksi = $this->transaksi->where("xenditId", $request->id)->first();

                    $transaksi["tipeTransaksi"] = "TRANSFER";
                    $transaksi["statusOrder"] = $request->status;
                    $transaksi["paymentChannel"] = $request->payment_channel;
                    $transaksi->update();
                }
            }

            DB::commit();

            return response()->json([
                "status" => true,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false
            ]);
        }
    }
}
