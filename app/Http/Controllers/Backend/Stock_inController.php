<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper;
use App\Models\Product;
use App\Models\Stock_in;
use App\Models\Stock_in_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Stock_inController extends Controller
{
    public function index()
    {
        $data['stock_in'] = Stock_in::where('active',1)->get();
        return view('stock_ins.index',$data);
    }

    public function create()
    {
        $data['product'] = Product::where('active',1)->get();
        return view('stock_ins.create',$data);
    }
    public function save(Request $request)
    {


        $m = json_encode($request->master);
        $m = json_decode($m);
        $switch = Stock_in::orderBy('id','desc')->first();
        if ($switch) {
        $old_exam_no = substr($switch->IN_ID,2);

        if ($old_exam_no == '') $old_exam_no = '000000';
        $in_id = 'SI'.$old_exam_no;
        }
        else
        {
        $in_id= 'SI'.'000000';
        }

        $data = array(
            'IN_ID' => ++$in_id,
            'in_date' => $m->in_date,
            'reference_no' => $m->reference,
            'description' => $m->description,
            'user_id' => 1
        );
        $i = Stock_in::create($data);

        if($i)
        {
            $items = json_encode($request->items);
            $items = json_decode($items);

            foreach($items as $item)
            {
                $in = array(
                    'stock_in_id' => $i->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->quantity,
                );
                $x = Stock_in_detail::create($in);
                if($x)
                {
                    // update onhand
                   Helper::add($item->product_id,$item->quantity);
                }
            }

        }
       return $i->id;
    }

    public function detail($id)
    {
        $data['in'] = Stock_in::find($id);
        $data['products'] = Product::where('active',1)->get();
        return view('stock_ins.details',$data);
    }

    public function delete($id)
    {
          $i = Stock_in::where('id',$id)->update(['active'=>0]);
        if($i)
        {
            $items = Stock_in_detail::where('stock_in_id',$id)
                    ->get();
            $n = Stock_in_detail::where('stock_in_id',$id)
                ->update(['active'=>0]);
            if($n)
            {
                foreach($items as $item)
                {
                    Helper::sub($item->product_id,$item->qty);
                }
            }
        }
        return redirect('stock_in')->with('success', 'Data has been removed!');
    }
    public function print($id)
    {

        $data['in'] = DB::table('stock_ins')
            ->where('stock_ins.active', 1)
            ->where('stock_ins.id', $id)
            ->select('stock_ins.*')
            ->first();


        $data['items'] = DB::table('stock_in_details')
            ->join('products', 'stock_in_details.product_id', 'products.id')
            ->leftJoin('units','units.id','products.unit_id')
            ->where('stock_in_details.stock_in_id', $id)
            ->where('stock_in_details.active',1)
            ->select('stock_in_details.*', 'products.code', 'products.name','units.name as uname')
            ->get();

        return view('stock_ins.print', $data);
    }
    public function save_master(Request $r)
    {
        $data = array(
            'in_date' => $r->in_date,
            'reference_no' => $r->reference,
            'puchase_no' => $r->po_no,
            'description' => $r->description
        );

        $i = Stock_in::where('id',$r->id)
            ->update($data);

        if($i)
        {
            return $r->id;
        }
        else{
            return 0;
        }
    }
    public function delete_item($id)
    {

        $item = Stock_in_detail::find($id);
        $i= Stock_in_detail::where('id',$id)->delete();
        if($i)
        {
             Product::where('id',$item->product_id)
            ->decrement('qty',$item->qty);

        }
        return $i;
    }
    public function save_item(Request $r)
    {

        $data = array(
            'stock_in_id' => $r->id,
            'product_id' => $r->item,
            'qty' => $r->quantity
        );
        $i = DB::table('stock_in_details')->insert($data);
        if($i)
        {
            Helper::add($r->item, $r->quantity);
        }
        return redirect('stock-in/detail/'.$r->id);
    }
}
