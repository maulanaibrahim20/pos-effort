<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EditProfileController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        $content = [
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Edit Profile',
            'title' => 'Edit Profile',
        ];
        $data = [
            'user' => User::where('id', Auth::user()->id)->first(),
        ];
        return view('edit_profile.index', $data, $content);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|min:5|max:50',
            'email' => 'required|email|min:5|max:50',
        ]);
        try {
            DB::beginTransaction();
            $user = $this->user::findOrfail($id);
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Profile Berhasil Di Update');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Profile gagal di update');
        }
    }

    public function UpdatePassword(Request $request, $id)
    {
        $request->validate([
            "password" => "required|min:8|max:255|same:konfirmasi_password",
            "konfirmasi_password" => "required|min:8|max:255|same:password",
        ]);
        try {
            $user = $this->user::findOrFail($id);
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->to('/super_admin/profil/user')->with('success', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->to('/super_admin/profil/user')->with('error', 'Password gagal diubah. Error: ' . $e->getMessage());
        }
    }
}
