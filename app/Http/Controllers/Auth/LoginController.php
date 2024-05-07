<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Auth\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        return view('auth.login.index');
    }

    public function proccess(Request $request)
    {
        $user = $this->user->whereEmail($request->email)->first();
        if (!$user) {
            return redirect(route('login.index'))->with('error', 'Periksa kembali Email dan Password Anda!');
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Maaf, Password Anda Salah!');
        }

        if ($user->akses == 2 && $user->active == 0) {
            return back()->with('warning', 'Akun Anda Belum Diaktifkan, Silahkan Hubungi Admin!');
        }

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $request->session()->regenerate();

            if ($user->akses == 1) {
                return redirect()->to('/super_admin/dashboard')->with('success', 'Anda Berhasil Login. Selamat Datang, ' . Auth::user()->name);
            } elseif ($user->akses == 2) {
                return redirect('/admin/dashboard')->with('success', 'Anda Berhasil Login. Selamat Datang, ' . Auth::user()->name);
            } elseif ($user->akses == 3) {
                return redirect('/karyawan/dashboard')->with('success', 'Anda Berhasil Login. Selamat Datang, ' . Auth::user()->name);
            }
        }
        return back()->with('error', 'Gagal melakukan autentikasi');
    }
}
