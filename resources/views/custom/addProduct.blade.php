<div class="card-body mt-2" >
    <form action=" " method="post" id="productAddForm"> @csrf
        <div class="form-group col-md-10 offset-md-1">
            <div class="row">
                <div class="col">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product Name">
                    @error('name')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="name">Product code</label>
                    <div class="input-group">
                        <input name="bar_code" id="scanner_input" class="form-control" placeholder="Scan Barchode" type="text" />
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#livestream_scanner">
                                <i class="fa fa-barcode"></i>
                            </button>
                        </span>
                    </div>
                    @error('bar_code')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
            </div>
       </div>
       <div class="form-group col-md-10 offset-md-1">
           <div class="form-group row">
               <div class="col-md-6 ">
                   <label for="cat_id">Select Category</label>
                   <select type="text" name="cat_id" class="form-control" id="cat_name" placeholder="Enter category Name">
                       <option>--select category--</option>
                       @foreach ($cats as $category)
                           <option value="{{$category->id}}" >{{$category->name}}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col-md-6">
                   <label for="name">or Add new Category</label>
                   <input type="text" name="new_cat_name" class="form-control" id="new_cat_name" placeholder="Enter New category Name">
               </div>
               @error('new_cat_name')
                   <span class="text-danger"> {{$message}}</span>
               @enderror
           </div>
       </div>
       <div class="form-group col-md-10 offset-md-1">
           <div class="form-group row">
               <div class="col ">
                   <label for="brand_id">Select Brand</label>
                   <select type="text" name="brand_id" class="form-control" id="brand_nam" placeholder="Enter category Name">
                       <option>--select Brand--</option>
                       @foreach ($brands as $brand)
                           <option value="{{$brand->id}}" >{{$brand->name}}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col ">
                   <label for="name">or Add new Brand</label>
                   <input type="text" name="new_brand_name" class="form-control" id="new_brand_name" placeholder="Enter New category Name">
               </div>
               @error('new_brand_name')
                   <span class="text-danger"> {{$message}}</span>
               @enderror
           </div>

       </div>
       <div class="form-group col-md-10 offset-md-1 ">
           <label for="exampleInputFile m-2">File input</label>
           <div class="input-group row m-2 ">
               <div class="custom-file col-md-6  ">
                   <input type="file"  name="image" placeholder="Enter image" class="custom-file-input imagerender">
                   <label class="custom-file-label" for="exampleInputFile">Choose file</label>
               </div>
               @error('image')
                   <span class="text-danger"> {{$message}}</span>
                @enderror
               <div class="d-flex justify-content-center col-md-6 ">
                   <img style="width: 70px; height:70px; background: red" src="" alt="" class="previewImg">
               </div>
           </div>
       </div>
        <div class="form-group col-md-10 offset-md-1 ">
            <label for="exampleInputFile m-2">Product Description</label>
            <div class="input-group row m-2 ">
                    <textarea type="text" id="form8" name="description" class="md-textarea form-control" rows="3">
                    {{Auth::user()->about}}</textarea>
                @error('image')
                    <span class="text-danger"> {{$message}}</span>
                @enderror
            </div>
        </div>
      <div class="row">
       <div  class="d-flex justify-content-center">
           <button type="submit" class="btn btn-success">submit</button>
       </div>
      </div>
    </form>
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
