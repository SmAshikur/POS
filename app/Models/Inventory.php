<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function purchase(){
        return $this->belongsTo(Purchases::class,'purchases_id')->with('contact');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    // public function products(){
    //     return $this->hasMany(Product::class,'id');
    // }
}
