<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Permission;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
     public function history(){
        $userId = auth()->user()->id;
        $username = auth()->user()->name;
        $presence = Presence::where('user_id', $userId)->get();
        $permission = Permission::where('name', $username)->get();

        return view('history', [
            'presences' => $presence,
            'permissions' => $permission
        ]);
    }
}
