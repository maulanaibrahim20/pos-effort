<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    protected $produk;

    public function __construct(Product $produk)
    {
        $this->produk = $produk;
    }
    public function index()
    {
        $content = [
            'title' => 'Table Produk',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Table Produk',
            'button_create' => 'Tambah Produk',
        ];
        $data = [
            'produk' => $this->produk->orderBy('nama_produk', 'asc')->get(),
        ];

        return view('super_admin.pages.master.produk.index', $content, $data);
    }

    public function create()
    {
        $content = [
            'title' => 'Tambah Produk',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_1' => 'Produk',
            'breadcrumb_active' => 'Tambah Produk',
        ];
        return view('super_admin.pages.master.produk.create', $content);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageExtension = $request->file('foto')->getClientOriginalExtension();
            $newImageName = 'thumbnail_' . (count(File::files(public_path('produk_thumbnail'))) + 1) . '.' . $imageExtension;
            $imagePath = 'produk_thumbnail/' . $newImageName;

            $request->file('foto')->move(public_path('produk_thumbnail'), $newImageName);

            $this->produk->create([
                'nama_produk' => $request->nama,
                'slug' => Str::slug($request->nama),
                'harga' => $request->harga,
                'foto' => $imagePath,
                'status' => '0',
            ]);

            DB::commit();
            Alert::success('success', 'Success Produk Berhasil Ditambahkan!');
            return redirect('/super_admin/master/produk')->with('success', 'Success Produk Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Gagal Menambahkan Produk' . $e->getMessage());
            return back()->with('error', 'Gagal Menambahkan Produk' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $content = [
            'title' => 'Edit Produk',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_1' => 'Produk',
            'breadcrumb_active' => 'Edit Produk',
        ];
        $data = [
            'produk' => $this->produk::find($id),
        ];
        return view('super_admin.pages.master.produk.edit', $data, $content);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $produk = $this->produk::find($id);

            $request->validate([
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if (File::exists(public_path($produk->foto))) {
                    File::delete(public_path($produk->foto));
                }

                $imageExtension = $request->file('foto')->getClientOriginalExtension();
                $newImageName = 'thumbnail_' . (count(File::files(public_path('produk_thumbnail'))) + 1) . '.' . $imageExtension;
                $imagePath = 'produk_thumbnail/' . $newImageName;
                $request->file('foto')->move(public_path('produk_thumbnail'), $newImageName);

                $produk->foto = $imagePath;
            }

            $produk->nama_produk = $request->nama;
            $produk->harga = $request->harga;
            $produk->slug = Str::slug($request->nama);
            $produk->save();

            DB::commit();
            Alert::success('success', 'Produk Berhasil Diperbarui!');
            return redirect('/super_admin/master/produk')->with('success', 'Produk Berhasil Diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Gagal Memperbarui Produk: ' . $e->getMessage());
            return back()->with('error', 'Gagal Memperbarui Produk: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $produk = $this->produk::find($id);
            if (!$produk) {
                throw new \Exception('Data Kategori tidak ditemukan');
            }
            $produk->delete();
            DB::commit();
            Alert::success('success', 'Data Kategori Berhasil Dihapus!');
            return redirect('/super_admin/master/produk')->with('success', 'Data Kategori Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Terjadi Kesalahan, silahkan coba lagi' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $produk = $this->produk::find($id);
            if ($produk) {
                $produk->status = $produk->status == '0' ? '1' : '0';
                $produk->save();
                DB::commit();
                Alert::success('Berhasil', 'Status produk berhasil diubah.');
                return redirect('/super_admin/master/produk')->with('success', 'Status produk berhasil diubah.');
            } else {
                throw new \Exception('Produk tidak ditemukan.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Gagal mengubah status produk: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengubah status produk: ' . $e->getMessage());
        }
    }
}
