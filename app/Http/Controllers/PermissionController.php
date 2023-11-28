<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function index(){
        $permission = Permission::all();

        return view('permission', [
            'permissions' => $permission
        ]);
    }
    
    public function createPermission(){
        $employee = auth()->user();

        return view('permission.create-permission', [
            'employee' => $employee
        ]);
    }

    public function storePermission(Request $request){
        $request->validate([
            'name' => 'required',
            'from_when' => 'required',
            'to_when' => 'required',
            'submission_date' => 'required',
            'description' => 'required'
        ]);

        Permission::create([
            'name' => $request->name,
            'from_when' => Carbon::parse($request->from_when)->format('j F Y'),
            'to_when' => Carbon::parse($request->to_when)->format('j F Y'),
            'submission_date' => $request->submission_date,
            'description' => $request->description
        ]);

        return redirect('permission');
    }

     public function manage(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->status = $request->input('status');
        $permission->save();

        return redirect('/permission/manage');
    }
}
