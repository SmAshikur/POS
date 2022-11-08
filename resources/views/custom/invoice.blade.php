<div class=" row">
    <div class="container mb-5 mt-3 px-3 ">
        <div class="row d-flex align-items-baseline px-3">
            <div class="col-sm-9">
                <div class="d-flex">
                    @if(config('data.logo')!= null)
                    <img src="{{asset('images/'.config('data.logo'))}}"
                    class="brand-image  elevation-3" style="opacity: .8 ; width:60px; height:60px">
                    @else
                    <img src="{{asset('images/setting/bits.jpg')}}"
                    class="brand-image  elevation-3" style="opacity: .8 ; width:60px; height:60px">
                    @endif
                    <h2 class="pt-3 ml-5">{{config('data.name')}}</h2>
                </div>
            </div>
            <div class="col-sm-3 float-end">
                <a class="btn btn-light text-capitalize border-0 printMe" data-mdb-ripple-color="dark"><i
                class="fas fa-print text-primary"></i> Print</a>
                <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                class="far fa-file-pdf text-danger"></i> Export</a>
            </div>
        </div>
        <hr>
        <div class="container ">
            <div class="col-sm-12 ">
            </div>
            <div class="row ">
                <div class="col-sm-8">
                <ul class="list-unstyled">
                    <li class="text-muted">To: <span class="contact" style="color:#5d9fc5 ;">John Lorem</span></li>
                    <li class="text-muted d-none">Street, City</li>
                    <li class="text-muted"><span class="address"></span>, Bangladesh</li>
                    <li class="text-muted"><i class="fas fa-phone"></i> <span class="mobile"></span></li>
                </ul>
                </div>
                <div class="col-sm-4">
                <p class="text-muted">Invoice</p>
                <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">ID:</span><span class="invoice_no"></span></li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Creation Date: </span> <span class="invoice_date"></span></li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold status">
                        Unpaid</span></li>
                </ul>
                </div>
            </div>

            <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody class="showtr">

                </tbody>

                </table>
            </div>
            <div class="row">
                <div class="col-sm-8">
                <label class="row bg-gray py-1 my-1 px-5"> payment Method</label>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <td scope="row">#</td>
                            <td class="">Cash</td>
                            <td class="">Mobile </td>
                            <td class="">Bank</td>
                            <td scope="row">Date</td>
                            </tr>
                    </thead>
                    <tbody class="payment_method">

                    </tbody>
                </table>
                </div>
                <div class="col-sm-3">
                <ul class="list-unstyled" style="">
                    <li class="text-muted ms-3"><span class="text-black me-4">Total Price</span><span class="grand_before"></span></li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Discount</span><span class="grand_dis"></span></li>
                </ul>
                <hr>
                <p class="text-black float-start"><span class="text-black me-3"> Final Amount</span><span
                    class="grand_total" style="font-size: 18px;"></span>
                </p>
                <p class="text-black float-start"><span class="text-black me-3"> Total Paid</span><span
                    class="grand_pay" style="font-size: 13px ; color:rgb(7, 45, 7)"></span>
                </p>
                <p class="text-black float-start"><span class="text-black me-3"> Due Amount</span><span
                    class="grand_dew" style="font-size: 15px; color:rgb(192, 10, 10)"></span>
                </p>
                </div>
            </div>
            <hr>
            <div class="row" >
                <div class="col-sm-6">
                <p>Thank you for your purchase</p>
                </div>
                <div class="col-md-6 text-center px-5">
                    <p> Invoice By : {{Auth::user()->name}}</p>
                    @isset(Auth::user()->mobile)<p class="mr-2"> Mobile : {{Auth::user()->mobile}}</p> @endisset
                </div>
            </div>
        </div>
    </div>
</div>
