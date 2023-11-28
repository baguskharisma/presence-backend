<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->get();

        return view('profile', [
            'users' => $user
        ]);
    }
}
