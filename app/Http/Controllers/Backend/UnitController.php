<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
class UnitController extends Controller
{
    public function index()
    {
        $data['category'] = Unit::get();
        return view('units.index',$data);
    }
    public function create()
    {
        return view('units.create');
    }
    public function store(Request $request)
    {
        $i = Unit::create(['name'=> $request->name]);
        if($i)
        {
            $request->session()->flash('success', 'Data has been saved!!');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('error', 'Failed to save data  !!');
            return redirect()->back();
        }
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['category'] = Unit::find($id);
        return view('units.edit',$data);
    }
    public function update(Request $request, $id)
    {
        $i = Unit::where('id',$id)
            ->update(['name'=>$request->name]);
        if($i)
        {
            $request->session()->flash('success', 'Data has been updated !!');
            return redirect()->route('unit.index');
        }
        else
        {
            $request->session()->flash('error', 'Failed to update data  !!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        //
    }
}
