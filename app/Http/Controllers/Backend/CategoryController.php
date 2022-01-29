<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $data['category'] = Category::get();
        return view('category.index',$data);
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $i = Category::create(['name'=> $request->name]);
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
        $data['category'] = Category::find($id);
        return view('category.edit',$data);
    }
    public function update(Request $request, $id)
    {
        $i = Category::where('id',$id)
            ->update(['name'=>$request->name]);
        if($i)
        {
            $request->session()->flash('success', 'Data has been updated !!');
            return redirect()->route('category.index');
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
