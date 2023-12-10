<?php

namespace App\Http\Controllers;

// Impor model yang ingin digunakan.
use App\Models\Presence;
use App\Models\User;
use App\Models\Schedule;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

// Impor kelas Carbon untuk mengakses metode untuk manipulasi waktu dan tanggal.
use Carbon\Carbon;

class PresenceController extends Controller
{
    // Fungsi untuk menampilkan halaman presence.
    public function index(){
        // Mengembalikan view dengan nama presence.
        return view('presence.presence');
    }

    // Fungsi untuk absen masuk.
    public function checkIn(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'latitudeCheckIn' => 'required',
            'longitudeCheckIn' => 'required',
            'date' => 'required'
        ]);

        // Variabel untuk menyimpan data pertama dari model Schedule berdasarkan nilai dari kolom date yang memiliki nilai yang sama dengan data yang diterima permintaan HTTP.
        $schedule = Schedule::where('date', $request->input('date'))->first();
        // Variabel untuk menyimpan data pertama dari model Schedule berdasarkan nilai dari kolom status yang memiliki nilai Libur.
        $scheduleStatus = Schedule::where('status', "Libur")->first();

        // Kondisi jika tidak ada jadwal pada tanggal saat melakukan absensi.
        if (!$schedule) {
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Tidak ada jadwal pada tanggal tersebut.']);
        }

        // Kondisi jika status pada tanggal saat melakukan absensi bernilai Libur.
        if($scheduleStatus){
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Hari ini libur.']);
        }

        // Variabel untuk menyimpan nilai dari kolom in_time pada tabel schedules dalam format jam dan menit.
        $allowedHour = Carbon::parse($schedule->in_time)->format('H.i');
        // Variabel untuk menyimpan nilai dari kolom out_time pada tabel schedules dalam format jam dan menit.
        $endedHour = Carbon::parse($schedule->out_time)->format('H.i');

        // Variabel untuk mendapatkan dan menyimpan data waktu hari ini dalam format jam dan menit.
        $currentHour = now()->format('H.i');

        // Kondisi jika terlambat
        if($currentHour >= $allowedHour) {
            // Variabel untuk menyimpan nilai terlambat.
            $status = "terlambat";
        }else{
            // Variabel untuk menyimpan nilai masuk.
            $status = "masuk";
        }

        // Kondisi jika melakukan absen setelah jam pulang.
        if($currentHour == $endedHour){
            // Kembalikan dalam bentuk JSON.
            return response()->json(['message' => 'Batas absen berakhir.']);
        }

        // Variabel untuk menyimpan data id pengguna yang saat ini terautentikasi.
        $checkEmployee = auth()->user()->id;
        // Variabel untuk menyimpan data dari model Presence berdasarkan nilai dari kolom user_id yang memiliki nilai yang sama dengan nilai dari variabel $checkEmployee.
        $todayPresence = Presence::where('user_id', $checkEmployee)
        // Menyamakan nilai dari kolom date dan data waktu hari ini dalam format jFY.
        ->where('date', now()->format('j F Y'))
        // Ambil data pertama pada tabel.
        ->first();

        // Kondisi jika sudah melakukan absen.
        if($todayPresence){
            // Kembalikan dalam bentuk JSON.
            return response()->json(['message' => 'Anda sudah absen.']);
        }

        // Variabel untuk menyimpan data pengguna yang saat ini terautentikasi berdasarkan id.
        $employee = User::find(auth()->user()->id);
        // Buat instance baru dari model Presence yang terkait dengan variabel $employee.
        $employee->presence()->create([
            'status' => $status,
            // Ambil data tanggal saat ini dalam format tanggal bulan dan tahun.
            'date' => Carbon::parse(now()->day())->format('j F Y'),
            // Ambil data waktu saat ini dalam format jam dan menit.
            'time' => Carbon::parse(now()->hour())->format('H.i'),
            'name' => $employee->name
        ]);

        // Kembalikan dalam bentuk JSON.
        return response()->json(['message' => 'Absensi masuk berhasil.']);
    }

    // Fungsi untuk absen keluar.
    public function checkOut(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'latitudeCheckOut' => 'required',
            'longitudeCheckOut' => 'required',
            'date' => 'required'
        ]);

        // Variabel untuk menyimpan data pertama dari model Schedule berdasarkan nilai dari kolom date yang memiliki nilai yang sama dengan data yang diterima permintaan HTTP.
        $schedule = Schedule::where('date', $request->input('date'))->first();
        // Variabel untuk menyimpan data pertama dari model Schedule berdasarkan nilai dari kolom status yang memiliki nilai Libur.
        $scheduleStatus = Schedule::where('status', "Libur")->first();

        // Kondisi jika tidak ada jadwal pada tanggal saat melakukan absensi.
        if (!$schedule) {
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Tidak ada jadwal pada tanggal tersebut.']);
        }

        // Kondisi jika status pada tanggal saat melakukan absensi bernilai Libur.
        if($scheduleStatus){
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Hari ini libur.']);
        }

        // Variabel untuk mendapatkan dan menyimpan data waktu hari ini dalam format jam dan menit.
        $currentHour = now()->format('H.i');
        // Variabel untuk menyimpan nilai dari kolom in_time pada tabel schedules dalam format jam dan menit.
        $allowedHour = Carbon::parse($schedule->in_time)->format('H.i');

        // Kondisi jika melakukan absen sebelum jam pulang.
        if($currentHour < $allowedHour){
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Anda belum diizinkan pulang']);
        } else {
            // Variabel untuk menyimpan nilai keluar.
            $status = "keluar";
        }

        // Variabel untuk menyimpan data id pengguna yang saat ini terautentikasi. 
        $checkEmployee = auth()->user()->id;
        // Variabel untuk menyimpan data dari model Presence berdasarkan nilai dari kolom user_id yang memiliki nilai yang sama dengan nilai dari variabel $checkEmployee.
        $todayPresence = Presence::where('user_id', $checkEmployee)
        // Pastikan nilai dari kolom status adalah keluar.
        ->where('status', "keluar")
        // Ambil data pertama pada tabel.
        ->first();

        // Variabel untuk menyimpan data dari model Presence berdasarkan nilai dari kolom user_id yang memiliki nilai yang sama dengan nilai dari variabel $checkEmployee.
        $checkPresence = Presence::where('user_id', $checkEmployee)
        // Pastikan nilai dari kolom status tidak ada.
        ->where('status', [])
        // Ambil data pertama pada tabel.
        ->first();

        // Kondisi jika belum melakukan absen masuk.
        if(!$checkPresence){
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Anda Tidak Masuk.']);
        }

        // Kondisi jika sudah melakukan absen pulang.
        if($todayPresence){
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['message' => 'Anda sudah pulang.']);
        }
        
        // Variabel untuk menyimpan data pengguna yang saat ini terautentikasi berdasarkan id.
        $employee = User::find(auth()->user()->id);
        // Buat instance baru dari model Presence yang terkait dengan variabel $employee.
        $employee->presence()->create([
            'status' => $status,
            // Ambil data tanggal saat ini dalam format tanggal bulan dan tahun.
            'date' => Carbon::parse(now()->day())->format('j F Y'),
            // Ambil data waktu saat ini dalam format jam dan menit.
            'time' => Carbon::parse(now()->hour())->format('H.i T'),
            'name' => $employee->name
        ]);

        // Kembalikan dalam bentuk respon JSON.
        return response()->json(['message' => 'Absensi keluar berhasil.']);
        
    }
}
