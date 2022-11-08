@extends('layouts.master.master')
@section('content')
<div class="container">
    <div class="row"><h1>Product Page</h1>

    </div>
   <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="  ">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{route('product.cat')}}" class="btn btn-success"> Add </a>
                </div>
            </div>
            <div class="card-body mt-2">
                <table id="export_example" class="table">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Code </th>
                            <th> Category </th>
                            <th> Brand </th>
                            <th> Image </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody  id="productTbody">
                        @foreach ( $products as $product)
                        <tr>

                            <td>
                                <span class=" ">Name: <b>{{$product->name}}</b></span>
                            </td>
                            <td>
                                <div>
                                    <span>
                                        Code:
                                        @isset($product->bar_code)
                                           <b> {{$product->bar_code}}</b>
                                            @else
                                            no Code

                                        @endisset
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <span>category:
                                        @isset($product->category)
                                            <b>{{$product->category->name}}</b>
                                        @endisset
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span>
                                    Brand:
                                    @isset($product->brand)
                                        <b>{{$product->brand->name}}</b>
                                        @else
                                        no

                                    @endisset
                                </span>
                            </td>
                            <td>
                                @isset($product->image)
                                     <img style="width: 100px; height:50px" src="{{asset('images/'.$product->image)}}">
                                @else
                                    <img style="width: 100px; height:50px" src="{{asset('images/setting/noImage.webp')}}">
                                @endisset
                            </td>
                            <td class="">
                               <div class="btn-group">
                                <button value="{{$product->id}}" id="editProduct" class="mx-1 btn btn-success btn-sm"  data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                                <button pro_id="{{$product->id}}" id="" class="showProduct mx-1 btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                <form action="{{route('product.destroy',$product->id)}}" method="post">@csrf @method('DELETE')
                                    <button onsubmit="archiveFunction()" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                               </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
   </div>
</div>
<section>

      <!--Add Modal -->
      <div class=" modal fade" id="livestream_scanner"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="row modal-dialog">
            <div class="modal-content col-md-4">
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

      <!--Edit Modal -->
      <div class="container-fluid modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="overflow: auto">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit product From</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body " style="overflow-y: scroll">

                <form action="" method="POST" enctype="multipart/form-data" id="productUpdateForm">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <input type="text" name="id" id="productsId" class="d-none" >
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" id="productName"
                                placeholder="Enter Product Name">
                                <span id="Ename" class="text-danger"> </span>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="">
                                        <label for="name">Product code</label>
                                        <div class="input-group">
                                            <input name="bar_code" id="scanner_input" class="form-control barCode" placeholder="Scan Barchode" type="text" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#livestream_scanner">
                                                    <i class="fa fa-barcode"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <span id="Ecode" class="text-danger"> </span>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="cat_id">Select Category</label>
                                <select type="text" name="cat_id" class="form-control" id="productCat_id" placeholder="Enter category Name">
                                    <option>--select Brand--</option>
                                    @foreach ($cats as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name">or Add new Category</label>
                                <input type="text" name="new_cat_name" class="form-control" id="new_cat_name" placeholder="Enter New category Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="brand_id">Select Brand</label>
                                <select type="text" name="brand_id" class="form-control" id="productBrand_id" placeholder="Enter category Name">
                                    <option>--select Brand--</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name">or Add new Brand</label>
                                <input type="text" name="new_brand_name" class="form-control" id="new_brand_name" placeholder="Enter New category Name">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group row m-2">
                                <div class="custom-file col-md-8 ">
                                    <input type="file"  name="image" placeholder="Enter image" class="custom-file-input imagerender">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="d-flex justify-content-center col-md-4">
                                    <img style="width: 70px; height:70px; background: red" src="" alt="" class="previewImg editProductImg" class="">
                                </div>
                            </div>
                            <span id="Eimage" class="text-danger"> </span>

                        </div>
                        <div class="form-group row ">
                            <label for="exampleInputFile m-2">Product Description</label>
                            <div class="input-group row m-2 ">
                                    <textarea type="text" id="des" name="description" class="md-textarea form-control" rows="3">
                                    {{Auth::user()->about}}</textarea>
                                @error('image')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
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


      {{-- <div class="container-fluid modal fade" id="showModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body " style="">
               @include('custom.viewProduct')
                <div class="d-flex justify-content-center col-md-4">

                </div>
            </div>
          </div>
        </div>
      </div> --}}
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
</section>
@endsection
