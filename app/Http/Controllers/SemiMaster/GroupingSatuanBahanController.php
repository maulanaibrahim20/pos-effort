<?php

namespace App\Http\Controllers\SemiMaster;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\GroupingSatuanBahan;
use App\Models\SatuanBahan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class GroupingSatuanBahanController extends Controller
{
    protected $groupingBahan;
    protected $satuanBahan;
    protected $bahan;

    public function __construct(GroupingSatuanBahan $groupingBahan, SatuanBahan $satuanBahan, Bahan $bahan)
    {
        $this->groupingBahan = $groupingBahan;
        $this->satuanBahan = $satuanBahan;
        $this->bahan = $bahan;
    }

    public function index()
    {
        $content = [
            'titleCreate' => 'Tambah Data Grouping Satuan Bahan',
            'title' => 'Table Grouping Satuan Bahan',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Table Grouping Satuan Bahan',
            'button_create' => 'Tambah Grouping Satuan Bahan',
        ];
        $data = [
            'groupingBahan' => $this->groupingBahan::all(),
            'bahan' => $this->bahan::orderBy('namaBahan', 'asc')->get(),
            'satuanBahan' => $this->satuanBahan::orderBy('satuanBahan', 'asc')->get(),
        ];
        return view('super_admin.pages.semi_master.grouping_satuan_bahan.index', $data, $content);
    }

    public function store(Request $request)
    {
        try {
            $messages = [
                'satuanBahan.required' => 'Satuan Bahan harus diisi.',
                'satuanBahan.string' => 'Satuan Bahan harus berupa teks.',
                'bahan.required' => 'Bahan harus diisi.',
                'bahan.string' => 'Bahan harus berupa teks.',
            ];

            $request->validate([
                'satuanBahan' => 'required|string',
                'bahan' => 'required|string',
            ], $messages);

            DB::beginTransaction();
            $this->groupingBahan->create([
                'satuanBahanId' => $request->satuanBahan,
                'bahanId' => $request->bahan,
            ]);

            DB::commit();
            Alert::success('succes', 'Success Data Grouping Satuan Bahan Berhasil Ditambahkan!');
            return back()->with('succes', 'Success Data Grouping Satuan Bahan Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'error Data Grouping Satuan Bahan Gagal Ditambahkan!' . $e->getMessage());
            return back()->with('error', 'Error Data Grouping Bahan Gagal Ditambahkan!' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = [
            'edit' => $this->groupingBahan->where("id", $id)->first(),
            'bahan' => $this->bahan::orderBy('namaBahan', 'asc')->get(),
            'satuanBahan' => $this->satuanBahan::orderBy('satuanBahan', 'asc')->get(),
        ];

        return view('super_admin.pages.semi_master.grouping_satuan_bahan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $messages_modal = [
            'satuanBahan_modal.required' => 'Satuan Bahan harus diisi.',
            'satuanBahan_modal.string' => 'Satuan Bahan harus berupa teks.',
            'bahan_modal.required' => 'Bahan harus diisi.',
            'bahan_modal.string' => 'Bahan harus berupa teks.',
        ];

        $request->validate([
            'satuanBahan_modal' => 'required|string',
            'bahan_modal' => 'required|string',
        ], $messages_modal);

        try {
            DB::beginTransaction();
            $groupingBahan = $this->groupingBahan::find($id);
            $groupingBahan->update([
                'satuanBahanId' => $request->satuanBahan_modal,
                'bahanId' => $request->bahan_modal,
            ]);

            DB::commit();
            Alert::success('succes', 'Success Data Grouping Kategori Berhasil Diubah!');
            return back()->with('succes', 'Success Data Grouping Kategori Berhasil Diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'error Data Grouping Kategori Gagal Diubah!' . $e->getMessage());
            return back()->with('error', 'Error Data Grouping Kategori Gagal Diubah!' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->groupingBahan::find($id)->delete();
            DB::commit();
            Alert::success('succes', 'Success Data Grouping Satuan Bahan Berhasil Dihapus!');
            return back()->with('succes', 'Success Data Grouping Satuan Bahan Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'error Data Grouping Satuan Bahan Gagal Dihapus!' . $e->getMessage());
            return back()->with('error', 'Error Data Grouping Satuan Bahan Gagal Dihapus!' . $e->getMessage());
        }
    }
}
