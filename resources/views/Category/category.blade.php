@extends('layouts.master.master')
@section('content')
<div class="container">
    <div class="row"><h1>Category Page</h1>
    </div>
   <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="  ">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button   class="btn btn-success btn-sm mr-2"
                        data-bs-toggle="modal" data-bs-target="#createCatModal">Add</button>
                </div>
            </div>
            <div class="card-body mt-2">
                <table id="export_example" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTbody">
                        @foreach ( $categories as $category )
                        <tr>
                            <th>{{$category->id}}</th>
                            <th>{{$category->name}}</th>
                            <th><img src="{{asset('images/'.$category->image)}}" style="width: 70px; height:50px" alt=""></th>
                            <th class="btn-group">
                                <button cat_id="{{$category->id}}" id="editCat" class="btn btn-success btn-sm mr-2"
                                    data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                                    <form action="{{url('category/'.$category->id)}}" method="post">@csrf @method('DELETE')
                                        <button onsubmit="archiveFunction()" class="btn btn-danger btn-sm" type="submit"><i class=" fas fa-trash"></i></button>
                                    </form>
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

<div class=" ">
      <!--Add Modal -->
      <div class="modal fade" id="createCatModal" tabindex="-1" aria-labelledby=" " aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
              <button type="button" id="editModalcloser" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text"   name="name" class="form-control" id="name" placeholder="Enter category Name">
                            @error('name')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"  name="image" placeholder="Enter image" class="custom-file-input imagerender">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            @error('image')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <img style="width: 200px; height:200px; background: red" src="" alt=""   class="editPreviewImg">
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


</div>
@endsection
