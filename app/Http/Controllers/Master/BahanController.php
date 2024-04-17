<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BahanController extends Controller
{
    protected $bahan;

    public function __construct(Bahan $bahan)
    {
        $this->bahan = $bahan;
    }
    public function index()
    {
        $content = [
            'titleCreate' => 'Tambah Data Bahan',
            'title' => 'Table Bahan',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Bahan',
        ];
        $data = [
            'bahan' => $this->bahan::all(),
        ];
        return view('super_admin.pages.master.bahan.index', $content, $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageExtension = $request->file('foto')->getClientOriginalExtension();
            $newImageName = 'thumbnail_' . (count(File::files(public_path('bahan_thumbnail'))) + 1) . '.' . $imageExtension;
            $imagePath = 'bahan_thumbnail/' . $newImageName;

            $request->file('foto')->move(public_path('bahan_thumbnail'), $newImageName);

            $this->bahan->create([
                'namaBahan' => $request->nama,
                'slugBahan' => Str::slug($request->nama),
                'fotoBahan' => $imagePath,
            ]);

            DB::commit();
            Alert::success('success', 'Success Bahan Berhasil Ditambahkan!');
            return back()->with('success', 'Success Bahan Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Gagal Menambahkan Bahan' . $e->getMessage());
            return back()->with('error', 'Gagal Menambahkan Bahan' . $e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        $data["edit"] = $this->bahan->where("id", $id)->first();

        return view('super_admin.pages.master.bahan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $bahan = $this->bahan::find($id);

            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if (File::exists(public_path($bahan->fotoBahan))) {
                    File::delete(public_path($bahan->fotoBahan));
                }

                $imageExtension = $request->file('foto')->getClientOriginalExtension();
                $newImageName = 'thumbnail_' . (count(File::files(public_path('bahan_thumbnail'))) + 1) . '.' . $imageExtension;
                $imagePath = 'bahan_thumbnail/' . $newImageName;
                $request->file('foto')->move(public_path('bahan_thumbnail'), $newImageName);

                $bahan->fotoBahan = $imagePath;
            }

            $bahan->namaBahan = $request->nama;
            $bahan->slugBahan = Str::slug($request->nama);
            $bahan->save();

            DB::commit();
            Alert::success('success', 'Bahan Berhasil Diperbarui!');
            return back()->with('success', 'Bahan Berhasil Diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Gagal Memperbarui Bahan: ' . $e->getMessage());
            return back()->with('error', 'Gagal Memperbarui Bahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $bahan = $this->bahan::find($id);
            if (!$bahan) {
                throw new \Exception('Data Bahan tidak ditemukan');
            }

            $imagePath = $bahan->fotoBahan;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            $bahan->delete();
            DB::commit();
            Alert::success('success', 'Data Bahan Berhasil Dihapus!');
            return redirect('/super_admin/master/bahan')->with('success', 'Data Bahan Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('error', 'Terjadi Kesalahan, silahkan coba lagi' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
}
