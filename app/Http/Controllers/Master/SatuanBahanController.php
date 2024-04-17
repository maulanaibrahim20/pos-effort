<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SatuanBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class SatuanBahanController extends Controller
{
    protected $satuanBahan;

    public function __construct(SatuanBahan $satuanBahan)
    {
        $this->satuanBahan = $satuanBahan;
    }
    public function index()
    {
        $content = [
            'titleCreate' => 'Tambah Data Satuan Bahan',
            'title' => 'Table Satuan Bahan',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Satuan Bahan',
        ];
        $data = [
            'bahan' => $this->satuanBahan::all(),
        ];
        return view('super_admin.pages.master.satuan_bahan.index', $data, $content);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            $this->satuanBahan->create([
                'satuanBahan' => $request->nama,
                'aktif' => '0',
            ]);
            DB::commit();
            Alert::success('success', 'Success Data Satuan Bahan Berhasil Ditambahkan!');
            return redirect()->back()->with('success', 'Success Data Satuan Bahan Berhasil Ditambahkan!');
        } catch (ValidationException $th) {
            DB::rollback();
            Alert::error('error', 'Error Data Satuan Bahan Gagal Ditambahkan!' . $th->validator);
            return back()->with('error', 'Error Data Satuan Bahan Gagal Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Error Data Satuan Bahan Gagal Ditambahkan!' . $e->getMessage());
            return back()->with('error', 'Error Data Satuan Bahan Gagal Ditambahkan!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
            $satuanBahan = $this->satuanBahan::find($id);
            if ($satuanBahan) {
                $satuanBahan->update([
                    'satuanBahan' => $request->nama,
                ]);
                Alert::success('Berhasil', 'Data Satuan Bahan berhasil diubah.');
                return back()->with('success', 'Data Satuan Bahan berhasil diubah.');
            } else {
                throw new \Exception('Satuan Bahan tidak ditemukan.');
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengubah Satuan Bahan: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengubah Satuan Bahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $satuanBahan = $this->satuanBahan::find($id);
            if ($satuanBahan) {
                $satuanBahan->delete();
                DB::commit();
                Alert::success('Berhasil', 'Data Satuan Bahan berhasil dihapus.');
                return back()->with('success', 'Data Satuan Bahan berhasil dihapus.');
            } else {
                throw new \Exception('Satuan Bahan tidak ditemukan.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Gagal menghapus Satuan Bahan: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus Satuan Bahan: ' . $e->getMessage());
        }
    }

    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $satuanBahan = $this->satuanBahan::find($id);
            if ($satuanBahan) {
                $satuanBahan->aktif = $satuanBahan->aktif == '0' ? '1' : '0';
                $satuanBahan->save();
                DB::commit();
                Alert::success('Berhasil', 'Aktif Satuan Bahan berhasil diubah.');
                return back()->with('success', 'Aktif Satuan Bahan berhasil diubah.');
            } else {
                throw new \Exception('Produk tidak ditemukan.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Gagal mengubah status Satuan Bahan: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengubah status Satuan Bahan: ' . $e->getMessage());
        }
    }
}