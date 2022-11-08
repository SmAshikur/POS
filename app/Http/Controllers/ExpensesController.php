<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\BankPayment;
use App\Models\CashPayment;
use App\Models\Expenses;
use App\Models\MobilePayment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses= Expenses::get()->all();
        return view('expenses.expenses',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.addExpenses');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expenses =new Expenses();
        $expenses->expense=$request->expense;
        $expenses->expense_category=$request->expense_category;
       // dd($expenses);
        $expenses->save();
        $lastExId= Expenses::orderBy('id', 'DESC')->first();
        $exId =number_format($lastExId->id);
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->refer_id=$request->$exId;
        $payment->cash_total=$request->cash_total;
        $payment->payment_method=json_encode($request->payment_method);
        $payment->payment_type=$request->payment_type;
        $payment->save();
        $lastPayId= Payment::orderBy('id', 'DESC')->first();
        $paymentId =number_format($lastPayId->id);
        $total =$request->cash_amount+ $request->mobile_amount + $request->bank_amount;
        if($request->cash_total>0){
            $balance= new Balance();
            $balance->payment_id= $paymentId;
            if($total>0){
                $balance->total= $total;
            }
            $balance->is_In='out';
            if($request->cash_amount>0){
                // $balance->cash_balance=$payType=="1"||$payType=="3"||$payType=="5"  ? $cash+$request->cash_amount: $cash - $request->cash_amount;
                $balance->cash_balance=$request->cash_amount;
                $cashPay = new CashPayment();
                 $cashPay->refer_id=$paymentId;
                 $cashPay->note=$request->note;
                 $cashPay->cash_amount=$request->cash_amount;
                 $cashPay->save();
             }
             if($request->mobile_amount>0){
                // $balance->mobile_balance=$request->$payType=="1"||$payType=="3"||$payType=="5"  ? $Mcash+$request->mobile_amount: $Mcash-$request->mobile_amount;
                $balance->mobile_balance= $request->mobile_amount;
                $mobilePay = new MobilePayment();
                 $mobilePay->refer_id=$paymentId;
                 $mobilePay->cash_mobile_no=$request->cash_mobile_no;
                 $mobilePay->transition_id=$request->transition_id;
                 $mobilePay->mobile_amount=$request->mobile_amount;
                 $mobilePay->save();
             }
             if($request->bank_amount>0){
                // $balance->mobile_balance=$request->$payType=="1"||$payType=="3"||$payType=="5"  ? $Bcash+$request->bank_amount:$Bcash-$request->bank_amount;
                 $bankPay = new BankPayment();
                 $balance->bank_balance=$request->bank_amount;
                 $bankPay->refer_id=$paymentId;
                 $bankPay->acc_no=$request->acc_no;
                 $bankPay->acc_type=$request->acc_type;
                 $bankPay->bank_amount=$request->bank_amount;
                 $bankPay->save();
             }
             $balance->save();
        }
        return redirect()->back()->with('message','Expenses Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenses = Expenses::find($id);
        return response()->json($expenses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expenses = Expenses::find($id);
        $expenses->expense=$request->expense;
        $expenses->expense_category=$request->expense_category;
       // dd($expenses);
        $expenses->save();
        return response()->json($expenses);
       // return redirect()->back()->with('message','Expenses update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }
}
