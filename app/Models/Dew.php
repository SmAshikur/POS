<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dew extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function contact(){
        return $this->belongsTo(Contact::class,'user_id');
    }
    public function purchase(){
        return $this->belongsTo(Purchases::class,'transication_id');
    }
    public function sell(){
        return $this->belongsTo(Sell::class,'transication_id');
    }
    public function return(){
        return $this->belongsTo(ReturnProduct::class,'transication_id');
    }
    public function back(){
        return $this->belongsTo(ReturnSell::class,'transication_id');
    }
    // public function expense(){
    //     return $this->belongsTo(Expenses::class,'transication_id')->where('payment_type','expense');
    // }
}
