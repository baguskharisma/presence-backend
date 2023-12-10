<?php

namespace App\Http\Controllers;

// Impor model yang ingin digunakan.
use App\Models\Presence;
use App\Models\Permission;

class HistoryController extends Controller
{
    // Fungsi untuk menampilkan halaman history.
     public function history(){
        // Variabel untuk menyimpan id pengguna yang sedang terautentikasi.
        $userId = auth()->user()->id;
        // Variabel untuk menyimpan name pengguna yang sedang terautentikasi.
        $username = auth()->user()->name;
        // Variabel untuk menyimpan data dari model Presence yang memiliki nilai dari kolom user_id sama dengan nilai dari variabel $userId.
        $presence = Presence::where('user_id', $userId)->get();
        // Variabel untuk menyimpan data dari model Permission yang memiliki nilai dari kolom name sama dengan nilai dari variabel $username.
        $permission = Permission::where('name', $username)->get();

        // Mengembalikan view dengan nama history.
        return view('history', [
            // Sematkan data ke dalam view.
            'presences' => $presence,
            'permissions' => $permission
        ]);
    }
}
