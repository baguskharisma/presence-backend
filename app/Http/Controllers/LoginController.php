<?php

namespace App\Http\Controllers;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

// Impor facade Auth.
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk menampilkan halaman login.
    public function index(){
        // Mengembalikan view dengan nama login.
        return view('login');
    }

    // Fungsi untuk login pengguna.
    public function authenticate(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        // Kondisi untuk mengautentikasi pengguna.
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            // Arahkan pengguna ke URI yang diminta pengguna sebelum diarahkan ke halaman login.
            return redirect()->intended('/');
        }

        // Kondisi jika autentikasi gagal
        return back()->with('loginError', 'Login Failed!');

    }

    // Fungsi untuk logout pengguna.
    public function logout(Request $request){
        // Metode untuk mengeluarkan pengguna yang saat ini terautentikasi.
        Auth::logout();
        
        // Akhiri sesi pengguna yang saat ini terautentikasi.
        $request->session()->invalidate();
        
        // Perbarui token sesi pengguna.
        $request->session()->regenerateToken();
        
        // Arahkan pengguna kembali ke halaman utama.
        return redirect('/');
    }
}
