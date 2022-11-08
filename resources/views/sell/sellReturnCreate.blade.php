@extends('layouts.master.master')
@section('content')
<div class="container pb-5" id="okk">
    <div class="d-flex justify-content-end ">
        <a href="{{route('product-return.index')}}"   class="btn btn-success mt-2 mr-5"
           >Back</a>
    </div>
    <div class="row">
        <div class=" col-md-4  mt-1  px-4">
           <div class="row ">
            <div class=" col text-center  mb-1"  style=""> <h4>Seleect Invoice</h4></div>
            <div class="col">
                <select name="" class="form-control py-2 border-right-0 border returnSell" id="invoiceSell" >
                    <option >--select suplier--</option>
                    @foreach ($sell as $sel )
                        <option value="{{$sel->id}}">{{$sel->invoice_no}}</option>
                    @endforeach
                </select>
            </div>
           </div>
        </div>
        <div class="col-md-4 offset-2">
          <div class="row">
            <span class="mb-1 col"  style=""> <h4>Select Product </h4></span>
            <select name="invoice product"  class="col form-control py-2 border-right-0 border returnSellPro invoice" id="" >
                <option value="0">---product---</option>
            </select>
          </div>
        </div>
    </div>
   <div id="returnSell">
    <form action="" id="returnSellProductForm" method="POST" enctype="multipart/form-data">@csrf
        <div class="row mx-1 my-2 p-2">

        </div>
        <div class="modal-body ">

                <div class="card px-5 py-2 "style="background-color:#414a4c ; color:aliceblue ">
                    <div class="row">
                        <div class= "d-flex justify-content-between">
                            <div class="form-inline">
                                <label for="">Return Invoice No:</label>
                                <input type="text" name="invoice_no" id="" class="form-control ml-2 my-3">
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
                            <th>Sold Rate</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th style="max-width: 60px"></th>
                        </thead>
                        <tbody class="proTable">

                        </tbody>
                    </table>
                    <div >
                        <hr>
                         <div class="row" id="showCalculate">
                             <div class="col-7 mt-2 ">
                                 <div class="row">
                                     <div class="col-6">
                                         <label for=""> Customer Name</label>
                                         <div id="select-two" class=" form-group">
                                            <input name="customer_id" value="0" class="d-none
                                            border seller_id" id="seller_id" >
                                            <input type="text" class="form-control" name="" id="seller_name" readonly>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-4">
                                         <label class=" ml-1" for="">Click here:</label>
                                         <span class="btn btn-success payment-sell-rtn-btn btn-block"> Pay Amount</span>
                                         {{-- <div id="select-two" class="input-group form-group">
                                             <select name="" value="0" class=" form-control-lg form-control py-2 border-right-0 border " id="" >
                                             <option value="1">Pay </option>
                                             <option value="2">Dew</option>
                                             </select>
                                             <span class="input-group-append"></span>
                                             <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                                 <i class="fa fa-plus"></i>
                                             </button>
                                             </span>
                                         </div> --}}
                                     </div>
                                 </div>
                             </div>
                             <div class="col-5 p-4">
                                 <div class="row text-end mt-1">
                                     <label for="" class="col">Final Total</label>
                                     <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandBefore">
                                 </div>
                                 <div class="row text-end mt-1 d-none">
                                     <label for="" class="col">Total Discount</label>
                                     <input style="width: 200px" readonly type="text" value="0" name="grand_dis" id="grandDis" class="form-control col grandDis " >

                                 </div>
                                 <div class="row text-end mt-1">
                                     <label for="" class="col">Grand Total</label>
                                     <input style="width: 200px" readonly type="text" value="0"
                                     name="grand_total" id="grandTotal" class="form-control col grandTotal">
                                 </div >
                                 <hr class="">
                                 <div class="row text-end mt-1">
                                     <label for="" class="col">Total paid</label>
                                     <input readonly style="width: 200px" type="text"  value="0"
                                 class="form-control col payTotal" name="grand_pay" id="payTotal">
                                 </div>
                                 <div class="row text-end mt-1">
                                     <label for="" class="col">Total Due</label>
                                     <input readonly style="width: 200px" type="text" value="0"
                                     class="form-control col dewTotal" name="grand_dew" id="dewTotal">
                                 </div>
                             </div>
                         </div>
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
                         <div class="d-flex justify-content-center mt-1 mb-5" >
                             <button id="returnBtn" class="btn btn-success" type="submit"> Return Product</button>
                         </div>
                     </div>

                </div>

        </div>
    </form>
   </div>






<!--contact modal -->
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
<!--contact modal end -->


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

</div>
@endsection
