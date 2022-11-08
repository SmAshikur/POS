<?php
namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\BankPayment;
use App\Models\CashPayment;
use App\Models\Contact;
use App\Models\Dew;
use App\Models\MobilePayment;
use App\Models\Payment;
use App\Models\Purchases;
use App\Models\ReturnProduct;
use App\Models\ReturnSell;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DewController extends Controller
{
    public function index()
    {
        $dew = Contact::wherehas('dewPurchase')->with('dewPurchase')->get();
        return view('dew.dewList',compact('dew'));
    }
    public function indexTwo()
    {
        $dew = Contact::wherehas('dewSell')->with('dewSell')->get();
        return view('dew.dewListTwo',compact('dew'));

    }
    public function indexThree()
    {
        $dew = Contact::wherehas('dewReturn')->with('dewReturn')->get();
        return view('dew.dewListThree',compact('dew'));
    }
    public function indexFour()
    {
        $dew = Contact::wherehas('dewBack')->with('dewBack')->get();
        return view('dew.dewListFour',compact('dew'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dew  $dew
     * @return \Illuminate\Http\Response
     */
    public function show(Dew $dew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dew  $dew
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dew = Dew::with('contact')->findOrFail($id);
        return response()->json($dew);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dew  $dew
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request,[
            'payment_method'=>'required',
           // 'amount'=>'required'
        ]);
        $refId= number_format($request->pur_id);
       $payType= $request->payment_type;
       if($payType==4){
        $pur = Purchases::find($refId);
        $pay = number_format(Purchases::find($refId)->first()->grand_pay);
       }else  if($payType==3){
        $pur = Sell::find($refId);
        $pay = number_format(Sell::find($refId)->first()->grand_pay);
       }else  if($payType==6){
        $pur = ReturnProduct::find($refId);
        $pay = number_format(ReturnProduct::find($refId)->first()->grand_pay);
       }else  if($payType==5){
        $pur = ReturnSell::find(1);
        $pay = number_format(ReturnSell::find($refId)->first()->grand_pay);
       }

       //$due = number_format(Purchases::where('id',$refId)->first()->grand_dew);
       if($request->cash_total>0){
        $dew = Dew::find($id);
        if($request->new_dew>0){
            $dew->amount=$request->grand_total - $request->cash_total;
            $dew->save();
            if($payType==4 || $payType == 3){
                $pur->grand_pay = $pay+$request->cash_total;
                $pur->grand_dew = $request->grand_total - $request->cash_total;
            }else{
                $pur->return_pay = $pay+$request->cash_total;
                $pur->return_dew = $request->grand_total - $request->cash_total;
            }
        }else if($request->new_dew == 0){
            $dew->amount=$request->new_dew;
            $dew->status=1;
            $dew->save();
            if($payType==4 || $payType == 3){
                $pur->grand_pay = $pay+$request->cash_total;
                $pur->grand_dew = $request->grand_total - $request->cash_total;
            }else{
                $pur->return_pay = $pay+$request->cash_total;
                $pur->return_dew = $request->grand_total - $request->cash_total;
            }
        }
        $pur->save();
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->refer_id=$request->pur_id;
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
            $balance->is_In=$payType== 4 || $payType == 6 ?'out':'in';
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
                $mobilePay = new MobilePayment ();
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
        return response()->json($dew);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dew  $dew
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dew $dew)
    {
        //
    }
}
