<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin',['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRole($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view ('roles.add',['roles'=>$roles,'user'=>$user]);
    }

    public function removeRole($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view ('roles.remove',['roles'=>$roles,'user'=>$user]);
    }

    public function confirmRole($id,Request $request)
    {
        $role_id = $request->input('role');
        $role = Role::find($role_id);
        $user = User::find($id);
        $user->roles()->attach($role);

        $usuarios = User::all();
        return view('admin',['usuarios' => $usuarios]);

    }

    public function destroyRole($id,Request $request)
    {
        $role_id = $request->input('role');
        $role = Role::find($role_id);
        $user = User::find($id);
        $user->roles()->detach($role);

        $usuarios = User::all();
        return view('admin',['usuarios' => $usuarios]);
    }
}
