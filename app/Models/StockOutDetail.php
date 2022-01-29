<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutDetail extends Model
{
    use HasFactory;
    protected $table =('stock_out_details');
    protected $fillable =['user_id','OUT_ID','description','active','stock_out_id','product_id','qty'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function stockOut()
    {
        return $this->hasOne(Stock_out::class);
    }
}
