<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $data = [
            'user' => $this->user::all(),
        ];
        $content = [
            'title' => 'Table Kategori',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Table Kategori',
            'button_create' => 'Create Kategori',
        ];
        return view('admin.pages.master.kategori.index', $content, $data);
    }

    public function create()
    {
        $content = [
            'title' => 'Create Kategori',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_active' => 'Create Kategori',
        ];
        return view('admin.pages.master.kategori.create', $content);
    }
}
