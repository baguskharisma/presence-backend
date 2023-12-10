<?php

namespace App\Http\Controllers;

// Impor model yang ingin digunakan.
use App\Models\Schedule;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

// Impor kelas Carbon untuk mengakses metode untuk manipulasi waktu dan tanggal.
use Carbon\Carbon;
class ScheduleController extends Controller
{
    // Fungsi untuk menampilkan halaman schedule.
    public function index(){
        // Variabel untuk menyimpan semua data dari tabel yang tekait dengan model Schedule.
        $schedule = Schedule::all();

        // Mengembalikan view dengan nama schedule.
        return view('schedule.schedule', [
            // Sematkan data ke dalam view.
            'schedules' => $schedule
        ]);
    }

    // Fungsi untuk menampilkan halaman create-schedule.
    public function createSchedule(){
        // Mengembalikan view dengan nama create-schedule.
        return view('admin.create-schedule');   
    }

    // Fungsi untuk menambahkan Jadwal.
    public function storeSchedule(Request $request){
        // Validasi data yang diterima dari permintaan HTTP.
        $request->validate([
            'day' => 'required',
            'date' => 'required',
            'in_time' => 'required',
            'out_time' => 'required',
            'status' => 'required',
            'description' => 'nullable'
        ]);

        // Kondisi jika nilai yang diterima dari permintaan HTTP sama dengan hari kerja.
        if($request->status == "hari kerja"){
            // Variabel untuk menyimpan nilai Hari Kerja.
            $status = "Hari Kerja";
        // Kondisi jika nilai yang diterima dari permintaan HTTP sama dengan tanggal merah.
        }else if($request->status == "tanggal merah"){
            // Variabel untuk menyimpan nilai Tanggal Merah.
            $status = "Tanggal Merah";
        // Kondisi jika nilai yang diterima dari permintaan HTTP sama dengan libur.
        }else if($request->status == "libur"){
            // Variabel untuk menyimpan nilai Libur.
            $status = "Libur";
        }

        // Buat dan simpan instance baru dari model Schedule ke dalam database.
        Schedule::create([
            'day' => $request->day,
            // Ambil data tanggal dari nilai date yang diterima dari permintaan HTTP dalam format tanggal bulan dan tahun.
            'date' => Carbon::parse($request->date)->format('j F Y'),
            // Ambil data waktu dari nilai in_time yang diterima dari permintaan HTTP dalam format jam dan menit.
            'in_time' => Carbon::parse($request->in_time)->format('H.i'),
            // Ambil data waktu dari nilai out_time yang diterima dari permintaan HTTP dalam format jam dan menit.
            'out_time' => Carbon::parse($request->out_time)->format('H.i'),
            'status' => $status,
            'description' => $request->description
        ]);

        // Arahkan pengguna ke URI schedule.
        return redirect('schedule');
    }

    // Fungsi untuk menampilkan halaman schedule-detail.
    public function scheduleDetail(){
        // Variabel untuk menyimpan semua data dari tabel yang tekait dengan model Schedule.
        $schedule = Schedule::all();

        // Mengembalikan view dengan nama schedule-detail.
        return view('schedule.schedule-detail', [
            // Sematkan data ke dalam view.
            'schedules' => $schedule
        ]);
    }
}