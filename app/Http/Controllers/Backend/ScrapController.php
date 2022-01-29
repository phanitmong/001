<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scrap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helper;
use App\Models\Product;
use App\Models\ScrapDetail;

class ScrapController extends Controller
{
    public function index()
    {
        $data['stock_out'] = Scrap::where('active',1)->get();

        return view('scraps.index',$data);
    }

    public function create()
    {
        $data['product'] = Product::where('active',1)->get();
        return view('scraps.create',$data);
    }
    public function save(Request $request)
    {


        $m = json_encode($request->master);
        $m = json_decode($m);

        $switch = Scrap::orderBy('id','desc')->first();
        if ($switch) {
        $old_exam_no = substr($switch->scrap_no,2);

        if ($old_exam_no == '') $old_exam_no = '000000';
        $in_id = 'SO'.$old_exam_no;
        }
        else
        {
        $in_id= 'SO'.'000000';
        }

        $data = array(
            'scrap_no' => ++$in_id,
            'scrap_date' => $m->in_date,
            'description' => $m->description,
            'user_id' => 1
        );

        $i = Scrap::create($data);

        if($i)
        {
            $items = json_encode($request->items);
            $items = json_decode($items);

            foreach($items as $item)
            {
                $in = array(
                    'scrap_id' => $i->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                );

                $x = ScrapDetail::create($in);
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
        $data['in'] =   Scrap::find($id);
        $data['products'] = Product::where('active',1)->get();
        return view('scraps.details',$data);
    }

    public function delete($id)
    {
          $i = Scrap::where('id',$id)->update(['active'=>0]);
        if($i)
        {
            $items = ScrapDetail::where('scrap_id',$id)
                    ->get();
            $n = ScrapDetail::where('scrap_id',$id)
                ->update(['active'=>0]);
            if($n)
            {
                foreach($items as $item)
                {
                    Helper::add($item->product_id,$item->quantity);
                }
            }
        }
        return redirect('scrap')->with('success', 'Data has been removed!');
    }
    public function print($id)
    {


        $data['in'] = Scrap::find($id);
        $data['in']->scrap_date = Helper::get_kh_date($data['in']->scrap_date);

        $data['items'] = DB::table('scrap_details')
            ->join('products', 'scrap_details.product_id', 'products.id')
            ->leftJoin('units','products.unit_id','units.id')
            ->where('scrap_details.scrap_id', $id)
            ->select('scrap_details.*', 'products.code', 'products.name','units.name as uname')
            ->get();

        return view('scraps.print', $data);
    }
    public function save_master(Request $r)
    {
        $data = array(
            'scrap_date' => $r->in_date,
            'description' => $r->description
        );

        $i = Scrap::where('id',$r->id)
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

        $item = ScrapDetail::find($id);
        $i= ScrapDetail::where('id',$id)->delete();
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
            'scrap_id' => $r->id,
            'product_id' => $r->item,
            'quantity' => $r->quantity
        );
        $i = ScrapDetail::insert($data);
        if($i)
        {
            Helper::sub($r->item, $r->quantity);
        }
        return redirect('scrap/detail/'.$r->id);
    }
}
