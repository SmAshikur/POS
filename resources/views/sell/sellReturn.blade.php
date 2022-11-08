@extends('layouts.master.master')
@section('content')
<div class="container">
    <div class="row"><h1>Return Product Index</h1>
    </div>
   <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="  ">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{route('product-return.create')}}"   class="btn btn-success  mr-2"
                       >Add</a>
                </div>
            </div>
            <div class="card-body mt-2">
                <table id="export_example" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Invoice Number</th>
                            <th>Customer Name</th>
                            <th>Added by</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id=" ">
                        @foreach ($back as $purchas )
                            <tr>
                                <th>{{$purchas->id}}</th>
                                <th>{{$purchas->invoice_no}}</th>
                                <th>
                                     @isset($purchas->contact)
                                        {{$purchas->contact->real_name}}
                                    @endisset
                                </th>
                                <th>{{$purchas->user->name}}</th>
                                <th>{{$purchas->return_pay}} ৳</th>
                                <th>{{$purchas->return_dew}} ৳</th>
                                <th>{{$purchas->return_total}} ৳</th>
                                <th class="btn-group">
                                    <button value="{{$purchas->id}}" id="editSellReturn"
                                        class="m-1 btn btn-success btn-sm  custom_model_btn"  ><i class="fas fa-edit"></i></button>
                                    {{-- <a href="{{route('purchas.show',$purchas->id)}}" target="_blank" id="showPurchas"
                                        class=" m-1 btn btn-success btn-sm editPurchas"  >Show</a> --}}
                                    <div>
                                        <form action="{{url('return/'.$purchas->id)}}" method="post">@csrf @method('DELETE')
                                            <button onclick="archiveFunction()" class="m-1 btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="product-return"
                                        class="m-1 btn btn-success btn-sm showPurchas  printMe2"> <i class="fas fa-print"></i> </button>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="product-return"
                                        class="m-1 btn btn-success btn-sm showPurchas "  ><i class="fas fa-eye"></i></button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
   </div>
</div>


{{-- <div id="" class="custom_model" >
    <div class="">
        <div class="custom_modal_content card">
            <div class="card-body">
                <div class="">
                    <span class="custom_modal_close">x</span>
                </div>
                <div class="row">
                    <div class=" col-md-6  mt-1  px-4">
                       <div class="form-inline ">
                            <div class="  text-center  mb-1"  style=""> <h4>Seleect Invoice</h4></div>
                            <div class="">
                                <select name="seller_id" class="form-control ml-2 border-right-0 border returnProduct" id="invoicePurchase" >
                                    <option >--select suplier--</option>
                                    @foreach ($sell as $sel )
                                        <option value="{{$sel->id}}">{{$sel->invoice_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inline">
                            <span class="mb-1 "  style=""> <h4>Select Product </h4></span>
                            <select name="invoice product"  class=" form-control ml-2-2 border-right-0 border testing invoice" id="testing" >
                                <option value="0">---product---</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id=" ">
                    <form action="" id="returnSellUpdateForm" method="POST" >@csrf @method('PUT')
                        <div class="modal-body ">
                            <input type="text" name="id" id="purchasId" class="d-none" >
                                <div class="card px-5 py-2 ">
                                    <div class="form-inline  py-2">
                                        <label for="">Return Invoice No:</label>
                                        <span   id="invoice_no" class=" ml-2 my-3"></span>
                                    </div>
                                    <table class="text-center table ">
                                        <thead class="bg-success py-5 my-4">
                                            <th>Name</th>
                                            <th>Selling price</th>
                                            <th>Returned price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th style="max-width: 60px"></th>
                                        </thead>
                                        <tbody class="proTable">

                                        </tbody>
                                    </table>
                                    <div >
                                        <div class="" >
                                            <hr>
                                            <div class="row" id="showCalculate">
                                                <div class="col-7 mt-2 ">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="" for=""> Select a Suplier</label>
                                                            <div id="select-two" class="input-group form-group">
                                                                <select name="seller_id" class=" form-control-lg form-control py-2 border-right-0 border select3" id="seller_id" >
                                                                <option >--select suplier--</option>

                                                                </select>
                                                                <span class="input-group-append"></span>
                                                                <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                </span>
                                                            </div>
                                                            <label style="width: 80px" class="btn btn-sm btn-success col payment-sell-rtn-btn my-2"> Pay More</label>
                                                            <label style="width: 80px" class="btn btn-sm btn-dark col payment-cash-btn cashBackDiv my-2"> Cash Back</label>
                                                            <div class="d-flex justify-content-start mt-5 mb-5" >
                                                                <button id="" class="btn btn-success " type="submit"> Change Record</button>
                                                            </div>
                                                            {{-- <div id="" class="custom_model_three" >
                                                                <div class="">
                                                                    <div class="small_modal_content card">
                                                                        <div class="">
                                                                            <div class="d-flex justify-content-end">
                                                                                <span class="custom_modal_three_close" style="margin-top: -20px ">x</span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="row text-end mt-1 grandTotalDiv">
                                                                                <label for="" class="col">Grand Total</label>
                                                                                <input style="width: 200px" readonly type="text" value="0"
                                                                                name="grand_total" id="grandTotal" class="form-control col grandTotal">
                                                                            </div >
                                                                            <div class="row text-end mt-1 cashBackDiv">
                                                                                <label for="" class="col">CashBack</label>
                                                                                <input style="width: 200px" readonly type="text" value="0" name="cash_back" id="cashBack" class="form-control col cashBack">
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @include('custom.payment')
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5 p-4">
                                                    {{-- <div class="row text-end mt-1">
                                                        <label for="" class="col">Final Total</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandBefore">
                                                    </div>
                                                    <div class="row text-end mt-1">
                                                        <label for="" class="col">Final Total</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandBefore">
                                                    </div>
                                                    <div class="row text-end mt-1 d-none">
                                                        <label for="" class="col">Total Discount</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="grand_dis" id="grandDis" class="form-control col grandDis " >

                                                    </div>
                                                    <div class="row text-end mt-1">
                                                        <label for="" class="col">Old Grand Total</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="grand_total" id="oldGrandTotal" class="form-control col oldGrandTotal">
                                                    </div>
                                                    <div class="row text-end mt-1">
                                                        <label for="" class="col">Previous Paid</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="grand_pay" id="grandPay" class="form-control col grandPay">
                                                    </div>
                                                    <div class="row text-end mt-1">
                                                        <label for="" class="col">New Grand Total</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="grand_pay" id="grandPay" class="form-control col grandTotal">
                                                    </div>
                                                    <div class="row text-end mt-1 cashBackDiv">
                                                        <label for="" class="col">CashBack</label>
                                                        <input style="width: 200px" readonly type="text" value="0" name="cash_back" id="cashBack" class="form-control col cashBack">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-1 payment_pay">
                                                <div class="col-10 offset-2 d-flex justify-content-end">
                                                    <label class="mx-2" for="">Total</label>
                                                    <label class="mx-2" for="">Paid </label>
                                                    <input readonly style="width: 200px" type="text"  value="0"  class="form-control payTotal" name="pay" id="payTotal">
                                                </div>
                                            </div>
                                            <div class="row mt-2 payment_pay">
                                                <div class="col-10 offset-2 d-flex justify-content-end">
                                                    <label class="mx-2" for="">Total </label>
                                                    <label class="mx-2" for="">Due </label>
                                                    <input readonly style="width: 200px" type="text" value="0"  class="form-control dewTotal" name="grand_dew" id="dewTotal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </div>
                </form>
               </div>
            </div>

        </div>
    </div>
</div> --}}
<div id="" class="custom_model " >
    <div class="">
        <div class="custom_modal_content card" style="background: #9fe7e5 ;overflow: auto ; height:80vh ;">
            <div class="row">
                <div class="d-flex justify-content-end">

                    <span class="custom_modal_close">x</span>
                </div>
            </div>
            <div class="row">
                <div class=" col-md-6  mt-1  px-4">
                   <div class="form-inline ">
                    <div class="  text-center  mb-1"  style=""> <h4>Seleect Invoice</h4></div>
                    <div class="">
                        <select name="seller_id" class="form-control ml-2 border-right-0 border returnProduct" id="invoicePurchase" >
                            <option >--select suplier--</option>
                            @foreach ($sell as $pur )
                                <option value="{{$pur->id}}">{{$pur->invoice_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-inline">
                    <span class="mb-1 "  style=""> <h4>Select Product </h4></span>
                    <select name="invoice product"  class=" form-control ml-2-2 border-right-0 border testing invoice" id="testing" >
                        <option value="0">---product---</option>
                    </select>
                  </div>
                </div>
            </div>
                <div id="">
                    <form action="" id="returnSellUpdateForm" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
                    <div class="row mx-1 my-2 p-2">

                    </div>
                    <div class="modal-body ">
                        <input type="text" name="id" id="purchasId" class="d-none" >
                            <div class="card px-5 py-2 mb-4">
                                <div class="row">
                                    <div class= "d-flex justify-content-between">
                                        <div class="form-inline d-none">
                                            <label for="">Invoice No:</label>
                                            <input readonly type="text" name="invoice_no" id="invoice_no" class="form-control ml-2 my-3">
                                        </div>
                                        <div id="purAlert" class="alert alert-success alert-dismissible fade show mx-2 my-3" role="alert">
                                            <strong ><a  style="text-decoration: none; color:rgb(75, 13, 13)" href="{{route('purchas.index')}}">Lets go to index</a></strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <table class="text-center table ">
                                    <thead class="bg-success py-5 my-4">
                                        <th>Name</th>
                                        <th>Selling price</th>
                                        <th>Returned price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th style="max-width: 60px"></th>
                                    </thead>
                                    <tbody class="proTable">

                                    </tbody>
                                </table>
                            </div>
                            <div class="" >
                                <hr>
                                <div class="row" id="showCalculate">
                                    <div class="col-7 mt-2 ">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="" for="">Customer Name</label>
                                                <div id="select-two" class=" form-group">
                                                    <input name="seller_id" value="0" class="d-none
                                                    border seller_id" id="seller_id" >
                                                    <input type="text" class="form-control" name="" id="seller_name" readonly>
                                                </div>
                                                <label style="width: 80px" class="btn btn-sm btn-success col payment-rtn-btn my-2"> Pay More</label>
                                                <label style="width: 80px" class="btn btn-sm btn-dark col payment-cash-btn cashBackDiv my-2"> Cash Back</label>

                                                <div id="" class="custom_model_three" >
                                                    <div class="">
                                                        <div class="small_modal_content card" style="background-color: #4358e0; ">
                                                            <div class="">
                                                                <div class="d-flex justify-content-end">
                                                                    <span class="custom_modal_three_close" style="margin-top: -20px ">x</span>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="row px-5">
                                                                    <div class="col-md-6">
                                                                        <h4 class="text-dark">Payment Type : Purchase</h4>
                                                                    </div>
                                                                    <div class="col-md-6 text-end mt-1">
                                                                        <div class="row">
                                                                        <label for="" class="col mt-2">Grand Total</label>
                                                                        <input style="width: 200px" readonly type="text" value="0"
                                                                        name="grand_total" id="grandTotal" class="form-control col grandTotal">
                                                                        </div>
                                                                    </div >
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                @include('custom.paymentTwo')
                                                            </div>
                                                            <div class="">
                                                                <div class="d-flex justify-content-center" style="margin-top: -90px">
                                                                    <span class="btn btn-primary purchasePay px-3 py-2"> Done </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 p-4">
                                        {{-- <div class="row text-end mt-1">
                                            <label for="" class="col">Final Total</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandBefore">
                                        </div> --}}
                                        <div class="row text-end mt-1">
                                            <label for="" class="col">Final Total</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandBefore">
                                        </div>
                                        <div class="row text-end mt-1 d-none">
                                            <label for="" class="col">Total Discount</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="grand_dis" id="grandDis" class="form-control col grandDis " >

                                        </div>
                                        <div class="row text-end mt-1">
                                            <label for="" class="col">Old Grand Total</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="grand_total" id="oldGrandTotal" class="form-control col oldGrandTotal">
                                        </div>
                                        <div class="row text-end mt-1">
                                            <label for="" class="col">Previous Paid</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="pre_pay" id="grandPay" class="form-control col grandPay">
                                        </div>
                                        <div class="row text-end mt-1">
                                            <label for="" class="col">New Grand Total</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="" id="grandPay" class="form-control col grandTotal">
                                        </div>
                                        <div class="row text-end mt-1 cashBackDiv">
                                            <label for="" class="col">CashBack</label>
                                            <input style="width: 200px" readonly type="text" value="0" name="cash_back" id="cashBack" class="form-control col cashBack">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-1 payment_pay">
                                    <div class="col-10 offset-2 d-flex justify-content-end">
                                        <label class="mx-2" for="">Total</label>
                                        <label class="mx-2" for="">Paid </label>
                                        <input readonly style="width: 200px" type="text"  value="0"  class="form-control payTotal"
                                        name="grand_pay" id="payTotal">
                                    </div>
                                </div>
                                <div class="row mt-2 payment_pay">
                                    <div class="col-10 offset-2 d-flex justify-content-end">
                                        <label class="mx-2" for="">Total </label>
                                        <label class="mx-2" for="">Due </label>
                                        <input readonly style="width: 200px" type="text" value="0"  class="form-control dewTotal"
                                        name="grand_dew" id="dewTotal">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-5" >
                                    <button id="" class="btn btn-success " type="submit"> Change Record</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
{{-- product view model --}}
<div id="" class="product_model" >
    <div class="">
        <div class="product_modal_content card">
            <div class="d-flex justify-content-end">
                <span class="product_modal_close" style="margin-top: -10px ">x</span>
            </div>
            @include('custom.viewProduct')
        </div>
    </div>
</div>
{{-- product view model end--}}
<!--contact add model -->
<div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header ">
            <div class="text-center">
                <h5 class="modal-title " id="exampleModalLabel">Add new Contact</h5>
            </div>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           @include('custom.addContact')
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
</div>
<!--contact add model end -->
 <!--custom Invoice Modal -->
 <div id="" class="custom_model_two" >
    <div class="">
        <div class="custom_modal_content card">
            <div class="card-body ">
                <div class="d-flex justify-content-end">
                    <span class="custom_modal_close" style="margin-top: -10px ">x</span>
                </div>
                <div class="card showPrint">
                    @include('custom.invoice')
                </div>
            </div>
        </div>
    </div>
</div>
<!--custom Invoice Modal end -->
@endsection
