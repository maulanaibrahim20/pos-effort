<?php

namespace App\Http\Controllers\SemiMaster;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\GroupingKategoriBahan;
use App\Models\KategoriBahan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class GroupingKategoriBahanController extends Controller
{
    protected $groupingBahan;
    protected $kategoriBahan;
    protected $bahan;

    public function __construct(GroupingKategoriBahan $groupingBahan, Bahan $bahan, KategoriBahan $kategoriBahan)
    {
        $this->groupingBahan = $groupingBahan;
        $this->bahan = $bahan;
        $this->kategoriBahan = $kategoriBahan;
    }
    public function index()
    {
        $content = [
            'titleCreate' => 'Tambah Data Grouping Kategori Bahan',
            'title' => 'Table Grouping Kategori Bahan',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Table Grouping Kategori Bahan',
            'button_create' => 'Tambah Grouping Kategori Bahan',
        ];
        $data = [
            'groupingBahan' => $this->groupingBahan::all(),
            'bahan' => $this->bahan::orderBy('namaBahan', 'asc')->get(),
            'kategoriBahan' => $this->kategoriBahan::orderBy('namaKategori', 'asc')->get(),
        ];
        return view('super_admin.pages.semi_master.grouping_kategori_bahan.index', $content, $data);
    }

    public function store(Request $request)
    {
        try {
            $messages = [
                'kategori.required' => 'Kategori harus diisi.',
                'kategori.string' => 'Kategori harus berupa teks.',
                'bahan.required' => 'Bahan harus diisi.',
                'bahan.string' => 'Bahan harus berupa teks.',
            ];

            $request->validate([
                'kategori' => 'required|string',
                'bahan' => 'required|string',
            ], $messages);

            DB::beginTransaction();
            $this->groupingBahan->create([
                'kategoriBahanId' => $request->kategori,
                'bahanId' => $request->bahan,
            ]);

            DB::commit();
            Alert::success('succes', 'Success Data Grouping Kategori Berhasil Ditambahkan!');
            return back()->with('succes', 'Success Data Grouping Kategori Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'error Data Grouping Kategori Gagal Ditambahkan!' . $e->getMessage());
            return back()->with('error', 'Error Data Grouping Bahan Gagal Ditambahkan!' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $messages_modal = [
                'kategori_modal.required' => 'Kategori harus diisi.',
                'kategori_modal.string' => 'Kategori harus berupa teks.',
                'bahan_modal.required' => 'Bahan harus diisi.',
                'bahan_modal.string' => 'Bahan harus berupa teks.',
            ];

            $request->validate([
                'kategori_modal' => 'required|string',
                'bahan_modal' => 'required|string',
            ], $messages_modal);

            DB::beginTransaction();
            $groupingBahan = $this->groupingBahan::find($id);
            $groupingBahan->update([
                'kategoriBahanId' => $request->kategori_modal,
                'bahanId' => $request->bahan_modal,
            ]);

            DB::commit();
            Alert::success('succes', 'Success Data Grouping Kategori Berhasil Diubah!');
            return back()->with('succes', 'Success Data Grouping Kategori Berhasil Diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'error Data Grouping Kategori Gagal Diubah!');
            return back()->with('error', 'Error Data Grouping Kategori Gagal Diubah!');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->groupingBahan::find($id)->delete();
            DB::commit();
            Alert::success('succes', 'Success Data Grouping Kategori Berhasil Dihapus!');
            return back()->with('succes', 'Success Data Grouping Kategori Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'error Data Grouping Kategori Gagal Dihapus!' . $e->getMessage());
            return back()->with('error', 'Error Data Grouping Kategori Gagal Dihapus!' . $e->getMessage());
        }
    }
}
