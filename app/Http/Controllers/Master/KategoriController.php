<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class KategoriController extends Controller
{
    protected $kategori;
    public function __construct(Kategori $kategori)
    {
        $this->kategori = $kategori;
    }
    public function index()
    {
        $data = [
            'kategori' => $this->kategori::all(),
        ];
        $content = [
            'title' => 'Table Kategori',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Table Kategori',
            'button_create' => 'Create Kategori',
        ];
        return view('super_admin.pages.master.kategori.index', $content, $data);
    }

    public function create()
    {
        $content = [
            'title' => 'Create Kategori',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_1' => 'Kategori',
            'breadcrumb_active' => 'Create Kategori',
        ];
        return view('super_admin.pages.master.kategori.create', $content);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();
            $this->kategori->create([
                'nama_kategori' => $request->nama,
            ]);
            DB::commit();
            Alert::success('success', 'Data Kategori Berhasil Ditambahkan!');
            return redirect('/super_admin/master/kategori')->with('success', 'Data Kategori Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Terjadi Kesalahan, silahkan coba lagi' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $content = [
            'title' => 'Edit Kategori',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_1' => 'Kategori',
            'breadcrumb_active' => 'Edit Kategori',
        ];
        $data = [
            'kategori' => $this->kategori->find($id),
        ];
        return view('super_admin.pages.master.kategori.edit', $content, $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();
            $kategori = $this->kategori::find($id);
            $kategori->update([
                'nama_kategori' => $request->nama,
            ]);
            DB::commit();
            Alert::success('success', 'Data Kategori Berhasil Diubah!');
            return redirect('/super_admin/master/kategori')->with('success', 'Data Kategori Berhasil Diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Terjadi Kesalahan, silahkan coba lagi' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $kategori = $this->kategori::find($id);
            if (!$kategori) {
                throw new \Exception('Data Kategori tidak ditemukan');
            }
            $kategori->delete();
            DB::commit();
            Alert::success('success', 'Data Kategori Berhasil Dihapus!');
            return redirect('/super_admin/master/kategori')->with('success', 'Data Kategori Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Terjadi Kesalahan, silahkan coba lagi' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
}
