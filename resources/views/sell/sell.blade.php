{{-- @extends('layouts.master.master')
@section('content')
<div class="container ">
    <div class="row"><h1>Sell Index</h1>

    </div>
   <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="  ">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{route('sell.create')}}"   class="btn btn-success  mr-2"
                       >Add</a>
                </div>
            </div>
            <div class="card-body mt-2">
                <table id="export_example" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer Name</th>
                            <th>Added by</th>
                            <th>Paid</th>
                            <th>Dew</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id=" ">
                        @foreach ($purchase as $purchas )
                            <tr>
                                <th>{{$purchas->id}}</th>
                                <th>{{$purchas->contact->name}}</th>
                                <th>{{$purchas->user->name}}</th>
                                <th>{{$purchas->grand_pay}}</th>
                                <th>{{$purchas->grand_dew}}</th>
                                <th>{{$purchas->grand_total}}</th>
                                <th class="btn-group">
                                    <button value="{{$purchas->id}}" id="editSell"
                                        class="m-1 btn btn-success btn-sm editSell custom_model_btn"  >Edit</button>
                                    <div>
                                        <form action="{{url('sell/'.$purchas->id)}}" method="post">@csrf @method('DELETE')
                                            <button onclick="archiveFunction()" class="m-1 btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </div>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="sell"
                                        class="m-1 btn btn-success btn-sm showPurchas  printMe2"> Pdf </button>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="sell"
                                        class="m-1 btn btn-success btn-sm showPurchas "  >show</button>
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


<div id="" class="custom_model" >
    <div class="">
        <div class="custom_modal_content card">
            <div class="card-body">
                <div class="">
                    <span class="custom_modal_close">x</span>
                </div>
                <div class=" col-md-6 offset-md-3 mt-5 px-4">
                    <div class="input-group">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary border-left-0 border" >
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                            <input class="form-control py-2 border-right-0 border typeahead2" type="search"
                            id="invProduct">
                            <span class="input-group-append">
                                <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                    </div>
                </div>
                <div id="sellUpdate">
                    <form action="" id="sellUpdateForm" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
                        <div class="modal-body ">
                            <input type="text" name="id" id="purchasId" class="d-none" >
                                <div class="card px-5 py-2 ">
                                    <div class="form-inline ">
                                        <label for="">Invoice No:</label>
                                        <input readonly type="text" name="invoice_no" id="invoice_no" class="form-control ml-2 ">
                                    </div>
                                    <table class="text-center table ">
                                        <thead class="bg-success py-5 my-4">
                                            <th >Name</th>
                                            <th >Target price</th>
                                            <th>Selling price</th>
                                            <th>Quantity</th>
                                            <th>discount</th>
                                            <th>Total</th>
                                            <th style="max-width: 60px"></th>
                                        </thead>
                                        <tbody class="proTable">

                                        </tbody>
                                    </table>
                                    <hr>
                                    <div class="row" id="">
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
                                                    <label style="width: 80px" class="btn btn-sm btn-success col payment-sell-btn my-2"> Pay More</label>
                                                    <label style="width: 80px" class="btn btn-sm btn-dark col payment-cash-btn cashBackDiv my-2"> Cash Back</label>
                                                    <div class="d-flex justify-content-start mt-5 mb-5" >
                                                        <button id="" class="btn btn-success " type="submit"> Change Record</button>
                                                    </div>
                                                    <div id="" class="custom_model_three" >
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
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Final Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandTotal">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Total Discount</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_dis" id="grandDis" class="form-control col grandDis " >

                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Old Grand Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_total" id="grandTotal" class="form-control col oldGrandTotal">
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
                                            <input readonly style="width: 200px" type="text"  value="0"  class="form-control payTotal" name="grand_pay" id="payTotal">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class=" " id="okk">













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
                    @include('custom.invoice')
                </div>
            </div>
        </div>
    </div>
</div>
<!--custom Invoice Modal end -->
      <!--Edit Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
              <button type="button" id="editModalcloser" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="updateForm">@csrf @method('PUT')
                    <div class="card-body">
                        <input type="text" name="id" id="catId" class="d-none" >
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" id="catName" name="name" class="form-control" id="name" placeholder="Enter category Name">
                                <span id="errName" class="text-danger"> </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"  name="image" placeholder="Enter image" class="custom-file-input imagerender">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                                <span id="errImg" class="text-danger"></span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img style="width: 200px; height:200px; background: red" src="" alt="" id="eidtImg" class="editPreviewImg">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

          </div>
        </div>
      </div>
 <!--sell Edit model -->
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
                <form action="" method="POST" enctype="multipart/form-data" id="productAddForm">@csrf

                    <div class="card-body " >

                        <div class="form-group row ">
                            <div class="col-md-6">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product Name">
                            </div>

                                <span class="text-danger" id="Ename" > </span>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="">
                                        <label for="name">Product code</label>
                                        <div class="input-group">
                                            <input name="bar_code" id="scanner_input" class="form-control" placeholder="Scan Barchode" type="text" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#livestream_scanner">
                                                    <i class="fa fa-barcode"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <span class="text-danger" id="Ecode"> </span>

                        </div>

                        <div class="container modal" id="livestream_scanner">
                            <div class="row modal-dialog">
                                <div class="modal-content col-md-8">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Barcode Scanner</h4>
                                    </div>
                                    <div class="modal-body" style="position: static">
                                        <div id="interactive" class="viewport"></div>
                                        <div class="error"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <label class="btn btn-default pull-left">
                                            <i class="fa fa-camera"></i> Use camera app
                                            <input type="file" accept="image/*;capture=camera" capture="camera" class="hidden" />
                                        </label>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <div class="form-group row ">
                            <div class="col-md-6 ">
                                <label for="cat_id">Select Category</label>
                                <select type="text" name="cat_id" class="form-control" id="cat_name" placeholder="Enter category Name">
                                    <option>--select category--</option>
                                    @foreach ($cats as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-md-6">
                                <label for="name">or Add new Category</label>
                                <input type="text" name="new_cat_name" class="form-control" id="new_cat_name" placeholder="Enter New category Name">
                            </div>
                            @error('new_cat_name')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group row  ">
                            <div class="col-md-6 ">
                                <label for="brand_id">Select Brand</label>
                                <select type="text" name="brand_id" class="form-control" id="brand_nam" placeholder="Enter category Name">
                                    <option>--select Brand--</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-md-6">
                                <label for="name">or Add new Brand</label>
                                <input type="text" name="new_brand_name" class="form-control" id="new_brand_name" placeholder="Enter New category Name">
                            </div>
                            @error('new_brand_name')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group row  ">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group row ">
                                <div class="custom-file col-md-8 ">
                                    <input type="file"  name="image" placeholder="Enter image" class="custom-file-input imagerender">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                                    <span class="text-danger" id="Eimage"> </span>

                                <div class="d-flex justify-content-center col-md-4 ">
                                    <img style="width: 70px; height:70px; background: red" src="" alt="" class="previewImg">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer my-3 d-flex justify-content-cente align-items-center  ">
                            <button type="submit" class="btn btn-primary mt-1">Submit</button>

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
 <!--sell Edit model end-->



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
{{-- <div id="" class="product_model" >
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


{{-- </div>

@endsection --}}
@extends('layouts.master.master')
@section('content')
<div class="container pb-5 ">
    <div class="row"><h1>Sell Index</h1>

    </div>
   <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="  ">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{route('sell.create')}}"   class="btn btn-success  mr-2"
                       >Add</a>
                </div>
            </div>
            <div class="card-body mt-2">
                <table id="export_example" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer Name</th>
                            <th>Added by</th>
                            <th>Paid</th>
                            <th>Dew</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id=" ">
                        @foreach ($purchase as $purchas )
                            <tr>
                                <th>{{$purchas->id}}</th>
                                <th>{{$purchas->contact->real_name}}</th>
                                <th>{{$purchas->user->name}}</th>
                                <th>{{$purchas->grand_pay}}৳</th>
                                <th>{{$purchas->grand_dew}}৳</th>
                                <th>{{$purchas->grand_total}}৳</th>
                                <th class="btn-group">
                                    <button value="{{$purchas->id}}" id="editSell"
                                        class="m-1 btn btn-success btn-sm editSell custom_model_btn"  ><i class="fas fa-edit"></i></button>
                                    <div>
                                        <form action="{{url('sell/'.$purchas->id)}}" method="post">@csrf @method('DELETE')
                                            <button onclick="archiveFunction()" class="m-1 btn btn-danger btn-sm"
                                            type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="sell"
                                        class="m-1 btn btn-success btn-sm showPurchas  printMe2"> <i class="fas fa-print"></i> </button>
                                    <button value="{{$purchas->id}}" id="showPurchas" url="sell"
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
    <div id="" class="custom_model " >
        <div class="">
            <div class="custom_modal_content card"  style="background: #9fe7e5 ;overflow: auto ; height:80vh ;">

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
                                id="ashik">

                                <span class="input-group-append">
                                    <button class="btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <div id="">
                        <form action="" id="sellUpdateForm" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
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
                                            <th >Name</th>
                                            <th >Target price</th>
                                            <th>Selling price</th>
                                            <th>Quantity</th>
                                            <th>discount</th>
                                            <th>Total</th>
                                            <th style="max-width: 60px"></th>
                                        </thead>
                                        <tbody class="proTable">

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
                                                        <select name="seller_id" class="selectC form-control-lg form-control py-2 border-right-0 border select3" id="seller_id" >
                                                        <option >--select suplier--</option>

                                                        </select>
                                                        <span class="input-group-append"></span>
                                                        <button class="btn btn-primary border-left-0 border customer" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        </span>
                                                    </div>
                                                    <label style="width: 80px" class="btn btn-sm btn-success col payment-sell-btn my-2"> Pay More</label>
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
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_before" id="grandBefore" class="form-control col grandBefore">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Total Discount</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_dis" id="grandDis" class="form-control col grandDis " >

                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Old Grand Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="grand_total" id="grandTotal"
                                                class="form-control col oldGrandTotal">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">Previous Paid</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="pre_pay" id="grandPay"
                                                class="form-control col grandPay">
                                            </div>
                                            <div class="row text-end mt-1">
                                                <label for="" class="col">New Grand Total</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="" id="grandDew"
                                                class="form-control col grandTotal">
                                            </div>
                                            <div class="row text-end mt-1 cashBackDiv">
                                                <label for="" class="col">CashBack</label>
                                                <input style="width: 200px" readonly type="text" value="0" name="cash_back" id="cashBack"
                                                class="form-control col cashBack">
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
                                             class="form-control dewTotal grandDew" name="grand_dew" id="dewTotal">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5 mb-5" >
                                        <button id="" class="btn btn-primary " type="submit"> Change Record</button>
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
