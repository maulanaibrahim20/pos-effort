<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        $data = [
            "produk" => Produk::where("status", 1)->get()
        ];

        return view("landing-page.home", $data);
    }

    public function landingPage()
    {
        return view("landing-page.main");
    }
}
