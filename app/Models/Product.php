<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','qty','cat_id','brand_id','image'];

    public function category(){
        return $this->belongsTo('App\models\Category','cat_id');
    }
    public function brand(){
        return $this->belongsTo('App\models\Brand','brand_id');
    }
    public function inventory(){
        return $this->hasOne(Inventory::class,'product_id')->with('purchase')->where('qty','>=','1');
    }
    public function sold(){
        return $this->hasOne(Sold::class,'product_id')->with('sell');
    }
    public function backs(){
        return $this->hasOne(ReturnBack::class,'product_id');
    }
    public function inv(){
        return $this->hasOne(Inventory::class,'product_id')->with('purchase');
    }

}
