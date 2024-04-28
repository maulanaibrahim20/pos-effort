<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriBahan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class KategoriBahanController extends Controller
{
    protected $kategoriBahan;

    public function __construct(KategoriBahan $kategoriBahan)
    {
        $this->kategoriBahan = $kategoriBahan;
    }

    public function index()
    {
        $content = [
            'titleCreate' => 'Tambah Data Kategori Bahan',
            'title' => 'Table Kategori',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Table Kategori',
            'button_create' => 'Tambah Kategori',
        ];
        $data = [
            'kategoriBahan' => $this->kategoriBahan::all(),
        ];
        return view('super_admin.pages.master.kategori_bahan.index', $content, $data);
    }

    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama harus diisi.',
            'nama.min' => 'Nama harus memiliki minimal :min karakter.',
            'nama.max' => 'Nama harus memiliki maksimal :max karakter.',
        ];
        $request->validate([
            'nama' => 'required|string|min:5|max:255',
        ], $messages);

        try {
            DB::beginTransaction();
            $this->kategoriBahan->create([
                'namaKategori' => $request->nama,
            ]);
            DB::commit();
            Alert::success('success', 'Success Data Kategori Bahan Berhasil Ditambahkan!');
            return redirect()->back()->with('success', 'Success Data Kategori Bahan Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Error Data Kategori Bahan Gagal Ditambahkan!' . $e->getMessage());
            return redirect()->back()->with('error', 'Error Data Kategori Bahan Gagal Ditambahkan!');
        }
    }

    public function edit(Request $request, $id)
    {
        $data["edit"] = $this->kategoriBahan->where("id", $id)->first();

        return view('super_admin.pages.master.kategori_bahan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $messages_modal = [
            'nama_modal.required' => 'Nama harus diisi Pada Pop Up Input.',
            'nama_modal.min' => 'Nama harus memiliki minimal :min karakter.',
            'nama_modal.max' => 'Nama harus memiliki maksimal :max karakter.',
        ];

        $request->validate([
            'nama_modal' => 'required|string|min:5|max:255',
        ], $messages_modal);

        try {
            DB::beginTransaction();
            $kategoriBahan = $this->kategoriBahan::find($id);
            $kategoriBahan->update([
                'namaKategori' => $request->nama_modal,
            ]);
            DB::commit();
            Alert::success('success', 'Success Kategori Bahan Berhasil Diubah!');
            return back()->with('success', 'Success Kategori Bahan Berhasil Diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Error Kategori Bahan Gagal Ditambahkan!' . $e->getMessage());
            return back()->with('error', 'Error Kategori Bahan Gagal Ditambahkan!');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $kategoriBahan = $this->kategoriBahan::find($id);
            if (!$kategoriBahan) {
                throw new \Exception('Data Kategori Bahan tidak ditemukan');
            }
            $kategoriBahan->delete();
            DB::commit();
            Alert::success('success', 'Data Kategori Bahan Berhasil Dihapus!');
            return back()->with('success', 'Data Kategori Bahan Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Terjadi Kesalahan, silahkan coba lagi' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
}
