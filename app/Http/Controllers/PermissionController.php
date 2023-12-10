<?php

namespace App\Http\Controllers;

// Impor model yang ingin digunakan.
use App\Models\Permission;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

// Impor kelas Carbon untuk mengakses metode untuk manipulasi waktu dan tanggal.
use Carbon\Carbon;

class PermissionController extends Controller
{
    // Fungsi untuk menampilkan halaman permission.
    public function index(){
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model Permission.
        $permission = Permission::all();

        // Mengembalikan view dengan nama permission.
        return view('permission', [
            // Sematkan data ke dalam view.
            'permissions' => $permission
        ]);
    }
    
    // Fungsi untuk menampilkan halaman create-permission.
    public function createPermission(){
        // Variabel untuk menyimpan instance dari model User yang saat ini terautentikasi.
        $employee = auth()->user();

        // Mengembalikan view dengan nama create-permission.
        return view('permission.create-permission', [
            // Sematkan data ke dalam view.
            'employee' => $employee
        ]);
    }

    // Fungsi untuk membuat Izin.
    public function storePermission(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'name' => 'required',
            'from_when' => 'required',
            'to_when' => 'required',
            'submission_date' => 'required',
            'description' => 'required'
        ]);

        // Buat dan simpan instance baru dari model User ke dalam database.
        Permission::create([
            'name' => $request->name,
            'from_when' => Carbon::parse($request->from_when)->format('j F Y'),
            'to_when' => Carbon::parse($request->to_when)->format('j F Y'),
            'submission_date' => $request->submission_date,
            'description' => $request->description
        ]);

        // Arahkan pengguna ke URI permission.
        return redirect('permission');
    }

    // Fungsi untuk menampilkan halaman manage-permission.
    public function manage(Request $request, $id)
    {
        // Variabel untuk menyimpan instance dari model Permission berdasarkan id.
        $permission = Permission::findOrFail($id);

        // Atur nilai dari kolom status yang ada pada tabel permissions berdasarkan nilai yang diterima dari permintaan HTTP.
        $permission->status = $request->input('status');
        // Simpan perubahan ke dalam database.
        $permission->save();

        // Arahkan pengguna ke URI manage-permission.
        return redirect('/permission/manage-permission');
    }
}
