<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    public function contact(){
        return $this->belongsTo(Contact::class,'customer_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function sold(){
        //return $this->hasMany(Comment::class);
        return $this->hasMany(Sold::class,'sell_id')->with('product');
    }
    public function Payment(){
        return $this->hasMany(Payment::class,'refer_id')->where('payment_type','3')->with('cash','Mcash','Bcash');
    }

}
