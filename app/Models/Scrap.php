<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    use HasFactory;
    protected $fillable = ['scrap_no','description','scrap_date','user_id'];

    public function detail()
    {
        return $this->hasMany(ScrapDetail::class)->where('active',1);
    }
}
