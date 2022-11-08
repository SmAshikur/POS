@extends('layouts.master.master')
@section('content')
    <div class="container">


        <div class="row"><h1>Add Product Page</h1>

        </div>
       <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="  ">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a href="{{route('product.index')}}" class="btn btn-success"> back </a>
                    </div>
                </div>
                @include('custom.addProduct')
            </div>
          </div>
       </div>
    </div>
@endsection
