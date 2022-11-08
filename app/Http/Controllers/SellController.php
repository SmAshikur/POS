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
use App\Models\Sell;
use App\Models\Sold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\Attributes\Node\Attributes;
class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Sell::orderBy('id', 'DESC')->with('contact')->get()->all();
        // dd($purchase);
          $cats = Category::get(['name','id'])->all();
         /// $product = product::select('id')->with('qty')->first();
       //  dd($product);
          //dd($product[1]->product->name);
          $brands = Brand::get(['name','id'])->all();
          $products = Contact::get()->all();
          return view('sell.sell',compact('products','brands','cats','purchase'));
    }
    public function getInvProduct(Request $request){
        // $name = Product::select('name')->get();
          $product = Product::with('inventory')->whereHas('inventory')
          ->where('name','LIKE','%'.$request->search."%")
          ->orWhere('bar_code',$request->search)
          ->get();
          return response()->json($product);

     }
     public function getQty ($id){
        $qty = Inventory::where('product_id',$id)->first();
        return response()->json($qty);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase = Sell::orderBy('id', 'DESC')->get()->all();
        // dd($purchase);
          $cats = Category::get(['name','id'])->all();
         /// $product = product::select('id')->with('qty')->first();
       //  dd($product);
          //dd($product[1]->product->name);
          $brands = Brand::get(['name','id'])->all();
          $products = Contact::get()->all();
          return view('sell.sellCreate',compact('products','brands','cats','purchase'));
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
            'customer_id'=>'required',
            'grand_total'=>'required',
            'invoice_no'=>'required|unique:purchases,invoice_no',
            'payment_method'=>'required',
            'grand_pay'=>'required',
        ]);
        $sell = new Sell();
        $sell->customer_id = $request->customer_id;
        $sell->user_id = Auth::user()->id;
        $sell->grand_total = $request->grand_total;
        $sell->payment_method = json_encode($request->payment_method);
        $sell->invoice_no = $request->invoice_no;
        $sell->grand_dis = $request->grand_dis;
        $sell->grand_before = $request->grand_before;
        $sell->grand_dew = $request->grand_dew;
        $sell->grand_pay = $request->grand_pay;
        //dd($sell);
        $sell->save();
        $lastId= Sell::orderBy('id', 'DESC')->first();
        $sellId =number_format($lastId->id);

        $dew= new Dew();
        if($request->grand_dew>0){
            $dew->reciver_id=$request->customer_id;
            $dew->user_id=Auth::user()->id;
            $dew->transication_id=$sellId;
            $dew->amount = $request->grand_dew;
            $dew->dew_type = 3;
            $dew->save();
        }
        $payment = new Payment();
        $payment->user_id=Auth::user()->id;
        $payment->refer_id=$sellId;
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
       // dd($product_id);
       //   $x= Inventory::where('id',$invId)->select('qty');
       $invId= $request->inv_id;
       $product_id=$request->product_id;
       $purchases_id=$request->purchase_id;
        for($i=0;$i<count($product_id);$i++){
            $product =[
                'sell_id'=> $sellId,
                'Inv_id'=> $invId[$i],
                'product_id'=> $product_id[$i],
                'purchases_id'=> $purchases_id[$i],
                'price'=>$request->price[$i],
                'sold_price'=>$request->sold_price[$i],
                'total_price'=>$request->total_price[$i],
                'qty'=>$request->qty[$i],
                'discount'=>$request->discount[$i],
               ];

               //dd($product);
            Sold::create($product);
            Inventory::find($invId[$i])->update(['qty'=> $request->new_qty[$i]]);

        }
       // return redirect()->back()->with('message','New Product Added Successfully');
        return response()->json($sell);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
        $pur = Sell::with(['sold','contact','user','payment'])->findOrFail($id);
        return response()->json($pur);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pur = Sell::with(['sold','contact'])->findOrFail($id);
        //$contacts = Inventory::with('product')->findOrFail($id);
        return response()->json($pur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'seller_id'=>'required',
            'grand_total'=>'required',
            //'dew'=>'required',
            //'pay'=>'required',
        ]);
        $sell = Sell::findOrFail($id);
       // $sell->customer_id = $request->seller_id;
        $sell->user_id = Auth::user()->id;
      //  $sell->payment_method = json_encode($request->payment_method);
      //  $sell->invoice_no = $request->invoice_no;
        $sell->grand_total =   ($request->pre_pay+$request->grand_dew+ $request->grand_pay)-$request->cash_back;
        $sell->grand_dis = $request->grand_dis;
        $sell->grand_before = $request->grand_before;
        $sell->grand_dew = $request->grand_dew;
        $sell->grand_pay = ($request->pre_pay+$request->grand_pay);
        //dd($sell);
        $sell->save();
       // $lastId= Sell::orderBy('id', 'DESC')->first();
      //  $sellId =number_format($lastId->id);
      $soldId= $request->sold_id;
      $invId= $request->inv_id;
      $product_id=$request->product_id;
      $purchases_id=$request->purchase_id;
       // dd($product_id);
    //   $x= Inventory::where('id',$invId)->select('qty');
        for($i=0;$i<count($product_id);$i++){
            $product =[
                'sell_id'=> $id,
                'Inv_id'=> $invId[$i],
                'product_id'=> $product_id[$i],
                'purchases_id'=> $purchases_id[$i],
                'price'=>$request->price[$i],
                'sold_price'=>$request->sold_price[$i],
                'total_price'=>$request->total_price[$i],
                'qty'=>$request->qty[$i],
                'discount'=>$request->discount[$i],
               ];
               if(isset($soldId[$i])){
                Sold::find($soldId[$i])->update($product) ;
                 }
                else
                { Sold::create($product);}
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
                $dew->dew_type = "sell";
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
        return response()->json($sell);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pur = Sell::find($id);
        $product_id= $pur->sold;
        dd($pur);
        $inventory_id= $pur->sold;
        if(!isset($id)){
            for($i=0;$i<count($product_id);$i++){
                  $product = Inventory::where('purchases_id',$id )->find( $pur->sold->product_id[$i]);
                  $product =[
                      //'purchases_id'=> $id,
                      'product_id'=> $product_id[$i],
                     // 'price'=>$ $pur->sold->price[$i],
                      'qty'=>$ $pur->sold->qty[$i],
                      //'target_price'=>$ $pur->sold->target_price[$i],
//'discount'=>$ $pur->sold->discount[$i],
                     ];
                  Inventory::where('product_id',$product_id[$i])->find($inventory_id[$i])->update($product);

                     //dd($product);
                     //Inventory::where('purchases_id',$id && 'product_id',$product_id[$i])->update($product);
              }
        }
        $pur->delete();
        $pur->sold()->delete();
        return redirect()->back()->with('message','New delete Added Successfully');
    }
}
