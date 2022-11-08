@extends('layouts.master.master')
@section('content')
<div class="container " id="okk" style="min-width:900px; ">
    <div class="d-flex justify-content-end ">
        <a href="{{route('purchas.index')}}"   class="btn btn-primary mt-2 mr-5"
           >Back to Purchase Index <i class="fas fa-back"></i></a>
    </div>
    <div class=" col-lg-6 offset-lg-3 col-md-8 offset-md-2 mt-1  px-5"  >
        <div class="text-center d-none mb-2"  style="color: blue"> <h2>Search BY name or Barcode</h2></div>
        <div class="input-group">
            <span class="input-group-append">
                <button class="btn btn-primary border-left-0 border" >
                    <i class="fa fa-search"></i>
                </button>
            </span>
            <input class="form-control-lg form-control py-2 border-right-0 border typeaheadPur" type="search"
            id="purchaseProductSearch" placeholder="search by product name or barcode">
            <span class="input-group-append">
                <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                    <i class="fa fa-plus"></i>
                </button>
            </span>
        </div>
    </div>
    <div  id="purchaseAdd" class="pb-5" >
        <form action="{{route('purchas.store')}}" id="purchaseAddForm" method="POST" enctype="multipart/form-data">@csrf
            <div class="modal-body ">
                <div class="card px-5 mt-5 pb-5 mx-2 mb-2 " style="background-color:#414a4c ; color:aliceblue ">
                    <div class="row">
                        <div class= "d-flex justify-content-between">
                            <div class="form-inline">
                                <label for="">Invoice No:</label>
                                <input required type="text" name="invoice_no" id="invoice_no" class="form-control ml-2 my-3">
                            </div>
                            <div id="purAlert" class="alert alert-success alert-dismissible fade show mx-2 my-3" role="alert">
                                <strong ><a  style="text-decoration: none; color:rgb(75, 13, 13)" href="{{route('purchas.index')}}">Lets go to index</a></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table text-center "  >
                        <thead class="">
                            <th>
                                Product Name
                            </th>
                            <th>
                                Rate
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Discount
                            </th>
                            <th>
                                Total
                            </th>
                            <th>
                                Profit Margin %
                            </th>
                            <th >
                                Target Rate

                            </th>
                            <th>

                            </th>
                        </thead>
                        <tbody  class="proTable">

                        </tbody>
                    </table>
                    <hr>
                    <div class="row mt-0" id="showCalculate">
                        <div class="col-7 mt-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <label for=""> Select a Suplier</label>
                                    <div id="select-two" class="input-group form-group">
                                        <select required name="seller_id" value="0" class=" form-control-lg form-control py-2
                                        border-right-0 border selectS select3" id="" >
                                        <option >--select suplier--</option>

                                        </select>
                                        <span class="input-group-append"></span>
                                        <button class="btn btn-primary border-left-0 border suplier" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" ml-1" for="">Click here:</label>
                                    <span class="btn btn-primary payment-pur-btn btn-block"> Pay Amount</span>
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
                                <input style="width: 200px" readonly type="text" value="0" name="grand_before"
                                id="grandBefore" class="form-control col grandBefore">
                            </div>
                            <div class="row text-end mt-1">
                                <label for="" class="col">Total Discount</label>
                                <input style="width: 200px" readonly type="text" value="0" name="grand_dis"
                                id="grandDis" class="form-control col grandDis " >

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
                            class="form-control col payTotal" name="pay" id="payTotal">
                            </div>
                            <div class="row text-end mt-1">
                                <label for="" class="col">Total Due</label>
                                <input readonly style="width: 200px" type="text" value="0"
                                class="form-control col dewTotal" name="dew" id="dewTotal">
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
                    <div class="d-flex justify-content-center mt-0 mb-2" >
                        <button id="purchaseAddbtn" class="btn btn-primary" type="submit" > Purchase</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- add product modal --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="background-color: #7b9ffd;  ; color:rgb(8, 9, 10)">
            <div class="modal-header ">
                <div class="text-center">
                    <h5 class="modal-title " id="exampleModalLabel">Add new Product</h5>
                </div>

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('custom.addProduct')
            </div>
          </div>
        </div>
      </div>
{{-- add product modal end--}}

<!--contact modal -->
      <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="background-color: #f71bf7;  ; color:rgb(8, 9, 10)">
            <div class="modal-header ">
                <div class="">
                    <h5 class="modal-title " id="exampleModalLabel">Add new Contact</h5>
                </div>

              <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
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

<!--cash-->
<div class="modal fade" id="createCatModal" tabindex="-1" aria-labelledby=" " aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Balance</h5>
          <button type="button" id="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="balanceAddForm">@csrf
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" name="amount" id="" class="form-control">
                    @error('amount')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Type</label>
                    <select type="text"   name="cash_type" class="form-control" >
                        <option value=" ">select cash type</option>
                        <option value="cash">Cash</option>
                        <option value="mobile">Mobile Bnanking</option>
                        <option value="bank">Bank Account</option>
                    </select>
                    @error('cash_type')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-success " type="submit">Submit</button>
                </div>
           </form>
        </div>

      </div>
    </div>
  </div>

</div>
<!--cash modal end-->

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
@endsection
