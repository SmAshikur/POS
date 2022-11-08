<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function sell(){
        return $this->belongsTo(Sell::class,'id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id')->with('inventory','inv');
    }

}
