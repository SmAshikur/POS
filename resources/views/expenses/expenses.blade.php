@extends('layouts.master.master')
@section('content')
    <div class="container">
        <div class="row"><h1>Expenses Page</h1>

        </div>
       <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="  ">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a href="{{route('expenses.create')}}" class="btn btn-success"> Add </a>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <table id="export_example" class="table">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> Amount </th>
                                <th> Reason </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $key )
                            <tr>
                                <td> {{$key->id}}</td>
                                <td> {{$key->expense}}৳ </td>
                                <td> {{$key->expense_category}}</td>
                                <td class="btn-group">
                                    <button value="{{$key->id}}" id="editExpenses" class="d-none btn btn-success btn-sm mr-2"
                                        data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                    <div>
                                        <form action="{{url('expenses/'.$key->id)}}" method="post">@csrf @method('DELETE')
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
              <button type="button" id="editModalcloser" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="expenseFrom" action="" method="post"> @csrf @method('put')
                    <div class="form-group col-md-6 offset-md-3">
                        <input type="hidden" name="" id="expenseId">
                        <label for="expense_category">Expanses Amount</label>
                        <input type="text" name="expense" class="form-control" id="expense" placeholder="Enter category expense">
                        @error('expense')
                            <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <label for="expense">Expanses category</label>
                        <select type="text" name="expense_category" class="form-control" id="expense_category" placeholder="Enter category Name">
                            <option>--select Expense category --</option>
                            <option value="transport"> transport</option>
                            <option value="others">others </option>
                        </select>
                            @error('expense_category')
                            <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 offset-md-3">
                        <textarea type="text" id="" name="note" class="md-textarea form-control" rows="4"></textarea>
                        <label data-error="wrong" data-success="right" for="form8">Your About</label>
                      </div>
                   <div class="row">
                    <div  class="d-flex justify-content-center">
                        <button id="expenseBtn" type="submit" class="btn btn-success">submit</button>
                    </div>
                   </div>
                 </form>
            </div>

          </div>
        </div>
    </div>

@endsection
