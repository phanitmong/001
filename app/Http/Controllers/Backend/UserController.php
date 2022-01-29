<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::where('active',1)->get();
       return view('users.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $data['role'] = Role::get();
      return view('users.create',$data);
    }


    public function store(Request $request)
    {


       $data = array(
        'name' =>$request->name,
        'password' => bcrypt($request->password),
        'username'=> $request->username,
        'role_id' => $request->role,
        'email' => $request->email,
        'phone' => $request->phone,
        'gender' => $request->gender,
    );

       $i = User::create($data);
       if($i)
       {
           return redirect()->route('user.index');
       }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['role'] = Role::get();
        return view('users.edit',$data);
    }


    public function update(Request $request, $id)
    {
        $data = array(
            'name' =>$request->name,
            'password' => bcrypt($request->password),
            'username'=> $request->username,
            'role_id' => $request->role,
            'email' => $request->email,

        );
        $i  = User::where('id',$id)->update($data);
        if($i)
        {
            return redirect()->route('user.index')->with('success','Data has been updated !!');
        }
        else
        {
            return redirect()->back()->with('error','Failed to update data !!');
        }
    }


    public function destroy($id)
    {
        $i = User::where('id',$id)->update(['active'=>0]);
        if($i)
        {
            return redirect()->back()->with('success','អ្នកលុបជោគជ័យ');
        }
        else
        {
            return redirect()->back()->with('error','បរាជ័យ');
        }
    }
}
