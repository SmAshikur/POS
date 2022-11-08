<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model
{
    use HasFactory;
    public function dewPurchase(){
        return $this->hasMany(Dew::class,'reciver_id')->where('amount','>',0)->where('dew_type','4')->with('purchase');
    }
    public function dewSell(){
        return $this->hasMany(Dew::class,'reciver_id')->where('amount','>',0)->where('dew_type','3')->with('sell');
    }
    public function dewReturn(){
        return $this->hasMany(Dew::class,'reciver_id')->where('amount','>',0)->where('dew_type','6')->with('return');
    }
    public function dewBack(){
        return $this->hasMany(Dew::class,'reciver_id')->where('amount','>',0)->where('dew_type','5')->with('back');
    }
}
