<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\BankPayment;
use App\Models\Brand;
use App\Models\CashPayment;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Dew;
use App\Models\Inventory;
use App\Models\MobilePayment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Purchases::with(['inventory','contact','user'])->orderBy('id', 'DESC')->get()->all();
      // dd($purchase);
        $contacts = Contact::get(['name','id'])->all();
        $cats = Category::get(['name','id'])->all();
        $brands = Brand::get(['name','id'])->all();
        $products = Contact::get()->all();
        return view('puschase.purchase',compact('products','brands','cats','purchase','contacts'));
    }
    public function getContact(){
        $contacts = Contact::get()->where('type',1);
        return response()->json($contacts);
    }
    public function getCustomer(){
        $contacts = Contact::get()->where('type',2);
        return response()->json($contacts);
    }

    public function getProduct(Request $request){
       // $name = Product::select('name')->get();
           $product = Product::where('name','LIKE','%'.$request->search."%")
           ->orWhere('bar_code',$request->search)
           ->get();
         return response()->json($product);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase = Purchases::with(['inventory','contact','user'])->orderBy('id', 'DESC')->get()->all();
        // dd($purchase);
          $cats = Category::get(['name','id'])->all();
          $brands = Brand::get(['name','id'])->all();
          $products = Contact::get()->all();
          return view('puschase.purchaseCreate',compact('products','brands','cats','purchase'));
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
            'pay'=>'required',
        ]);
        //$balance= Balance::sum('cash_balance','+','mobile_balance','+','')
        $purchase = new Purchases();
        $purchase->user_id = Auth::user()->id;
        $purchase->seller_id = $request->seller_id;
        $purchase->grand_total = $request->grand_total;
        $purchase->payment_method = json_encode($request->payment_method);
        $purchase->grand_before =$request->grand_before;
        $purchase->grand_dis =$request->grand_dis;
        $purchase->invoice_no = $request->invoice_no;
        $purchase->grand_dew = $request->dew;
        $purchase->grand_pay =  $request->pay;
        // if($request->dew>0){
        //     $purchase->dew_id = 1;
        // }
        //dd($purchase);
        $purchase->save();
        $lastId= Purchases::orderBy('id', 'DESC')->first();
        $purcaseId =number_format($lastId->id);
        $product_id= $request->p_id;
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->refer_id=$purcaseId;
        $payment->cash_total=$request->cash_total;
        $payment->payment_method=json_encode($request->payment_method);
        $payType= $request->payment_type;
        $payment->payment_type=$request->payment_type;
        $payment->save();
        $lastPayId= Payment::orderBy('id', 'DESC')->first();
        $paymentId =number_format($lastPayId->id);
        $total =$request->cash_amount+ $request->mobile_amount + $request->bank_amount;
        if($request->pay>0){
            $balance= new Balance();
            $balance->payment_id= $paymentId;
            if($total>0){
                $balance->total= $total;
            }
            $balance->is_In= 'out';
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
       // dd($product_id);
        for($i=0;$i<count($product_id);$i++){
            $product =[
                'purchases_id'=> $purcaseId,
                'product_id'=> $product_id[$i],
                'qty'=>$request->qty[$i],
                'price'=>$request->price[$i],
                'target_price'=>$request->target_price[$i],
                'total_price'=>$request->total_price[$i],
                'profit'=>$request->profit[$i],
                'discount'=>$request->discount[$i],
               ];
               //dd($product);
               Inventory::create($product);
              // Product::find($product_id[$i])->update('qty','=>',$request->qty[$i],);
        }
        if($request->dew>0){
            $dew= new Dew();
            $dew->reciver_id=$request->seller_id;
            $dew->user_id=Auth::user()->id;
            $dew->transication_id=$purcaseId;
            $dew->amount = $request->dew;
            $dew->dew_type = 4;
            $dew->save();
        }


//$balance->save();
       //dd($purchase);
       // return redirect()->back()->with('message','New Product Added Successfully');
        return response()->json($purchase);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pur = Purchases::with(['inventory','contact','user','payment'])->findOrFail($id);
        return response()->json($pur);
    }
    public function invoice (Request $request, $id){

        $pur = Purchases::with(['inventory','contact'])->findOrFail($id);
        //dd($pur);
        ////if($request->has('download')){

          //  $pdf = PDF::loadView('puschase.parchaseShow',compact('pur'));
          //  return $pdf->stream('invoice.pdf');
       // }
     //  return view('puschase.parchaseShow');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pur = Purchases::with(['inventory','contact','user','cash','Mcash','Bcash'])->findOrFail($id);
        //$contacts = Inventory::with('product')->findOrFail($id);
        return response()->json($pur);
       // return view('puschase.purchase',compact('pur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'seller_id'=>'required',
            'grand_total'=>'required',
            'dew'=>'required',
        ]);
        $purchase = Purchases::findOrFail($id);
        $purchase->user_id = Auth::user()->id;
        $purchase->seller_id = $request->seller_id;
        $purchase->grand_total = ($request->pre_pay+$request->grand_dew+ $request->grand_pay)-$request->cash_back;
        $purchase->payment_method = json_encode($request->payment_method);
        $purchase->grand_before =$request->grand_before;
        $purchase->grand_dis =$request->grand_dis;
        $purchase->grand_dew = $request->grand_dew;
        $purchase->grand_pay = ($request->pre_pay+$request->grand_pay);
        //dd($purchase);
        $purchase->save();
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
            $balance->is_In= 'out';
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

        // $payLastId= Payment::orderBy('id', 'DESC')->first();
        // $paymentId =number_format($payLastId->id);
        $dew= Dew::where('transication_id',$id)->first();
        if( isset($dew)){
            if($request->dew<=0){
                $dew->amount = $request->dew;
                $dew->status = 1;
                $dew->save();
            }else{
                $dew->amount = $request->dew;
                $dew->status = 0;
                $dew->save();
            }
        }else{
            if($request->dew>0){
                $dew->reciver_id=$request->seller_id;
                $dew->user_id=Auth::user()->id;
                $dew->transication_id=$id;
                $dew->amount = $request->dew;
                $dew->dew_type = 4;
                $dew->save();
            }
        }

     // $lastId= Purchases::orderBy('id', 'DESC')->first();
      //  $invId =number_format($lastId->id);
        $product_id= $request->p_id;
        $inventory_id= $request->inventory_id;
       // if(!isset($id)){
            for($i=0;$i<count($product_id);$i++){
                //  $product = Inventory::where('purchases_id',$id )->find($product_id[$i]);
                  $product =[
                    'purchases_id'=> $id,
                    'product_id'=> $product_id[$i],
                    'qty'=>$request->qty[$i],
                    'price'=>$request->price[$i],
                    'target_price'=>$request->target_price[$i],
                    'total_price'=>$request->total_price[$i],
                    'profit'=>$request->profit[$i],
                    'discount'=>$request->discount[$i],
                     ];
                     if(isset($inventory_id[$i])){
                            Inventory::find($inventory_id[$i])->update($product) ;
                        }
                    else
                            { Inventory::create($product);}
                   // Product::find($product_id[$i])->update('qty','=>',$request->qty[$i],);
                     //dd($product);
                     //Inventory::where('purchases_id',$id && 'product_id',$product_id[$i])->update($product);
              }
       // }
        //return redirect()->back()->with('message','New Product Added Successfully');
        return response()->json($purchase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchases $purchases)
    {
        //
    }
}
