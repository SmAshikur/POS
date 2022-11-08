
@extends('layouts.master.master')
@section('content')
<div class="container">
    <div class="row mb-2"><h1>Balance Page</h1>

    </div>
    <div class="row px-2">
        <div class="col-md-9">
            <div class=" mx-5">
                <table id="export_example" class="table">
                    <thead>
                        <tr class="bg-primary">
                            <th>Id</th>
                            <th>View</th>
                            <th>Payment Method</th>
                            <th>Payment Type</th>
                            <th>Total</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody id="brandTbody">
                        @foreach ( $pays as $pay )
                        {{-- <tr style="background : @if($pay->is_in== 'in') green @else red @endif"> --}}
                        <tr >
                            <th>{{$pay->id}}</th>
                            <th>
                                <button value="" id="" class="showPurchas btn btn-success btn-sm mr-2"
                                   ><i class="fas fa-eye"></i></button>

                            </th>
                            <th>
                                @if ($pay->cash_balance>0)
                                    Cash,
                                @endif
                                @if ($pay->mobile_balance>0)
                                    Mobile,
                                @endif
                                @if ($pay->bank_balance>0)
                                    Bank
                                @endif
                            </th>
                            <th>
                                @isset($pay->payment->payment_type)
                                    @if($pay->payment->payment_type === 1)
                                        Add
                                    @elseif ($pay->payment->payment_type === 2)
                                        Withdraw
                                    @elseif ($pay->payment->payment_type === 3)
                                        Sell
                                    @elseif ($pay->payment->payment_type === 4)
                                    Purchase
                                    @elseif ($pay->payment->payment_type === 5)
                                        Cash Back
                                    @elseif ($pay->payment->payment_type === 6)
                                        Cash Return
                                    @elseif ($pay->payment->payment_type === 7)
                                        Expanses
                                    @endif
                                @endisset

                            </th>
                            <th>
                                @if($pay->is_In == "out")
                                <i class="mx-2 fas fa-minus text-danger"> </i>{{$pay->total}} ৳
                                @elseif($pay->is_In == 'in')
                                <i class="mx-2 fas fa-add text-success"> </i> {{$pay->total}} ৳
                                @endif
                            </th>
                            <th>{{$pay->created_at->diffforhumans()}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-primary">
                            <th colspan="4" class="text-end">Total Balance Amount:</th>
                            <th>= {{$balance}} ৳</th>
                            <th></th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-3">

            <div class=" my-5 mx-2 ">
                <table class="table text-center">
                    <tr class="bg-primary">
                        <th colspan="2">Balance Amount</th>
                    </tr>
                    <tr>
                        <th>In Cash</th>
                        <th>{{$cash}} ৳</th>
                    </tr>
                    <tr>
                        <th>In Mobile</th>
                        <th>{{$mobile}} ৳</th>
                    </tr>
                    <tr>
                        <th>In Bank</th>
                        <th>{{$bank}} ৳</th>
                    </tr>
                    <tr class="bg-primary">
                        <th>Total</th>
                        <th>{{$balance}} ৳</th>
                    </tr>
                </table>
            </div>
            <div class="d-flex justify-content-center py-2 my-4">
                <button   class="btn btn-primary mr-2 p-2 payment-add-btn tekka"
                  >Add Balance   <i class="mx-2 fas fa-add"></i></button>
            </div>
            <div class=" d-flex justify-content-center py-2 my-4">
                <button   class="btn btn-primary mx-2 p-2 payment-del-btn"
                >Withdraw Balance  <i class="mx-2 fas fa-minus"></i></button>
            </div>
        </div>
    </div>
</div>

<div class=" ">









      <!--Add Modal -->
         <!--custom Invoice Modal -->
    <div id="" class="custom_model_two" >
        <div class="">
            <div class="custom_modal_content card">
                <div class="card-body ">
                    <div class="d-flex justify-content-end">
                        <span class="custom_modal_close" style="margin-top: -10px ">x</span>
                    </div>
                    <div class="card showPrint">
                        @include('custom.payInvoice')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--custom Invoice Modal end -->
     {{-- <!--custom Payment Modal end -->

     <div id="" class="custom_model text-white" >
        <div class="">
            <div class="small_modal_content card" style="background-color: #4358e0; ">
                <div class="">
                    <div class="d-flex justify-content-end">
                        <span class="custom_modal_close text-white" style="margin-top: -15px ">x</span>
                    </div>
                </div>
                <form action="" method="post" id="balanceAddForm">@csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-white">Payment Type : <span class="pay_add"></span></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('custom.payment')
                    </div>
                    <div class=" d-flex justify-content-center mb-3" style="margin-top:-30px">
                        <button type="submit"  class="btn btn-primary " > submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--custom paymrnt Modal end --> --}}
      <!--Edit Modal -->



</div>
@endsection

