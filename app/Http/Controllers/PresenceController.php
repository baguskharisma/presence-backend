<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\User;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(){
        return view('presence.presence');
    }

    public function checkIn(Request $request){
        $request->validate([
            'latitudeCheckIn' => 'required',
            'longitudeCheckIn' => 'required',
            'date' => 'required'
        ]);

        $schedule = Schedule::where('date', $request->input('date'))->first();

        if (!$schedule) {
            return response()->json(['message' => 'Tidak ada jadwal pada tanggal tersebut.']);
        }

        $allowedHour = $schedule->in_time;
        $endedHour = $schedule->out_time;
        $allowedMinute = 1;

        $currentHour = now()->hour;
        $currentMinute = now()->minute;
        if($currentHour > $allowedHour || ($currentHour == $allowedHour && $currentMinute >= $allowedMinute)) {
            $status = "terlambat";
        }else if($currentHour > $endedHour){
            return response()->json(['message' => 'Batas absen berakhir.']);
        }else{
            $status = "masuk";
        }

        $checkEmployee = auth()->user()->id;
        $todayPresence = Presence::where('user_id', $checkEmployee)->whereDate('date', now()->format('j F Y'))->first();

        if($todayPresence){
            return response()->json(['message' => 'Anda sudah absen.']);
        }

        $employee = User::find(auth()->user()->id);
        $employee->presence()->create([
            'status' => $status,
            'date' => Carbon::now()->format('j F Y'),
            'time' => Carbon::now()->format('H.i T'),
            'name' => $employee->name
        ]);

        return response()->json(['message' => 'Absensi masuk berhasil.']);
    }

    public function checkOut(Request $request){
        $request->validate([
            'latitudeCheckOut' => 'required',
            'longitudeCheckOut' => 'required',
            'date' => 'required'
        ]);

        $schedule = Schedule::where('date', $request->input('date'))->first();

        if (!$schedule) {
            return response()->json(['message' => 'Tidak ada jadwal pada tanggal tersebut.']);
        }

        $currentHour = now()->hour;
        $allowedHour = $schedule->out_time;

        if($currentHour < $allowedHour){
            return response()->json(['message' => 'Anda belum diizinkan pulang']);
        } else {
            $status = "keluar";
        }

        $checkEmployee = auth()->user()->id;
        $todayPresence = Presence::where('user_id', $checkEmployee)->where('status', "keluar")->first();

        if($todayPresence){
            return response()->json(['message' => 'Anda sudah pulang.']);
        }

        $employee = User::find(auth()->user()->id);
        $employee->presence()->create([
            'status' => $status,
            'date' => Carbon::now()->format('j F Y'),
            'time' => Carbon::now()->format('H.i T'),
            'name' => $employee->name
        ]);

        return response()->json(['message' => 'Absensi keluar berhasil.']);
    }
}
