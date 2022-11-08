<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Contact;
use App\Models\Inventory;
use App\Models\Purchases;
use App\Models\ReturnBack;
use App\Models\ReturnProduct;
use App\Models\ReturnSell;
use App\Models\Sell;
use App\Models\sellBack;
use App\Models\Sold;
use App\Models\Total;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {

        $data= 'All time';
        $dateOne = Carbon::now()->subDays(1);
        $dateTwo = Carbon::now()->subDays(2);
        $week = Carbon::now()->subDays(7);
        $months = Carbon::now()->subDays(30);
        $year = Carbon::now()->subDays(365);

        if($req->data == 'oneDay'){
            $data="Last Day's ";
           // $total= Balance::get()->where('created_at', '>=', $dateOne)->pluck('amount')->sum();
            $purchase= Purchases::get()->where('created_at', '>=', $dateOne)->pluck('grand_total')->sum();
            $sell= Sell::get()->where('created_at', '>=', $dateOne)->pluck('grand_total')->sum();
            $purchaseQty= Inventory::get()->where('created_at', '>=', $dateOne)->pluck('qty')->sum();
            $sellQty= Sold::get()->where('created_at', '>=', $dateOne)->pluck('qty')->sum();
            $purBackQty= ReturnBack::get()->where('created_at', '>=', $dateOne)->pluck('qty')->sum();
            $sellBackQty= sellBack::get()->where('created_at', '>=', $dateOne)->pluck('qty')->sum();
           // $purBackQty= ReturnBack::get()->where('created_at', '>=', $dateOne)->pluck('qty')->sum();
            $suplier= Contact::get()->where('type',1)->where('created_at', '>=', $dateOne)->count('id');
            $customer= Contact::get()->where('type',2)->where('created_at', '>=', $dateOne)->count('id');
            $invoiceP= Purchases::where('created_at', '>=', $dateOne)->count('id');
            $invoiceS= Sell::where('created_at', '>=', $dateOne)->count('id');
            $invoiceRP= ReturnProduct::where('created_at', '>=', $dateOne)->count('id');
            $invoiceRS =ReturnSell::where('created_at', '>=', $dateOne)->count('id');
            return view('home',compact('purchase','sell','data','purchaseQty','sellQty',
            'sellBackQty','purBackQty','suplier','customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        }else if($req->data == 'twoDay'){
            $data="Last Two Day's ";
          //  $total= Balance::get()->where('created_at', '>=', $dateTwo)->pluck('amount')->sum();
            $purchase= Purchases::get()->where('created_at', '>=', $dateTwo)->pluck('grand_total')->sum();
            $sell= Sell::get()->where('created_at', '>=', $dateTwo)->pluck('grand_total')->sum();
            $purchaseQty= Inventory::get()->where('created_at', '>=', $dateTwo)->pluck('qty')->sum();
            $sellQty= Sold::get()->where('created_at', '>=', $dateTwo)->pluck('qty')->sum();
            $purBackQty= ReturnBack::get()->where('created_at', '>=', $dateTwo)->pluck('qty')->sum();
            $sellBackQty= sellBack::get()->where('created_at', '>=', $dateTwo)->pluck('qty')->sum();
            $suplier= Contact::get()->where('type',1)->where('created_at', '>=', $dateTwo)->count('id');
            $customer= Contact::get()->where('type',2)->where('created_at', '>=', $dateTwo)->count('id');
            $invoiceP= Purchases::where('created_at', '>=', $dateTwo)->count('id');
            $invoiceS=  Sell::where('created_at', '>=', $dateTwo)->count('id');
            $invoiceRP=  ReturnProduct::where('created_at', '>=', $dateTwo)->count('id');
            $invoiceRS =  ReturnSell::where('created_at', '>=', $dateTwo)->count('id');
            return view('home',compact('purchase','sell','data','purchaseQty','sellQty',
            'sellBackQty','purBackQty','suplier','customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        }
        else if($req->data == 'week'){
            $data="Last Week's ";
          //  $total= Balance::get()->where('created_at', '>=', $week)->pluck('amount')->sum();
            $purchase= Purchases::get()->where('created_at', '>=', $week)->pluck('grand_total')->sum();
            $sell= Sell::get()->where('created_at', '>=', $week)->pluck('grand_total')->sum();
            $purchaseQty= Inventory::get()->where('created_at', '>=', $week)->pluck('qty')->sum();
            $sellQty= Sold::get()->where('created_at', '>=', $week)->pluck('qty')->sum();
            $purBackQty= ReturnBack::get()->where('created_at', '>=', $week)->pluck('qty')->sum();
            $sellBackQty= sellBack::get()->where('created_at', '>=', $week)->pluck('qty')->sum();
            $suplier= Contact::get()->where('type',1)->where('created_at', '>=', $week)->count('id');
            $customer= Contact::get()->where('type',2)->where('created_at', '>=', $week)->count('id');
            $invoiceP= Purchases::where('created_at', '>=', $week)->count('id');
            $invoiceS= Sell::where('created_at', '>=', $week)->count('id');
            $invoiceRP= ReturnProduct::where('created_at', '>=', $week)->count('id');
            $invoiceRS = ReturnSell::where('created_at', '>=', $week)->count('id');
            return view('home',compact('purchase','sell','data','purchaseQty','sellQty',
            'sellBackQty','purBackQty','suplier','customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        }
        else if($req->data == 'month'){
            $data="Last Month's ";
           // $total= Balance::get()->where('created_at', '>=', $months)->pluck('amount')->sum();
            $purchase= Purchases::get()->where('created_at', '>=', $months)->pluck('grand_total')->sum();
            $sell= Sell::get()->where('created_at', '>=', $months)->pluck('grand_total')->sum();
            $purchaseQty= Inventory::get()->where('created_at', '>=', $months)->pluck('qty')->sum();
            $sellQty= Sold::get()->where('created_at', '>=', $months)->pluck('qty')->sum();
            $purBackQty= ReturnBack::get()->where('created_at', '>=', $months)->pluck('qty')->sum();
            $sellBackQty= sellBack::get()->where('created_at', '>=', $months)->pluck('qty')->sum();
            $suplier= Contact::get()->where('type',1)->where('created_at', '>=', $months)->count('id');
            $customer= Contact::get()->where('type',2)->where('created_at', '>=', $months)->count('id');
            $invoiceP= Purchases::where('created_at', '>=', $months)->count('id');
            $invoiceS= Sell::where('created_at', '>=', $months)->count('id');
            $invoiceRP= ReturnProduct::where('created_at', '>=', $months)->count('id');
            $invoiceRS = ReturnSell::where('created_at', '>=', $months)->count('id');
            return view('home',compact('purchase','sell','data','purchaseQty','sellQty',
            'sellBackQty','purBackQty','suplier','customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        }else if($req->data == 'year'){
            $data="Last Year's ";
        //    $total= Balance::get()->where('created_at', '>=', $year)->pluck('amount')->sum();
            $purchase= Purchases::get()->where('created_at', '>=', $year)->pluck('grand_total')->sum();
            $sell= Sell::get()->where('created_at', '>=', $year)->pluck('grand_total')->sum();
            $purchaseQty= Inventory::get()->where('created_at', '>=', $year)->pluck('qty')->sum();
            $sellQty= Sold::get()->where('created_at', '>=', $year)->pluck('qty')->sum();
            $purBackQty= ReturnBack::get()->where('created_at', '>=', $year)->pluck('qty')->sum();
            $sellBackQty= sellBack::get()->where('created_at', '>=', $year)->pluck('qty')->sum();
            $suplier= Contact::get()->where('type',1)->where('created_at', '>=', $year)->count('id');
            $customer= Contact::get()->where('type',2)->where('created_at', '>=', $year)->count('id');
            $invoiceP= Purchases::where('created_at', '>=', $year)->count('id');
            $invoiceS= Sell::where('created_at', '>=', $year)->count('id');
            $invoiceRP= ReturnProduct::where('created_at', '>=', $year)->count('id');
            $invoiceRS = ReturnSell::where('created_at', '>=', $year)->count('id');
            return view('home',compact('purchase','sell','data','purchaseQty','sellQty',
            'sellBackQty','purBackQty','suplier','customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        }
        else if($req->data == 'defult'){
            $data="All time ";
          //  $total= Balance::get()->pluck('amount')->sum();
            $purchase= Purchases::get()->pluck('grand_total')->sum();
            $sell= Sell::get()->pluck('grand_total')->sum();
            $purchaseQty= Inventory::get()->pluck('qty')->sum();
            $sellQty= Sold::get()->pluck('qty')->sum();
            $purBackQty= ReturnBack::get()->pluck('qty')->sum();
            $sellBackQty= sellBack::get()->pluck('qty')->sum();
            $suplier= Contact::get()->where('type',1)->count('id');
            $customer= Contact::get()->where('type',2)->count('id');
            $invoiceP= Purchases::count('id');
            $invoiceS= Sell::count('id');
            $invoiceRP= ReturnProduct::count('id');
            $invoiceRS = ReturnSell::count('id');
            return view('home',compact('purchase','sell','data','purchaseQty','sellQty',
            'sellBackQty','purBackQty','suplier','customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        }
        $purchaseQty= Inventory::get()->pluck('qty')->sum();
        $sellQty= Sold::get()->pluck('qty')->sum();
        $purBackQty= ReturnBack::get()->pluck('qty')->sum();
        $sellBackQty= sellBack::get()->pluck('qty')->sum();
        $suplier= Contact::get()->where('type',1)->count('id');
        $customer= Contact::get()->where('type',2)->count('id');
        $invoiceP= Purchases::count('id');
        $invoiceS=  Sell::count('id');
        $invoiceRP=  ReturnProduct::count('id');
        $invoiceRS =  ReturnSell::count('id');
        $cash=Balance::where('is_in','in')->sum('cash_balance')
        -Balance::where('is_in','out')->sum('cash_balance');
        $mobile=Balance::where('is_in','in')->sum('mobile_balance')
        -Balance::where('is_in','out')->sum('mobile_balance');
        $bank=Balance::where('is_in','in')->sum('bank_balance')
        -Balance::where('is_in','out')->sum('bank_balance');
        $total= $cash+$bank+$mobile;
        //dd($invoice,$sellBackQty,$suplier,$customer, $balance);
        $purchase= Purchases::get()->pluck('grand_total')->sum();
        $sell= Sell::get()->pluck('grand_total')->sum();
        //dd($purchase);
        return view('home',compact('purchase','sell','total','data','purchaseQty','sellQty','sellBackQty','purBackQty','suplier',
    'customer','invoiceS','invoiceP','invoiceRP','invoiceRS'));
        //return view('home',compact('purchase','sell','total'));
        //$purCount= $purchase->count();


    }
}
