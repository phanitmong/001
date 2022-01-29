<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request  $request)
    {
        $data['invoice'] = Invoice::where('active',1)->get();

        return view('invoices.index',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $id = Decrypt($id);

        $data['invoice'] = Invoice::find($id);

        return view('invoices.show',$data);
    }

    public function edit($id)
    {
        $data['details'] = InvoiceDetail::find($id);
        return view('invoices.edit',$data);
    }


    public function update(Request $request, $id)
    {

        $i = InvoiceDetail::find($id);
        $r_total = $request->price*$request->quantity;
        $total = $i->quantity* $i->price;

        if($total>$r_total)
        {

            $value = $total-$r_total;
            $detail = InvoiceDetail::where('id',$id)->update(['quantity'=>$request->quantity,'price'=>$request->price]);
            $invoice = Invoice::where('id',$i->invoice_id)
                        ->decrement('total_amount',$value);


        }
        else
        {
            $value = $r_total-$total;
            $detail = InvoiceDetail::where('id',$id)->update(['quantity'=>$request->quantity,'price'=>$request->price]);
            $invoice = Invoice::where('id',$i->invoice_id)
            ->increment('total_amount',$value);
        }

        if($detail && $invoice)
        {
            return redirect()->back()->with('success','បានកែប្រែជោគជ័យ!!');
        }
        else
        {
            return redirect()->route('invoice.edit',$id)->with('error','បរាជ័យ');


        }

    }

    public function destroy($id ,Request $request)
    {
        $i = InvoiceDetail::where('id',$id)->update(['active'=>0]);
        $add = InvoiceDetail::find($id);
        $product_id = $add->product_id;
        $qty = $add->quantity;
        if($i)
        {
            Helper::add($product_id,$qty);
            Invoice::where('id',$add->invoice_id)->decrement('total_amount',$add->price*$add->quantity);
            return redirect()->back()->with('success','Data has been deleted!!');
        }

    }
}
