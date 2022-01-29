<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Helper;
use Illuminate\Http\Request;
use App\Models\Unit;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->q)
        {
            $data['product'] = Product::where('active',1)
                                ->where(function($query) use ($request)
                                {
                                    $query = $query->where('name','like',"%{$request->q}%")
                                            ->Orwhere('code','like',"{$request->q}");
                                })
                                ->get();
        }
        else
        {
            $data['product'] = Product::where('active',1)
                                ->get();
        }
        return view('products.index',$data);
    }

    public function create()
    {
        $data['category'] = Category::get();
        $data['unit'] = Unit::get();
        return view('products.create',$data);
    }

    public function store(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'cost' => $request->cost,
            'price'=> $request->price,
            'category_id' => $request->category,
            'code' => $request->code,
            'unit_id'=> $request->unit,
        );
       $i = Product::create($data);
       if($i)
       {
           $request->session()->flash('success', "ទិន្នន័យបានរក្សាទុក !!");
           return redirect()->back();
       }
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
       $data['product'] = Product::find($id);
       $data['category']= Category::get();
       $data['unit'] = Unit::get();
       return view('products.edit',$data);
    }
    public function update(Request $request, $id)
    {
        $data = array(
            'name' => $request->name,
            'cost' => $request->cost,
            'price'=> $request->price,
            'category_id' => $request->category,
            'code' => $request->code,
            'unit_id' => $request->unit,

        );
        $i = Product::where('id',$id)->update($data);
        if($i)
       {
           $request->session()->flash('success', "ទិន្នន័យបានរក្សាទុក !!");
           return redirect()->route('product.index');
       }
    }

    public function destroy(Request $request,$id)
    {
        $i = Product::where('id',$id)->update(['active'=>0]);
        if($i)
        {
            $request->session()->flash('success', 'ទិន្នន័យត្រូវបានលុប !!');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('error', 'លុប បរាជ័យ !!');
            return redirect()->back();
        }
    }
}
