<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request){
        $user = User::query();
        $employee = $user->get();

        if($request->has('position')){
            $position = $request->input('position');

            if($position !== 'all'){
                $employee = $employee->where('position_id', $position);
            }
        }

        return view('admin.admin', [
            'employees' => $employee,
            'selectedPosition' => $request->input('position')        
        ]);
    }

    public function createUser(){
        return view('admin.create-user');
    }

    public function storeUser(Request $request){
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

        return redirect('admin');
    }

    public function editUser($id){
        $employee = User::find($id);
        
        return view('admin.edit-user', compact('employee'));
    }

    public function updateUser(Request $request, $id){
        $employee = User::find($id);
        $employee->update($request->all());
        
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

        return redirect('/admin');
    }

    public function deleteUser($id){
        $employee = User::find($id);
        $employee->delete();

        return redirect('admin');
    }

    public function managePresence(){
        $presence = Presence::all();

        return view('presence.manage-presence', [
            'presences' => $presence,
        ]);
    }
}
