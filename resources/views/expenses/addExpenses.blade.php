@extends('layouts.master.master')
@section('content')
    <div class="container">
        <div class="row"><h1>Add Expenses Page</h1>

        </div>
       <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="  ">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a href="{{route('expenses.index')}}" class="btn btn-success"> back </a>
                    </div>
                </div>
                <div class="card-body mt-2">
                     <form action="{{route('expenses.store')}}" method="post"> @csrf
                        <div class="form-group col-md-6 offset-md-3">
                            <label for="expense_category">Expanse Amount</label>
                            <input type="text" name="expense" class="mb-3 form-control cashTotal" id="cashTotal"
                             readonly required>
                            @error('expense')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror
                            <span class="btn btn-primary payment-ex-btn btn-block"> Enter Amount</span>
                        </div>
                        <div class="form-group col-md-6 offset-md-3">
                            <label for="expense">Expanse category </label>
                            <select type="text" name="expense_category" class="form-control"
                            id="brand_nam" placeholder="Enter category Name">
                                <option>--select Expense category --</option>
                                <option value="transport"> transport</option>
                                <option value="others">others </option>
                            </select>
                                @error('expense_category')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 offset-md-3">
                            <label data-error="wrong" data-success="right" for="form8">Note</label>
                            <textarea type="text" id="" name="note" class="md-textarea form-control" rows="4"></textarea>

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
                                                <h4 class="text-dark payTitle"></h4>
                                            </div>
                                            <div class="col-md-6 text-end mt-1 d-none">
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
                       <div class="row">
                        <div  class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">submit</button>
                        </div>
                       </div>
                     </form>
                </div>
            </div>
          </div>
       </div>
    </div>
@endsection
