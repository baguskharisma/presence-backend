<?php

namespace App\Http\Controllers;

// Impor model yang ingin digunakan.
use App\Models\Department;
use App\Models\Presence;
use App\Models\User;
use App\Models\Role;
use App\Models\Position;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

// Impor facade Hash.
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Fungsi untuk menampilkan halaman admin.
    public function index(Request $request){
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model User.
        $employee = User::query()->get();
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model Position. 
        $position = Position::all();
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model Department.
        $department = Department::all();

        // Kondisi jika permintaan HTTP menerima parameter dengan nama position.
        if($request->has('position')){
            // Variabel untuk menyimpan nilai dari parameter dengan nama position dari permintaan HTTP.
            $position = $request->input('position');

            // Kondisi jika permintaan HTTP menerima parameter dengan nama position yang memiliki nilai all.
            if($position !== 'all'){
                // Variabel untuk menyimpan data dari variabel $position yang memiliki nilai yang sama dengan data dikolom position_id.
                $employee = $employee->where('position_id', $position);
            }
        }

        // Mengembalikan view dengan nama admin.
        return view('admin.admin', [
            // Sematkan data ke dalam view.
            'employees' => $employee,
            'selectedPosition' => $request->input('position'),
            'positions' => $position,
            'departments' => $department
        ]);
    }

    // Fungsi untuk menampilkan halaman create-user.
    public function createUser(){
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model Position.
        $position = Position::all();
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model Department.
        $department = Department::all();
        // Variabel untuk menyimpan semua data dari tabel yang tekait dengan model Role.
        $role = Role::all();

        // Mengembalikan view dengan nama create-user.
        return view('admin.create-user', [
            // Sematkan data ke dalam view.
            'positions' => $position,
            'departments' => $department,
            'roles' => $role
        ]);
    }

    // Fungsi untuk menambahkan karyawan.
    public function storeUser(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'birth'=>'required',
            'gender'=>'required',
            'position_id'=>'required|numeric',
            'role_id'=>'required|numeric',
            'department_id'=>'required|numeric'
        ]);

        // Buat dan simpan instance baru dari model User ke dalam database.
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth' => $request->birth,
            'gender' => $request->gender,
            'position_id' => $request->position_id,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id
        ]);

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menampilkan halaman create-position.
    public function createPosition(){
        // Mengembalikan view dengan nama create-position.
        return view('admin.create-position');
    }

    // Fungsi untuk menambahkan posisi.
    public function storePosition(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'position'=>'required'
        ]);

        // Buat dan simpan instance baru dari model Position ke dalam database.
        Position::create([
            'position' => $request->position,
        ]);

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menampilkan halaman create-department.
    public function createDepartment(){
        // Mengembalikan view dengan nama create-department.
        return view('admin.create-department');
    }

    // Fungsi untuk menambahkan departemen.
    public function storeDepartment(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'department'=>'required'
        ]);

        // Buat dan simpan instance baru dari model Department ke dalam database.
        Department::create([
            'department' => $request->department,
        ]);

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menampilkan halaman edit-user.
    public function editUser($id){
        // Variabel untuk menyimpan hasil record dari tabel user berdasarkan nilai id.
        $employee = User::find($id);
        
        // Mengembalikan view dengan nama edit-user.
        return view('admin.edit-user', compact('employee'));
    }

    // Fungsi untuk update data karyawan.
    public function updateUser(Request $request, $id){
        // Variabel untuk menyimpan hasil record dari tabel user berdasarkan nilai id.
        $employee = User::find($id);
        // Perbarui record dalam database berdasarkan data yang diterima dari permintaan HTTP.
        $employee->update($request->all());
        
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'birth'=>'required',
            'gender'=>'required',
            'position_id'=>'required|numeric',
            'role_id'=>'required|numeric',
            'department_id'=>'required|numeric'
        ]);

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menghapus karyawan.
    public function deleteUser($id){
        // Variabel untuk menyimpan hasil record dari tabel user berdasarkan nilai id.
        $employee = User::find($id);
        // Hapus record yang terkait dengan model User yang disimpan dalam variabel $employee dari database.
        $employee->delete();

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menghapus posisi.
    public function deletePosition($id){
        // Variabel untuk menyimpan hasil record dari tabel position berdasarkan nilai id.
        $position = Position::find($id);
        // Hapus record yang terkait dengan model Position yang disimpan dalam variabel $position dari database.
        $position->delete();

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menghapus departemen.
    public function deleteDepartment($id){
        // Variabel untuk menyimpan hasil record dari tabel department berdasarkan nilai id.
        $department = Department::find($id);
        // Hapus record yang terkait dengan model Department yang disimpan dalam variabel $department dari database.
        $department->delete();

        // Arahkan pengguna ke URI admin.
        return redirect('admin');
    }

    // Fungsi untuk menampilkan halaman manage-presence.
    public function managePresence(){
        // Variabel untuk menyimpan semua data dari tabel yang terkait dengan model Presence.
        $presence = Presence::all();

        return view('presence.manage-presence', [
            'presences' => $presence,
        ]);
    }
}
