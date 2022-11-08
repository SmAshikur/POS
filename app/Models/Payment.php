<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function purchase(){
        return $this->belongsTo(Purchases::class,'refer_id')->where('payment_type','4');
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
