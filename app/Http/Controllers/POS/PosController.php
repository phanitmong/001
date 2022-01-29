<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return view('pos.index');
    }
    public function get(Request $request)
    {

        $data = Product::where('code','=',$request->code)
        ->select('id','name','code','price')
        ->first();

        if($data)
        {
            return response()->json($data);
        }
    }

    public function save(Request $request)
    {


        $item = json_encode($request->items);
        $item = json_decode($item);
      
        $switch = Invoice::orderBy('id','desc')->first();
        if ($switch) {
        $old_exam_no = substr($switch->invoice_no,2);

        if ($old_exam_no == '') $old_exam_no = '000000';
        $in_id = 'IN'.$old_exam_no;
        }
        else
        {
        $in_id= 'IN'.'000000';
        }
        $in_data = array(
            'invoice_no' => ++$in_id,
            'user_id'=>1,
            'total_amount'=> $request->amount,
        );
        $i = Invoice::create($in_data);

        foreach($item as $item)
        {
            $data = array(
                'invoice_id' => $i->id,
                'product_id'=> $item->product_id,
                'quantity'  =>$item->quantity,
                'price'    => $item->price,
                'product_name'=> $item->price,
             );
             $detail = InvoiceDetail::create($data);
             $sub =Helper::sub($item->product_id,$item->quantity);

        }

        if($i)
        {
            return $i->id;
        }
        else
        {
            return 0;
        }

    }
    public function invoice($id)
    {
        $data['invoice'] = Invoice::where('id',$id)->where('active',1)->first();
        return view('pos.invoice',$data);
    }
}
