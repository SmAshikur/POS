<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cash=Balance::where('is_in','in')->sum('cash_balance')
        -Balance::where('is_in','out')->sum('cash_balance');
        $mobile=Balance::where('is_in','in')->sum('mobile_balance')
        -Balance::where('is_in','out')->sum('mobile_balance');
        $bank=Balance::where('is_in','in')->sum('bank_balance')
        -Balance::where('is_in','out')->sum('bank_balance');
        $balance= $cash+$bank+$mobile;
        $pays = Balance::with('payment')->orderBy('id','DESC')->get();
        //dd($);
        return view('balance.balance',compact('balance','cash','mobile','bank','pays'));
    }

    public function getCash(){
        $cash=Balance::where('is_in','in')->sum('cash_balance')
        -Balance::where('is_in','out')->sum('cash_balance');
        return response()->json($cash);
    }
    public function getMobileCash(){
        $mobile=Balance::where('is_in','in')->sum('mobile_balance')
        -Balance::where('is_in','out')->sum('mobile_balance');
        return response()->json($mobile);
    }
    public function getBankCash(){
        $bank=Balance::where('is_in','in')->sum('bank_balance')
        -Balance::where('is_in','out')->sum('bank_balance');
        return response()->json($bank);
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
        // $this->validate($request,[
        //     'amount'=>'required',
        //     'cash_type'=>'required',
        // ]);
        // $balance = new Balance();
        // $balance->amount = $request->amount;
        // $balance->cash_type = $request->cash_type;
        // $balance->user_id =Auth::user()->id;
        // $balance->balance_in='in';
        // $balance->save();
        // return response() ->json($balance);
        //return redirect()->back()->with('message','Balance added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }
}
