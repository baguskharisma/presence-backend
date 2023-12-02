<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        $schedule = Schedule::all();

        return view('schedule.schedule', ['schedules' => $schedule]);
    }

    public function createSchedule(){
        return view('admin.create-schedule');   
    }

    public function storeSchedule(Request $request){
        $request->validate([
            'day' => 'required',
            'date' => 'required',
            'in_time' => 'required',
            'out_time' => 'required',
            'status' => 'required',
            'description' => 'nullable'
        ]);

        if($request->status == "hari kerja"){
            $status = "Hari Kerja";
        }else if($request->status == "tanggal merah"){
            $status = "Tanggal Merah";
        }else if($request->status == "libur"){
            $status = "Libur";
        }else{
            return response()->json(['message' => 'Status Tidak Valid']);
        }

        Schedule::create([
            'day' => $request->day,
            'date' => Carbon::parse($request->date)->format('j F Y'),
            'in_time' => Carbon::parse($request->in_time)->format('H.i T'),
            'out_time' => Carbon::parse($request->out_time)->format('H.i T'),
            'status' => $status,
            'description' => $request->description
        ]);

        return redirect('schedule');
    }

    public function scheduleDetail(){
        $schedule = Schedule::all();

        return view('schedule.schedule-detail', ['schedules' => $schedule]);
    }
}