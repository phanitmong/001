<?php

namespace App\Models;

use App\Http\Controllers\Backend\StockOutController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_out extends Model
{
    use HasFactory;
    protected $fillable = ['OUT_ID','user_id','description','reference_no','out_date'];
    use HasFactory;

    public function detail()
    {
        return $this->hasMany(StockOutDetail::class)->where('active',1);
    }
}
