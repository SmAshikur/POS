@extends('layouts.master.master')
@section('content')
<section>
    <div class="container">
        <div class="row"><h1>Admin Page</h1>

        </div>
       <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="  ">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <span  class="btn btn-success"> Add </span>
                    </div>
                </div>
                <div class="card-body mt-2 p-5">
                    <table id="export_example" class=" table-bordered table">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> Name </th>
                                <th> Role </th>
                                <th> Email </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key )
                            <tr>
                                <td> {{$key->id}}</td>
                                <td> {{$key->name}}</td>
                                <td> {{$key->role}}</td>
                                <td> {{$key->email}}</td>
                                <td class="btn-group">
                                    <button value="{{$key->id}}" id="editRole" class="btn btn-success btn-sm mr-2"
                                        data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                    <div>
                                        <form action="{{url('role/'.$key->id)}}" method="post">@csrf @method('DELETE')
                                            <button onclick="archiveFunction()" class="btn btn-danger btn-sm" type="submit">Delete</button>
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
</section>
<section>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
              <button type="button" id=" " class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="roleFrom" action="" method="post"> @csrf @method('put')
                    <div class="form-group col-md-6 offset-md-3">
                        <input id="roleId" type="hidden">
                        <label for="role">Category Name</label>
                        <input readonly type="text" name="name" class="form-control" id="name" placeholder="Enter category name">
                        @error('name')
                            <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="expense">Category Name</label>
                        <select type="text" name="role" class="form-control" id="role" placeholder="Enter category Name">
                            <option>--select Expense category --</option>
                            <option value="admin"> Admin</option>
                            <option value="user">User </option>
                        </select>
                            @error('role')
                            <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                   <div class="row">
                    <div  class="d-flex justify-content-center">
                        <button id="roleBtn" type="submit" class="btn btn-success">submit</button>
                    </div>
                   </div>
                 </form>
            </div>

          </div>
        </div>
    </div>
</section>
@endsection
