<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\BankPayment;
use App\Models\CashPayment;
use App\Models\MobilePayment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Payment.paymentRecord');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->cash_total=$request->cash_total;
        $payment->payment_method=json_encode($request->payment_method);
        $payType= $request->payment_type;
        $payment->payment_type=$request->payment_type;
        $payment->save();
        $lastPayId= Payment::orderBy('id', 'DESC')->first();
        $paymentId =number_format($lastPayId->id);
        $total =$request->cash_amount+ $request->mobile_amount + $request->bank_amount;
        //dd($total);
        $balance= new Balance();
            $balance->payment_id= $paymentId;
            if($total>0){
                $balance->total= $total;
            }
            if($payType == 1 || $payType == 3 || $payType == 5){
                $balance->is_In= 'in';
            } else if($payType == 2 || $payType == 4 || $payType == 6){
                $balance->is_In= 'out';
            }
            if($request->cash_amount>0){
               // $balance->cash_balance=$payType=="1"||$payType=="3"||$payType=="5"  ? $cash+$request->cash_amount: $cash - $request->cash_amount;
               $balance->cash_balance=$request->cash_amount;
               $cashPay = new CashPayment ();
                $cashPay->refer_id=$paymentId;
                $cashPay->note=$request->note;
                $cashPay->cash_amount=$request->cash_amount;
                $cashPay->save();
            }
            if($request->mobile_amount>0){
               // $balance->mobile_balance=$request->$payType=="1"||$payType=="3"||$payType=="5"  ? $Mcash+$request->mobile_amount: $Mcash-$request->mobile_amount;
               $balance->mobile_balance= $request->mobile_amount;
               $mobilePay = new MobilePayment ();
                $mobilePay->refer_id=$paymentId;
                $mobilePay->cash_mobile_no=$request->cash_mobile_no;
                $mobilePay->transition_id=$request->transition_id;
                $mobilePay->mobile_amount=$request->mobile_amount;
                $mobilePay->save();
            }
            if($request->bank_amount>0){
               // $balance->mobile_balance=$request->$payType=="1"||$payType=="3"||$payType=="5"  ? $Bcash+$request->bank_amount:$Bcash-$request->bank_amount;
                $bankPay = new BankPayment ();
                $balance->bank_balance=$request->bank_amount;
                $bankPay->refer_id=$paymentId;
                $bankPay->acc_no=$request->acc_no;
                $bankPay->acc_type=$request->acc_type;
                $bankPay->bank_amount=$request->bank_amount;
                $bankPay->save();
            }
            $balance->save();
            return response()->json();
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
