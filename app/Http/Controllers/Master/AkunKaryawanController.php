<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AkunKaryawanController extends Controller
{
    protected $user, $karyawan;

    public function __construct()
    {
        $this->user = new User();
        $this->karyawan = new Karyawan();
    }

    public function index()
    {
        $content = [
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Kelola Karyawan',
            'title' => 'Karyawan',
            'titleCreate' => 'Tambah Data Karyawan',
            'button_create' => 'Tambah Data Karyawan',
        ];
        $data = [
            'karyawan' => $this->karyawan::where('mitraId', Auth::user()->mitra->id)->get(),
        ];
        return view('admin.pages.master.karyawan.index', $data, $content);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $imageExtension = $request->file('fotoKaryawan')->getClientOriginalExtension();
            $newImageName = 'karyawan' . (count(File::files(public_path('karyawan_image'))) + 1) . '.' . $imageExtension;
            $imagePath = 'karyawan_image/' . $newImageName;

            $request->file('fotoKaryawan')->move(public_path('karyawan_image'), $newImageName);

            $user = $this->user->create([
                'nama' => $request->namaKaryawan,
                'username' => $request->namaKaryawan,
                'email' => $request->emailKaryawan,
                'password' => Hash::make($request->password),
                'akses' => 3,
                'foto' => $imagePath,
            ]);
            $this->karyawan->create([
                'mitraId' => Auth::user()->mitra->id,
                'userId' => $user['id'],
                'alamat' => $request->alamatKaryawan,
                'nomorHpAktif' => $request->noTelpKaryawan,
            ]);

            DB::commit();
            Alert::success('success', 'Success Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Berhasil Ditambahkan!');
            return back()->with('success', 'Succes Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Error Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Gagal Ditambahkan!' . $e->getMessage());
            return back()->with('Error Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Gagal Ditambahkan!');
        }
    }

    public function edit($id)
    {
        $data["edit"] = $this->karyawan->where("id", $id)->first();

        return view('admin.pages.master.karyawan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $karyawan = $this->karyawan::findOrFail($id);
            if ($request->hasFile('fotoKaryawan')) {
                if (File::exists(public_path($karyawan->user->foto))) {
                    File::delete(public_path($karyawan->user->foto));
                }
                $imageExtension = $request->file('fotoKaryawan')->getClientOriginalExtension();
                $newImageName = 'karyawan_' . (count(File::files(public_path('karyawan_image'))) + 1) . '.' . $imageExtension;
                $imagePath = 'karyawan_image/' . $newImageName;
                $request->file('fotoKaryawan')->move(public_path('karyawan_image'), $newImageName);

                $karyawan->user->foto = $imagePath;
            }
            $karyawan->update([
                'alamat' => $request->alamatKaryawan,
                'nomorHpAktif' => $request->noTelpKaryawan,
            ]);
            $karyawan->user->update([
                'nama' => $request->namaKaryawan,
                'username' => $request->namaKaryawan,
                'email' => $request->emailKaryawan,
            ]);

            DB::commit();

            Alert::success('success', 'Success Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Berhasil Diubah!');
            return back()->with('success', 'Success Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Berhasil Diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Error Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Gagal Diubah!' . $e->getMessage());
            return back()->with('error', 'Error Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Gagal Diubah!');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $karyawan = $this->karyawan::find($id);
            if ($karyawan) {
                if (File::exists(public_path($karyawan->user->foto))) {
                    File::delete(public_path($karyawan->user->foto));
                }
                $karyawan->delete();
                $karyawan->user->delete();
                DB::commit();
                Alert::success('success', 'Success Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Berhasil Dihapus!');
                return back()->with('success', 'Success Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Berhasil Dihapus!');
            } else {
                throw new \Exception('Data Karyawan tidak ditemukan.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Error Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Gagal Dihapus!' . $e->getMessage());
            return back()->with('error', 'Error Data Karyawan Untuk ' . Auth::user()->mitra->namaMitra . ' Gagal Dihapus!');
        }
    }
}
