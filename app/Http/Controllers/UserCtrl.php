<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\RoleUser;
use Auth;
use Image;
use Toastr;
use File;
use Session;
use DB;

class UserCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('layouts.users.view_users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('layouts.users.create_new_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'user_role' => 'required',
            'name'      => 'required|max:255',
            'contact'   => 'required',            
        ]);

       $role = Role::find($request->user_role);

       $user = new User;
       $user->name       = $request->name;
       $user->contact    = $request->contact;
       $user->email      = $request->email;
       $user->password   = bcrypt($request->password);
       $user->created_by = Auth::id();       
       if($request->image > 0){
            $image       = $request->file('image');
            $img         = time() .'.'. $image->getClientOriginalExtension();
            $location    = public_path('img/user/'.$img);
            Image::make($image)->save($location);
            $user->image = $img;
        }
        $user->save();
        $user->roles()->attach($role);

    Session::flash('success', 'User Successfully Save');
    return redirect('/user');

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user_role = DB::table('role_user')->leftJoin('roles', 'roles.id', 'role_user.role_id')->where('role_user.user_id', $id)->first();
        return view('layouts.users.read_user', compact('user', 'user_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $user_role = DB::table('role_user')->leftJoin('roles', 'roles.id', 'role_user.role_id')->where('role_user.user_id', $user->id)->first();
        return view('layouts.users.edit_user_account', compact('user', 'roles', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_role' => 'max:9999',
            'name'      => 'required|max:255',
            'contact'   => 'required',
            'email'     => 'required',
            'status'    => 'max:1',
        ]);

        $existrole = DB::table('role_user')->where('user_id', $id)->first();

        $users = User::find($id);
        $users->name       = $request->input('name');
        $users->contact    = $request->input('contact');
        $users->email      = $request->input('email');
        $users->status     = $request->input('status');
        $users->updated_by = Auth::id();

        if($request->image > 0){

            if (File::exists('img/user/' .$users->image)) {
                File::delete('img/user/' .$users->image);
            }

            $image = $request->file('image');
            $img = $request->name.'_'.time() .'.'. $image->getClientOriginalExtension();
            $location =  public_path('img/user/'.$img);
            Image::make($image)->save($location);
            $users->image = $img;
        }
        $users->save();
        $users->roles()->updateExistingPivot($existrole->role_id, ['role_id' => $request->user_role]);

        Session::flash('success', 'User Successfully Updated');
        return redirect('/user/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (File::exists('img/user/' .$user->image)) {
            File::delete('img/user/' .$user->image);
        }

        $user->delete();
        Session::flash('success', 'User Successfully Removed');
        return redirect()->route('users.index');
    }

    public function changePassword()
    {
        $profile = User::find(Auth::id());
        return view('layouts.change_password', compact('profile'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|min:8|max:32',
            'password'         => 'required|min:8|max:32|confirmed'
            ]);

        $user = User::find(Auth::id());

        function passverify($curr, $dbpass){
            return password_verify($curr, $dbpass);
        }

        if(password_verify($request->current_password, $user->password) === false){
            Session::flash('error', 'Invalid password provided.');
            return redirect('/change_password');
        }else{
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->password);
            $user->save();

            Session::flash('success', 'Password successfully updated.');
            return redirect('/change_password');
        }
    }
}
