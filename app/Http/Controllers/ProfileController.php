<?php

namespace App\Http\Controllers;

// Impor model yang ingin digunakan.
use App\Models\User;

class ProfileController extends Controller
{
    // Fungsi untuk menampilkan halaman profile.
    public function index(){
        // Variabel untuk menyimpan data id pengguna yang saat ini terautentikasi.
        $userId = auth()->user()->id;
        // Variabel untuk mendapatkan dan menyimpan data dari model User berdasarkan nilai dari kolom id yang memiliki nilai yang sama dengan nilai dari variabel $userId.
        $user = User::where('id', $userId)->get();

        // Mengembalikan view dengan nama profile.
        return view('profile', [
            // Sematkan data ke dalam view.
            'users' => $user
        ]);
    }
}
