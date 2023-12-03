<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Presence;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request){
        $user = User::query();
        $employee = $user->get();
        $position = Position::all();
        $department = Department::all();

        if($request->has('position')){
            $position = $request->input('position');

            if($position !== 'all'){
                $employee = $employee->where('position_id', $position);
            }
        }

        return view('admin.admin', [
            'employees' => $employee,
            'selectedPosition' => $request->input('position'),
            'positions' => $position,
            'departments' => $department
        ]);
    }

    public function createUser(){
        $position = Position::all();
        $department = Department::all();
        $role = Role::all();

        return view('admin.create-user', [
            'positions' => $position,
            'departments' => $department,
            'roles' => $role
        ]);
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

    public function createPosition(){
        return view('admin.create-position');
    }

    public function storePosition(Request $request){
        $request->validate([
            'position'=>'required'
        ]);

        Position::create([
            'position' => $request->position,
        ]);

        return redirect('admin');
    }

    public function createDepartment(){
        return view('admin.create-department');
    }

    public function storeDepartment(Request $request){
        $request->validate([
            'department'=>'required'
        ]);

        Department::create([
            'department' => $request->department,
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

    public function deletePosition($id){
        $position = Position::find($id);
        $position->delete();

        return redirect('admin');
    }

    public function deleteDepartment($id){
        $department = Department::find($id);
        $department->delete();

        return redirect('admin');
    }

    public function managePresence(){
        $presence = Presence::all();

        return view('presence.manage-presence', [
            'presences' => $presence,
        ]);
    }
}
