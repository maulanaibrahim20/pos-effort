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

    public function proccess(LoginRequest $request)
    {
        $user = $this->user->whereEmail($request->email)->first();
        if (!$user) {
            Alert::error('Maaf Akun Anda Tidak Terdaftar');
            return redirect(route('login.index'))->with('error', 'Maaf Akun Anda Tidak Terdaftar');
        }
        if (!Hash::check($request->password, $user->password)) {
            Alert::error('Maaf Pasword Anda Salah!');
            return back()->with('error', 'Maaf Password Anda Salah!');
        }
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            if ($user->akses == 1) {
                return redirect('/admin/dashboard');
            } elseif ($user->akses == 2) {
                return redirect('/member/home');
            }
        }
        return back()->with('error', 'Gagal melakukan autentikasi');
    }
}
