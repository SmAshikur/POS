@extends('layouts.master.master')
@section('content')


<div class="container pb-5" id="okk">
    <div class="d-flex justify-content-end mb-3 ">
        <a href="{{route('return.index')}}"   class="btn btn-primary mt-2 mr-5"
           >Back</a>
    </div>
    <div class="row">
        <div class=" col-md-6  mt-1  ">
           <div class="row ">
            <div class=" col text-end  mb-1"  style=""> <h4>Select Invoice</h4></div>
            <div class="col">
                <select name="seller_id" class="form-control py-2 border-right-0 border returnProduct" id="invoicePurchase" >
                    <option >--select Invoice--</option>
                    @foreach ($purchases as $pur )
                        <option value="{{$pur->id}}">{{$pur->invoice_no}}</option>
                    @endforeach
                </select>
            </div>
           </div>
        </div>
        <div class="col-md-6 mt-1  pr-5">
          <div class="row">
            <span class="mb-1 col text-end"  style=""> <h4>Select Product </h4></span>
            <select name="invoice product"  class="col form-control py-2 border-right-0 border testing invoice" id="testing" >
                <option value="0">---product---</option>
            </select>
          </div>
        </div>
    </div>
   <div id="returnPur">
    <form action="{{route('purchas.store')}}" id="returnPurForm" method="POST" enctype="multipart/form-data">@csrf
        <div class="row mx-1 my-2 p-2">

        </div>
        <div class="modal-body ">
                <div class="card px-5 py-2 "  style="background-color:#414a4c ; color:aliceblue ">
                     <div class="row">
                        <div class= "d-flex justify-content-between">
                            <div class="form-inline">
                                <label for="">Return Invoice No:</label>
                                <input type="text" name="invoice_no" id="" class="form-control ml-2 my-3">
                            </div>
                            <div id="purAlert" class="alert alert-primary alert-dismissible fade show mx-2 my-3" role="alert">
                                <strong ><a  style="text-decoration: none; color:rgb(75, 13, 13)" href="{{route('purchas.index')}}">Lets go to index</a></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="text-center table mt-4" style="opacity: 0.9">
                        <thead class="bg-primary py-2 my-1">
                            <th >Name</th>
                            <th >Buy price</th>
                            <th> price</th>
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
                                        <label for="">Suplier Name</label>
                                        <div id="select-two" class=" form-group">
                                            {{-- <select name="seller_id" value="0" class="d-none form-control-lg form-control py-2 border-right-0
                                             border select3" id="seller_id" >
                                            <option >--select suplier--</option>
                                            </select> --}}
                                            <input name="seller_id" value="0" class="d-none
                                            border seller_id" id="seller_id" >
                                            <input type="text" class="form-control" name="" id="seller_name" readonly>
                                            {{-- <span class="input-group-append"></span>
                                            <button class="d-none btn btn-primary border-left-0 border" data-bs-toggle="modal" data-bs-target="#exampleModa2" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            </span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class=" ml-1" for="">Click here:</label>
                                        <span class="btn btn-primary payment-rtn-btn btn-block"> Pay Amount</span>
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
                            <button id="returnBtn" class="btn btn-primary" type="submit"> Return Product</button>
                        </div>
                    </div>

                </div>

        </div>
    </form>
   </div>











      <!--Add Modal -->

      <!--Edit Modal -->
      {{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      </div> --}}




<!--contact -->
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
