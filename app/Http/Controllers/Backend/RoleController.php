<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\role_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{

    public function index()
    {
        $data['role'] = Role::get();
        return view('roles.index',$data);
    }


    public function create()
    {
        return view('roles.create');
    }


    public function store(Request $request)
    {
        $i= Role::create(['name'=>$request->name]);
        if($i)
        {
            $request->session()->flash('success', 'Data has been Saved !!');
            return redirect()->back();

        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['role'] = Role::find($id);
        return view('roles.edit',$data);
    }


    public function update(Request $request, $id)
    {
       $i = Role::where('id',$id)->update(['name'=>$request->name]);
       if($i)
       {
           $request->session()->flash('success', 'Data has been Updated !');
           return redirect()->route('role.index');
       }
       else
       {
           $request->session()->flash('error', 'Failed to update data !');
           return redirect()->back();
       }
    }
    public function detail($id)
    {
        $data['role'] = Role::find($id);

        $sql = "select permissions.id as pid, permissions.alias, tbl.* from permissions
        left join (select * from role_permissions where role_id=$id) as tbl
        on permissions.id = tbl.permission_id";
       $data['permission'] = DB::select($sql);
        return view('roles.detail',$data);
    }

    public function destroy($id)
    {
        //
    }
    public function save_permission(Request $r)
    {
        $i = 0;
        if($r->rpid>0)
        {
            // update role_permissions
            $data = array(
                'role_id' => $r->role_id,
                'permission_id' => $r->pid,
                'view' => $r->list,
                'create' => $r->create,
                'edit' => $r->edit,
                'delete' => $r->del
            );
            DB::table('role_permissions')->where('id', $r->rpid)
                ->update($data);
            $i = $r->rpid;
        }
        else{
            // insert into role_permissions
            $data = array(
                'role_id' => $r->role_id,
                'permission_id' => $r->pid,
                'view' => $r->list,
                'create' => $r->create,
                'edit' => $r->edit,
                'delete' => $r->del
            );
            $i = DB::table('role_permissions')->insertGetId($data);
        }
        return $i;
    }



}
