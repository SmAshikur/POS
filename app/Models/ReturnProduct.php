<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function contact(){
        return $this->belongsTo(Contact::class,'seller_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function backs(){
        //return $this->hasMany(Comment::class);
        return $this->hasMany(ReturnBack::class,'return_id')->with('product');
    }
    public function Payment(){
        return $this->hasMany(Payment::class,'refer_id')->where('payment_type','5')->with('cash','Mcash','Bcash');
    }
}
