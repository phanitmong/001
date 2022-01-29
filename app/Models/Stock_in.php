<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_in extends Model
{
    use HasFactory;
    protected $fillable =['product_id','qty','description','user_id','IN_ID','in_date','puchase_no','reference_no'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function detail()
    {
        return $this->hasMany(Stock_in_detail::class)->where('active',1);
    }
}
