<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function add($id,$qty)
    {
        Product::where('id',$id)->increment('qty',$qty);
    }
    public static function sub($id,$qty)
    {
        Product::where('id',$id)->decrement('qty',$qty);
    }




    public static function get_kh_num($n)
    {

        $kh = ["០","១","២","៣","៤","៥","៦","៧","៨","៩"];
        $result = "";
        $n = $n . "";
        for($i=0;$i<strlen($n);$i++)
        {
            $index = (int)$n[$i];
            $result .= $kh[$index];
        }
        return $result;
    }
    public static function get_kh_date($date)
    {
        // $data = date_create($date);
        $y = date_format(date_create($date), 'Y');
        $m = date_format(date_create($date), 'm');
        $d = date_format(date_create($date), 'd');
        $result = Self::get_kh_num($d) . '-' . Self::get_kh_num($m) . '-' . Self::get_kh_num($y);
        return $result;
    }

}
