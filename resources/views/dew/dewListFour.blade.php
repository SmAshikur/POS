
@extends('layouts.master.master')
@section('content')
<section>
    <div class="d-flex justify-content-end p-2 mb-4 nav-item bg-dark mx-2">
        <a href="{{route('dew.index')}}" class="btn nav-link m-1 p-2 {{'dew'== request()->path()?'active btn-primary':''}}"> Purchase Due</a>
        <a href="{{route('dew.sell')}}" class="btn nav-link m-1  p-2 {{'dew-sell'== request()->path()?'active btn-primary':''}}"> Sell Due</a>
        <a href="{{route('dew.return')}}" class="btn nav-link m-1 p-2  {{'dew-return'== request()->path()?'active btn-primary':''}}"> Purchase Return Due</a>
        <a href="{{route('dew.back')}}" class="btn nav-link m-1  p-2 {{'dew-back'== request()->path()?'active btn-primary':''}}"> Sell Back Due</a>
    </div>
    <div class=" col-md-10 offset-md-1  p-3">

        <table id="export_example" class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>type</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="brandTbody">
                @foreach ( $dew as $brand )
                <tr>
                    <th>{{$brand->name}}</th>
                    <th>{{$brand->mobile}}</th>
                    <th>Purchase</th>
                    <th>
                        @php
                        $a =0;
                        @endphp
                        @foreach($brand->dewBack as $value)
                        @php
                        $a += $value->amount;
                        @endphp
                        @endforeach
                        {{$a}}
                    </th>
                    <th class="btn-group">
                        <button href="" value="{{$brand->id}}"  id="dewShow" type="back"
                            class="btn btn-success btn-sm  mb-4" data-toggle="modal" data-target="#modalContactForm">
                            pay</button>
                        <div class="mx-2">
                            <form action="{{url('brand/'.$brand->id)}}" method="post">@csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <section>
            <div id="" class="custom_model" >
                <div class="">

                    <div class="custom_modal_content" style="background-color: #e5f5f9; min-height: 90vh ;
                    margin-top:-60px ;  overflow:auto">

                        <div class="card-body ">
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <span class="custom_modal_close" style="margin-top: -20px ; ">x</span>
                                </div>
                            </div>
                            <div class="p-5 d-flex justify-content-between">
                                <h4> Sell dew of: <label class="ml-5 seller"> </label></h4>
                                <h4> Total Invoice: <label class="mr-5 ml-2 length"> </label></h4>
                                <hr>
                             </div>
                            <div class=" ">
                                    <div class="modal-body mx-3">
                                        <input type="hidden" name="id"  class="form-control validate" value="">
                                        <input type="hidden" name="length"  id="length" class="form-control validate" value="">

                                        <div class="col-10 offset-1">
                                            <table class="table text-center table-stripped">
                                                <thead>
                                                     <tr>
                                                         <th></th>
                                                         <th>Invoice No </th>
                                                         <th> Amount  </th>
                                                         <th> </th>
                                                     </tr>
                                                </thead>
                                                <tbody class="dewRow">

                                                </tbody>
                                             </table>
                                        </div>
                                      </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>




<div id="" class="custom_model_three" style="margin-top:-10px" >
    <div class="">
        <div class="small_modal_content card" style="background-color: #4358e0; ">
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
            <form action="" id="dueUpdateForm" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
                <input type="hidden" name="" id="dew_id">
                <input type="hidden" name="pur_id" id="pur_id">
                <input type="hidden" name="" id="c_id">
                <input type="hidden" name="grand_total" class="grandTotal">
                <div class="card-body">
                    @include('custom.paymentTwo')
                    <div class="row mt-2 payment_pay">
                        <div class="col-10 offset-2 d-flex justify-content-end">
                            <label class="mx-2" for="">New </label>
                            <label class="mx-2" for="">Due </label>
                            <input readonly style="width: 200px" type="text" value="0" placeholder="0"
                            class="form-control dewTotal" name="new_dew" id="dewTotal">
                        </div>
                    </div>
                </div>
                <div class=" d-flex justify-content-center mb-5">
                    <button class="btn btn-dark pay-btn"> submit </button>
                    <span class="wait-btn" style="font-weight: 900"></span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
