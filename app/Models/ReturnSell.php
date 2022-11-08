<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSell extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function contact(){
        return $this->belongsTo(Contact::class,'customer_id');
    }
    public function user(){
        return $this->belongsTo(Contact::class,'user_id');
    }
    public function sellBacks(){
        //return $this->hasMany(Comment::class);
        return $this->hasMany(sellBack::class,'return_id')->with('product');
    }
    public function Payment(){
        return $this->hasMany(Payment::class,'refer_id')->where('payment_type','6')->with('cash','Mcash','Bcash');
    }
}
