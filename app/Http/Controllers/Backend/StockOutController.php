<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Helper;
use App\Models\Stock_out;
use App\Models\Product;
use App\Models\StockOutDetail;

class StockOutController extends Controller
{
    public function index()
    {
        $data['stock_out'] = Stock_out::where('active',1)->get();
        return view('stock_outs.index',$data);
    }

    public function create()
    {
        $data['product'] = Product::where('active',1)->get();
        return view('stock_outs.create',$data);
    }
    public function save(Request $request)
    {

        $m = json_encode($request->master);
        $m = json_decode($m);
        $switch = Stock_out::orderBy('id','desc')->first();
        if ($switch) {
        $old_exam_no = substr($switch->OUT_ID,2);

        if ($old_exam_no == '') $old_exam_no = '000000';
        $in_id = 'SO'.$old_exam_no;
        }
        else
        {
        $in_id= 'SO'.'000000';
        }

        $data = array(
            'OUT_ID' => 10,
            'out_date' => $m->in_date,
            'reference_no' => $m->reference,
            'description' => $m->description,
            'user_id' => 1
        );

        $i = Stock_out::create($data);

        if($i)
        {
            $items = json_encode($request->items);
            $items = json_decode($items);

            foreach($items as $item)
            {
                $in = array(
                    'stock_out_id' => $i->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->quantity,
                );
                $x = StockOutDetail::create($in);
                if($x)
                {
                    // update onhand
                   Helper::sub($item->product_id,$item->quantity);
                }
            }
        }
       return $i->id;
    }

    public function detail($id)
    {
        $data['in'] =   Stock_out::find($id);
        $data['products'] = Product::where('active',1)->get();
        return view('stock_outs.details',$data);
    }

    public function delete($id)
    {
          $i = Stock_out::where('id',$id)->update(['active'=>0]);
        if($i)
        {
            $items = StockOutDetail::where('stock_out_id',$id)
                    ->get();
            $n = StockOutDetail::where('stock_out_id',$id)
                ->update(['active'=>0]);
            if($n)
            {
                foreach($items as $item)
                {
                    Helper::add($item->product_id,$item->qty);
                }
            }
        }
        return redirect('stock_out')->with('success', 'លុបបានជោគជ័យ!');
    }
    public function print($id)
    {


        $data['in'] = DB::table('stock_outs')
            ->where('id', $id)
            ->first();

        $data['items'] = DB::table('stock_out_details')
            ->join('products', 'stock_out_details.product_id', 'products.id')
            ->leftJoin('units','units.id','products.unit_id')
            ->where('stock_out_details.stock_out_id', $id)
            ->where('stock_out_details.active',1)
            ->select('stock_out_details.*', 'products.code', 'products.name','units.name as uname')
            ->get();

        return view('stock_outs.print', $data);
    }
    public function save_master(Request $r)
    {
        $data = array(
            'out_date' => $r->in_date,
            'reference_no' => $r->reference,
            'description' => $r->description
        );

        $i = Stock_out::where('id',$r->id)
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

        $item = StockOutDetail::find($id);
        $i= StockOutDetail::where('id',$id)->delete();
        if($i)
        {
             Product::where('id',$item->product_id)
            ->increment('qty',$item->qty);

        }
        return $i;
    }
    public function save_item(Request $r)
    {
        $data = array(
            'stock_out_id' => $r->id,
            'product_id' => $r->item,
            'qty' => $r->quantity
        );
        $i = DB::table('stock_out_details')->insert($data);
        if($i)
        {
            Helper::sub($r->item, $r->quantity);
        }
        return redirect('stock-out/detail/'.$r->id);
    }
}
