@extends('layouts.master.master')
@section('content')
<div class="container pb-5">
    <div class="row"><h1>Purchase Index</h1>

    </div>
   <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="  ">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{route('purchas.create')}}"   class="btn btn-success  mr-2"
                       >Add</a>
                </div>
            </div>
            <div class="card-body mt-2">
                <table id="export_example" class="table mb-5">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Invoice No</th>
                            <th>Suplier Name</th>
                            <th>Added by</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id=" ">
                        @foreach ($purchase as $purchas )
                            <tr>
                                <th>{{$purchas->id}}</th>
                                <th>{{$purchas->invoice_no}}</th>
                                <th>{{$purchas->contact->real_name}}</th>
                                <th>{{$purchas->user->name}}</th>
                                <th>{{$purchas->grand_pay}} ৳</th>
                                <th>{{$purchas->grand_dew}} ৳</th>
                                <th>{{$purchas->grand_total}} ৳</th>
                                <th class="btn-group">
                                    <button value="{{$purchas->id}}" id="editPurchas"
                                        class="m-1 btn btn-success btn-sm editPurchas custom_model_btn"  >
                                        <i class="fas fa-edit"></i></button>
                                    <div>
                                        <form action="{{url('purchas/'.$purchas->id)}}" method="post">@csrf @method('DELETE')
                                            <button class="m-1 btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="purchas"
                                        class="m-1 btn btn-success btn-sm showPurchas  printMe2"> <i class="fas fa-print"></i> </button>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="purchas"
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
    <!--Edit purchase Modal  -->
    <div id="" class="custom_model " style="margin-top: -10px ;">
        <div class="">
            <div class="custom_modal_content card pb-5" style="background: #9fe7e5 ;overflow: auto ; height:80vh ;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="form-inline ">
                            <label for="">Invoice No:</label>
                            <input readonly type="text" name="invoice_no" id="invoice_no" class="form-control ml-2 ">
                        </div>
                        <span class="custom_modal_close ">x</span>
                    </div>
                    <div class=" col-md-6 offset-md-3 mt-2 px-4">
                        <div class="input-group">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0 border" >
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                                <input class="form-control py-2 border-right-0 border typeaheadPur" type="search"
                                id="purchaseProductSearch">

                                <span class="input-group-append">
                                    <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <div id="" class="mt-4">
                        <form action="" id="purchaseUpdateForm" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
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
                                        <table class="table text-center mt-2">
                                            <thead class=" bg-success">
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
                                    </div>
                                    <div class="" >
                                        <hr>
                                        <div class="row" id="showcalculate">
                                            <div class="col-7 mt-2 ">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="" for=""> Select a Suplier</label>
                                                        <div id="select-two" class="input-group form-group">
                                                            <select name="seller_id" class="selectS form-control-lg form-control py-2 border-right-0 border select3" id="seller_id" >
                                                            <option >--select suplier--</option>

                                                            </select>
                                                            <span class="input-group-append"></span>
                                                            <button class="btn btn-primary border-left-0 border suplier" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                            </span>
                                                        </div>
                                                        <label style="width: 80px" class="btn btn-sm btn-success col payment-pur-btn my-2"> Pay More</label>
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
                                                    <label for="" class="col">Old Grand Total</label>
                                                    <input style="width: 200px" readonly type="text" value="0" name="grand_total"
                                                    id="grandTotal" class="form-control col oldGrandTotal">
                                                </div>
                                                <div class="row text-end mt-1">
                                                    <label for="" class="col">Previous Paid</label>
                                                    <input style="width: 200px" readonly type="text" value="0" name="pre_pay"
                                                    id="grandPay" class="form-control col grandPay">
                                                </div>
                                                <div class="row text-end mt-1">
                                                    <label for="" class="col">New Grand Total</label>
                                                    <input style="width: 200px" readonly type="text" value="0" name=""
                                                    id="grandPay" class="form-control col grandTotal">
                                                </div>
                                                <div class="row text-end mt-1 cashBackDiv">
                                                    <label for="" class="col">CashBack</label>
                                                    <input style="width: 200px" readonly type="text" value="0" name="cash_back"
                                                    id="cashBack" class="form-control col cashBack">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-1 payment_pay">
                                            <div class="col-10 offset-2 d-flex justify-content-end">
                                                <label class="mx-2" for="">Total</label>
                                                <label class="mx-2" for="">Paid </label>
                                                <input readonly style="width: 200px" type="text"  value="0"
                                                class="form-control payTotal" name="grand_pay" id="payTotal">
                                            </div>
                                        </div>
                                        <div class="row mt-2 payment_pay">
                                            <div class="col-10 offset-2 d-flex justify-content-end">
                                                <label class="mx-2" for="">Total </label>
                                                <label class="mx-2" for="">Due </label>
                                                <input readonly style="width: 200px" type="text" value="0"
                                                class="form-control dewTotal" name="grand_dew" id="dewTotal">
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
    <!--Edit purchase Modal end -->

    {{-- <!--Edit purchase Modal  -->
    <div id="" class="custom_model " style="margin-top: -60px" >
        <div class="">
            <div class="custom_modal_content card" style="height:90vh; overflow-y: auto">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="form-inline ">
                            <label for="">Invoice No:</label>
                            <input readonly type="text" name="invoice_no" id="invoice_no" class="form-control ml-2 ">
                        </div>
                        <span class="custom_modal_close ">x</span>
                    </div>
                    <div class=" col-md-6 offset-md-3 mt-2 px-4">
                        <div class="input-group">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0 border" >
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                                <input class="form-control py-2 border-right-0 border typeaheadPur" type="search"
                                id="purchaseProductSearch">

                                <span class="input-group-append">
                                    <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <div id="">
                        <form action="" id="purchaseUpdateForm" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
                            <div class="modal-body ">
                                <input type="text" name="id" id="purchasId" class="d-none" >
                                <div class="card px-5 py-2 mb-4" >
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
                                    <table class="table text-center">
                                        <thead class=" bg-success">
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
                                </div>
                                <div class="" >
                                    <hr>
                                    <div class="row" id="showCalculate">
                                        <div class="col-7 mt-2 ">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="" for=""> Select a Suplier</label>
                                                    <div id="select-two" class="input-group form-group">
                                                        <select name="seller_id" class=" form-control-lg form-control py-2 border-right-0 border select3" id="" >
                                                        <option >--select suplier--</option>

                                                        </select>
                                                        <span class="input-group-append"></span>
                                                        <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        </span>
                                                    </div>
                                                    <label style="width: 80px" class="btn btn-sm btn-success col payment-pur-btn my-2"> Pay More</label>
                                                    <label style="width: 80px" class="btn btn-sm btn-dark col payment-cash-btn cashBackDiv my-2"> Cash Back</label>

                                                    <div id="" class="custom_model_three" >
                                                        <div class="">
                                                            <div class="small_modal_content card">
                                                                <div class="">
                                                                    <div class="d-flex justify-content-end">
                                                                        <span class="custom_modal_three_close" style="margin-top: -20px ">x</span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="row px-5 grandTotalDiv" >
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
                                                                    <div class="row text-end mt-1 cashBackDiv">
                                                                        <label for="" class="col">CashBack</label>
                                                                        <input style="width: 200px" readonly type="text" value="0" name="cash_back" id="cashBack" class="form-control col cashBack">
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    @include('custom.payment')
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
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Final Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandTotal">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Total Discount</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_dis"
                                                 id="grandDis" class="form-control col grandDis " >

                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Old Grand Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_total"
                                                id="grandTotal" class="form-control col oldGrandTotal">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Previous Paid</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_pay"
                                                id="grandPay" class="form-control col grandPay">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">New Grand Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_pay"
                                                id="grandPay" class="form-control col grandTotal">
                                            </div>
                                            <div class="row text-end mt-1 cashBackDiv">
                                                <label for="" class="col">CashBack</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="cash_back"
                                                id="cashBack" class="form-control col cashBack">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-1 payment_pay">
                                        <div class="col-10 offset-2 d-flex justify-content-end">
                                            <label class="mx-2" for="">Total</label>
                                            <label class="mx-2" for="">Paid </label>
                                            <input readonly style="width: 200px" type="text"  value="0"  class="form-control payTotal"
                                            name="pay" id="payTotal">
                                        </div>
                                    </div>
                                    <div class="row mt-2 payment_pay">
                                        <div class="col-10 offset-2 d-flex justify-content-end">
                                            <label class="mx-2" for="">Total </label>
                                            <label class="mx-2" for="">Due </label>
                                            <input readonly style="width: 200px" type="text" value="0"  class="form-control dewTotal" name="dew" id="dewTotal">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4 mb-5" >
                                        <button id="" class="btn btn-success " type="submit"> Change Record</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Edit purchase Modal end --> --}}

    {{-- <!--custom Payment Modal -->
    <div id="" class="custom_model_four" >
        <div class="">
            <div class="small_modal_content card">
                <div class="">
                    <div class="d-flex justify-content-end">
                        <span class="custom_modal_four_close" style="margin-top: -20px ">x</span>
                    </div>
                </div>
                <form action="" method="post" id="balanceAddForm">@csrf
                    <div class="card-body">
                        @include('custom.payment')
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--custom Payment Modal end --> --}}

    <!--custom Invoice Modal -->
    <div id="" class="custom_model_two" >
        <div class="">
            <div class="custom_modal_content card"  style="margin-top: -60px ">
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

    <!--Product add model -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header ">
                <div class="text-center">
                    <h5 class="modal-title " id="exampleModalLabel">Add new Product</h5>
                </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               @include('custom.addProduct')
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    <!--Product add model end -->

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
