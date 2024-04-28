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
            return redirect(route('login.index'))->with('error', 'Periksa kembali Email Dan Password Anda!');
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Maaf Password Anda Salah!');
        }
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $request->session()->regenerate();

            if ($user->akses == 1) {
                return redirect()->to('/super_admin/dashboard')->with('success', 'Anda Berhasil Login Selamat Datang' . Auth::user()->name);
            } elseif ($user->akses == 2) {
                return redirect('/pelanggan/home');
            }
        }
        return back()->with('error', 'Gagal melakukan autentikasi');
    }
}
