<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Scrap;
use App\Models\ScrapDetail;
use App\Models\Stock_in;
use App\Models\Stock_in_detail;
use App\Models\Stock_out;
use App\Models\StockOutDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report(Request $request)
    {


        $filter='';
        if($request->filter=='alltime')
        {
            $request->filter=0;
        }

        Session::put('filter',0);
        if(!$request->filter & Session::get('filter'))
        {
            $filter = Session::get('filter');
        }
        elseif($request->filter)
        {

            Session::put('filter',$request->filter);

            $filter = Session::get('filter');
        }

        $trend = InvoiceDetail::where('active',1)

                        ->where(function($query) use($filter){
                            if($filter<=365 && $filter>0)
                            {
                                $date = Carbon::now()->subDays($filter);
                                return $query->where('created_at','>=',$date);
                            }
                            elseif($filter==0 || $filter=='')
                            {
                                return $query;
                            }
                            else
                            {
                                return $query->whereYear('created_at',$filter);
                            }
                        });

                        if($filter<=30 && $filter>0)
                        {
                            $trend=$trend->select(DB::raw('sum(quantity*price) as total'),DB::raw('Day(invoice_details.created_at) as day'))
                            ->orderBy('day')
                            ->groupBy('day')
                            ->get();
                        }
                        elseif($filter==0 || $filter=='')
                        {
                            $trend=$trend->select(DB::raw('sum(quantity*price) as total'),DB::raw('Year(invoice_details.created_at) as day'))
                            ->orderBy('day')
                            ->groupBy('day')
                            ->get();
                        }
                        else
                        {
                            $trend=$trend->select(DB::raw('sum(quantity*price) as total'),DB::raw('Month(invoice_details.created_at) as day'))
                            ->orderBy('day')
                            ->groupBy('day')
                            ->get();

                        }
        $data['trend'] = $trend;

        $data['category'] = InvoiceDetail::join('products','products.id','invoice_details.product_id')
                            ->join('categories','products.category_id','categories.id')
                            ->where('invoice_details.active',1)
                            ->select(DB::raw('sum(invoice_details.quantity*invoice_details.price) as total'),'categories.id','categories.name',DB::raw('count(invoice_details.id) as qty'))
                            ->groupBy('categories.id')
                            ->where(function($query) use($filter){
                                if($filter<=365 && $filter>0)
                                {
                                    $date = Carbon::now()->subDays($filter);
                                    return $query->where('invoice_details.created_at','>=',$date);
                                }
                                elseif($filter==0 || $filter=='')
                                {
                                    return $query;
                                }
                                else
                                {
                                    return $query->whereYear('invoice_details.created_at',$filter);
                                }
                            })
                            ->orderBy('total')
                            ->limit(4)
                            ->get();

        $data['total_category'] = Category::count();

        $data['all_user']  = User::where('active',1)->count();

        $data['total_product'] = InvoiceDetail::where('active',1)
                                ->where(function($query) use($filter){
                                    if($filter<=365 && $filter>0)
                                    {
                                        $date = Carbon::now()->subDays($filter);
                                        return $query->where('created_at','>=',$date);
                                    }
                                    elseif($filter==0 || $filter=='')
                                    {
                                        return $query;
                                    }
                                    else
                                    {
                                        return $query->whereYear('created_at',$filter);
                                    }
                                })
                                ->sum('quantity');

        $data['stock_in'] = Stock_in::where('active',1)->count();
        $data['stock_out'] = Stock_out::where('active',1)->count();

        $data['amount'] =Invoice::where('active',1)
                            ->where(function($query) use($filter){
                                if($filter<=365 && $filter>0)
                                {
                                    $date = Carbon::now()->subDays($filter);
                                    return $query->where('created_at','>=',$date);
                                }
                                elseif($filter==0 || $filter=='')
                                {
                                    return $query;
                                }
                                else
                                {
                                    return $query->whereYear('created_at',$filter);
                                }
                            })->sum('total_amount');

        $data['scrap'] = ScrapDetail::where('active',1)
                        ->where(function($query) use($filter){
                            if($filter<=365 && $filter>0)
                            {
                                $date = Carbon::now()->subDays($filter);
                                return $query->where('created_at','>=',$date);
                            }
                            elseif($filter==0 || $filter=='')
                            {
                                return $query;
                            }
                            else
                            {
                                return $query->whereYear('created_at',$filter);
                            }
                        })
                        ->sum('quantity');

        $data['total_invoice'] = Invoice::where('active',1)->where(function($query) use($filter){
                                if($filter<=365 && $filter>0)
                                {
                                    $date = Carbon::now()->subDays($filter);
                                    return $query->where('created_at','>=',$date);
                                }
                                elseif($filter==0 || $filter=='')
                                {
                                    return $query;
                                }
                                else
                                {
                                    return $query->whereYear('created_at',$filter);
                                }
                            })->count();

        return view('reports.index',$data);
    }

    public function stockOut(Request $request)
    {
        $filter='';
        if($request->filter=='alltime')
        {
            $request->filter=0;
        }

        Session::put('filter',0);
        if(!$request->filter & Session::get('filter'))
        {
            $filter = Session::get('filter');
        }
        elseif($request->filter)
        {

            Session::put('filter',$request->filter);

            $filter = Session::get('filter');
        }
        $data['stock_out'] = StockOutDetail::where('active',1)
                            ->where(function($query) use($filter)
                            {
                                if($filter<=365 && $filter>0)
                                {
                                    $date = Carbon::now()->subDays($filter);
                                    return $query->where('created_at','>=',$date);
                                }
                                elseif($filter==0 || $filter=='')
                                {
                                    return $query;
                                }
                                else
                                {
                                    return $query->whereYear('created_at',$filter);
                                }
                            })
                            ->select(DB::raw('sum(qty) as total'),'product_id')
                            ->groupBy('product_id')
                            ->get();

            return view('reports.stock_out',$data);
    }
    public function stockIn(Request $request)
    {
        $filter='';
        if($request->filter=='alltime')
        {
            $request->filter=0;
        }

        Session::put('filter',0);
        if(!$request->filter & Session::get('filter'))
        {
            $filter = Session::get('filter');
        }
        elseif($request->filter)
        {

            Session::put('filter',$request->filter);

            $filter = Session::get('filter');
        }
        $data['stock_out'] = Stock_in_detail::where('active',1)
                            ->where(function($query) use($filter)
                            {
                                if($filter<=365 && $filter>0)
                                {
                                    $date = Carbon::now()->subDays($filter);
                                    return $query->where('created_at','>=',$date);
                                }
                                elseif($filter==0 || $filter=='')
                                {
                                    return $query;
                                }
                                else
                                {
                                    return $query->whereYear('created_at',$filter);
                                }
                            })
                            ->select(DB::raw('sum(qty) as total'),'product_id')
                            ->groupBy('product_id')
                            ->get();

            return view('reports.stock_in',$data);
    }
}
