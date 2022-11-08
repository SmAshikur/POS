<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\BankPayment;
use App\Models\CashPayment;
use App\Models\Dew;
use App\Models\Inventory;
use App\Models\MobilePayment;
use App\Models\Payment;
use App\Models\Purchases;
use App\Models\ReturnBack;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $back = ReturnProduct::with('contact')->get()->all();
        $keys = Purchases::with('inventory')->get();
        $purchases = Purchases::get();
        //dd($back);
        return view('puschase.purchaseReturn',compact('back','keys','purchases'));
    }
    public function getRtnProduct (Request $request){
        $product = Purchases::with('inventory','contact')
        ->where('id',$request->id)
        ->first();
      return response()->json($product);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bac= ReturnProduct::get()->all();
        $purchases = Purchases::get();
        //dd($purchases);
        return view('puschase.purchaseReturnCreate',compact('purchases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'seller_id'=>'required',
            'grand_total'=>'required',
            'invoice_no'=>'required|unique:purchases,invoice_no',
            'payment_method'=>'required',
            'grand_pay'=>'required',
        ]);
        $back = new ReturnProduct();
        $back->seller_id = $request->seller_id;
        $back->user_id = Auth::user()->id;
        $back->payment_method = json_encode($request->payment_method);
        $back->invoice_no = $request->invoice_no;
        $back->return_total = $request->grand_total;
        $back->return_before = $request->grand_total;
        $back->return_dew = $request->grand_dew;
        $back->return_pay = $request->grand_pay;
        //dd($back);
        $back->save();
        $lastId= ReturnProduct::orderBy('id', 'DESC')->first();
        $backId =number_format($lastId->id);
        $dew= new Dew();
        if($request->grand_dew>0){
            $dew->reciver_id=$request->seller_id;
            $dew->user_id=Auth::user()->id;
            $dew->transication_id=$backId;
            $dew->amount = $request->grand_dew;
            $dew->dew_type = 6;
            $dew->save();
        }
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->refer_id=$backId;
        $payment->cash_total=$request->cash_total;
        $payment->payment_method=json_encode($request->payment_method);
        $payType= $request->payment_type;
        $payment->payment_type=$request->payment_type;
        $payment->save();
        $lastPayId= Payment::orderBy('id', 'DESC')->first();
        $paymentId =number_format($lastPayId->id);
        $total =$request->cash_amount+ $request->mobile_amount + $request->bank_amount;
        if($request->grand_pay>0){
            $balance= new Balance();
            $balance->payment_id= $paymentId;
            if($total>0){
                $balance->total= $total;
            }
            $balance->is_In= 'in';
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
        }
        $invId= $request->inv_id;
        $product_id=$request->product_id;
        $purchase_id=$request->purchase_id;

       // dd($product_id);
       //   $x= Inventory::where('id',$invId)->select('qty');
        for($i=0;$i<count($invId);$i++){
            $product =[
                'return_id'=> $backId,
                'inv_id'=> $invId[$i],
                'product_id'=> $product_id[$i],
                'purchase_id'=> $purchase_id[$i],
                'price'=>$request->price[$i],
                'return_price'=>$request->return_price[$i],
                'total_price'=>$request->total_price[$i],
                'qty'=>$request->qty[$i],
               ];

               //dd($product);
            ReturnBack::create($product);
            Inventory::find($invId[$i])
            ->update(['qty'=> $request->new_qty[$i]]);
        }
       // return redirect()->back()->with('message','New Product Added Successfully');
        return response()->json($back);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pur = ReturnProduct::with(['backs','contact','user','payment'])->findOrFail($id);
        return response()->json($pur);
        //dd($pur);
       // return view('puschase.parchaseReturnShow',compact('pur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $back = ReturnProduct::with((['backs','contact']))->find($id);
     return response()->json($back);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'seller_id'=>'required',
            'grand_total'=>'required',
           // 'dew'=>'required',
            //'pay'=>'required',
        ]);
        $back = ReturnProduct::find($id);
        $back->seller_id = $request->seller_id;
        $back->user_id = Auth::user()->id;
        $back->return_total =($request->pre_pay+$request->grand_dew+ $request->grand_pay)-$request->cash_back;
        $back->payment_method = json_encode($request->payment_method);
        $back->return_before =$request->grand_before;
        $back->return_dew = $request->grand_dew;
        $back->return_pay = ($request->pre_pay+$request->grand_pay);
        //dd($back);
        $back->save();
      //  $lastId= ReturnProduct::orderBy('id', 'DESC')->first();
       // $backId =number_format($lastId->id);
        $backsId= $request->backs_id;
        $invId= $request->inv_id;
        $product_id=$request->product_id;
        $purchase_id=$request->purchase_id;

       // dd($product_id);
       //   $x= Inventory::where('id',$backsId)->select('qty');
        for($i=0;$i<count($product_id);$i++){
            $product =[
                'return_id'=> $id,
                'inv_id'=> $request->inv_id[$i],
                'product_id'=> $product_id[$i],
                'purchase_id'=> $purchase_id[$i],
                'price'=>$request->price[$i],
                'return_price'=>$request->return_price[$i],
                'total_price'=>$request->total_price[$i],
                'qty'=>$request->qty[$i],
               ];
               if(isset($backsId[$i])){
                ReturnBack::find($backsId[$i])->update($product) ;
                 }
                else
                { ReturnBack::create($product);}
            Inventory::find($invId[$i])->update(['qty'=> $request->new_qty[$i]]);

        }
        $dew= Dew::where('transication_id',$id)->first();
        if( isset($dew)){
            if($request->grand_dew<=0){
                $dew->amount = $request->grand_dew;
                $dew->status = 1;
                $dew->save();
            }else{
                $dew->amount = $request->grand_dew;
                $dew->status = 0;
                $dew->save();
            }
        }else{
            $dew = new Dew();
            if($request->grand_dew>0){
                $dew->reciver_id=$request->seller_id;
                $dew->user_id=Auth::user()->id;
                $dew->transication_id=$id;
                $dew->amount = $request->grand_dew;
                $dew->dew_type = 5;
                $dew->save();
            }
        }
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->refer_id=$id;
        $payment->cash_total=$request->cash_total;
        $payment->payment_method=json_encode($request->payment_method);
        $payType= $request->payment_type;
        $payment->payment_type=$request->payment_type;
        $payment->save();
        $lastPayId= Payment::orderBy('id', 'DESC')->first();
        $paymentId =number_format($lastPayId->id);
        $total =$request->cash_amount+ $request->mobile_amount + $request->bank_amount;
        if($request->grand_pay>0){
            $balance= new Balance();
            $balance->payment_id= $paymentId;
            if($total>0){
                $balance->total= $total;
            }
            $balance->is_In= 'in';
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
        }

       // return redirect()->back()->with('message','New Product Added Successfully');
        return response()->json($back);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnProduct $returnProduct)
    {
        //
    }
}
