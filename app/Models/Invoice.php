<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable =['invoice_no','user_id','total_amount'];

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class)->where('active',1);
    }
}
