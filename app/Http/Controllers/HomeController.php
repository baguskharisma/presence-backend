<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    // Fungsi untuk menampilkan halaman home.
    public function index(){
        // Mengembalikan view dengan nama home.
        return view('home');
    }
}
