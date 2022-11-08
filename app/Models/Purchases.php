<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{

    use HasFactory;
    protected $guarded = [];
    public function contact(){
        return $this->belongsTo(Contact::class,'seller_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function inventory(){
        //return $this->hasMany(Comment::class);
        return $this->hasMany(Inventory::class,'purchases_id')->with('product');
    }
    public function invn(){
        return $this->hasOne(Inventory::class,'purchases_id')->with('product')->where('qty','>=','1');
    }
    public function Payment(){
        return $this->hasMany(Payment::class,'refer_id')->where('payment_type','4')->with('cash','Mcash','Bcash');
    }
    public function cash(){
        return $this->hasOne(CashPayment::class,'refer_id');
    }
    public function Mcash(){
        return $this->hasOne(MobilePayment::class,'refer_id');
    }
    public function Bcash(){
        return $this->hasOne(BankPayment::class,'refer_id');
    }
}
