<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Stock_in_detail extends Model
{
    protected $fillable = ['stock_in_id','product_id','qty'];
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class)->where('active',1);
    }
}
