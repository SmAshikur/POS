<form action="" method="POST" enctype="multipart/form-data" id="contactAddForm">@csrf

    <div class="card-body p-3 col-md-6 offset-md-3" >

        <div class="form-group  ">
            <div class=" ">
                <label for="name"> Name</label>
                <input type="text" name="name" class="form-control"  placeholder="Enter Product Name">
            </div>
                <span class="text-danger" id="Cname" > </span>
            <div class="type d-none">
                <label for="name"> Type</label>
                <select  name="type" class="form-control conType"  placeholder="Enter Product Name">
                    <option value="1">Suplier</option>
                    <option value="2">Customer</option>
                    <option value="3">Both</option>
                </select>
            </div>

                <span class="text-danger" id="Cname" > </span>

            <div class=" ">
                <div class="row">
                    <div class="">
                        <label for="name">mobile</label>
                        <div class="input-group">
                            <input name="mobile"  class="form-control"  type="text" />
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-danger" id="Cmobile" > </span>
            <div class=" ">
                <label for="name"> Address</label>
                <input type="text" name="address" class="form-control"   placeholder="Enter Product Name">
            </div>

                <span class="text-danger" id="Caddress"> </span>

        </div>
        <div class="form-group  ">
            <label for="exampleInputFile">File input</label>
            <div class="input-group row ml-1">
                <div class="custom-file col-md-8 ">
                    <input type="file"  name="image" placeholder="Enter image" class="custom-file-input imagerender">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                    <span class="text-danger" id="Eimage"> </span>
                <div class="d-flex justify-content-center col-md-8 mt-2">
                    <img style="width: 70px; height:70px;" src="" alt="" class="previewImg">
                </div>
            </div>
        </div>
        <div class="card-footer my-3 d-flex justify-content-cente align-items-center  ">
            <button type="submit" class="btn btn-primary mt-1">Submit</button>

        </div>
    </div>

</form>
