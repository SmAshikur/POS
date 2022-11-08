<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBack extends Model
{
    use HasFactory; 
    protected $guarded=[];

    public function ret(){
        return $this->belongsTo(ReturnProduct::class,'id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id')->with('inventory','inv');
    }
}
