<div class="d-flex justify-content-center">
    {{-- <h2 class="payment_head">Add Balance </h2> --}}
</div>
<div class="row" class="bg-drak">
    {{-- <div class="col-sm-6">
        <label for="" > Select a Payment Method</label>
        <div id="" class="input-group form-group ">
            <select style=""  name="" class="payment_main payment_method form-control  py-2 " id="" >
                <option >---select Method---</option>
                <option   value="1">Cash </option>
                <option  value="3">Bank </option>
                <option  value="2">Mobile Bank</option>
            </select>
            <span class="input-group-append">
            <button class="btn btn-primary border-left-0 border payment-add-btn addBtnpay"  type="button">
                <i class="fa fa-plus"></i>
            </button>
            </span>
        </div>
    </div> --}}
    <div class="col-sm-6 d-none  ">
        <label for="" > Payment Type:</label>
        <div id="" class="input-group form-group ">

            <select style=""  name="payment_type"  class=" payment_type form-control  py-2 " id="" readonly="true">
                <option value="0">---select Method---</option>
                <option  value="1">Add Balance</option>
                <option  value="2">Withdraw Balance</option>
                <option  value="3">Sell Payment</option>
                <option  value="4">Purchase Payment</option>
                <option  value="5">cash Back</option>
                <option  value="6">Cash Return</option>
                <option  value="7">Expense</option>
            </select>
            <span class="input-group-append">
                <button class="btn btn-primary border-left-0 border payment-add-btn addBtnpay"  type="button">
                    <i class="fa fa-plus"></i>
                </button>
            </span>
        </div>
    </div>
    <div class="col-sm-6">

    </div>
</div>
<div>
    {{-- <div class="bg-info mt-2 mb-3 d-flex justify-content-end">
        <span class="btn mr-5 text-white" id=""> <i class="fa fa-plus"></i></span>
    </div> --}}
    <table class="table table-bordered table-dark table-sm mt-2 cash_fill del_payment_close">

            <tr>
                <th rowspan="2">
                    <div class="form-check mt-4" >
                        <input style="height: 20px; width:20px ; margin-left: -30px" name="payment_method[]"
                        class="form-check-input del_payment" type="checkbox" value="1" id="">
                      </div>
                </th>
                <th rowspan="2" style="min-width: 150px" >
                   <div class="mt-4"> Payment On Cash:</div>
                </th>
                <th>Note</th>
                <th>Amount</th>
            </tr>

            <tr>
                 {{-- --}}

                <th>
                     <input readonly style="width: 200px" type="text" class="form-control payment_type payment_inf">
                </th>
                <th class="cashTh">
                    <input class="ajaxAmount ajaxCash " value="0" type="hidden" id="ajaxCash">
                    <input class="beforeCash afterCash" value="0" type="hidden" id="afterCash">
                    <input readonly style="min-width: 100px" type="text" value="0"
                    class="form-control cash_amount payment_close" name="cash_amount" id="cash_amount_two">
                </th>
            </tr>

    </table>
    <table class="table table-bordered table-dark table-sm mt-2 mobile_fill del_payment_close">
        <tr>
            <th rowspan="2">
                <div class="form-check mt-4" >
                    <input style="height: 20px; width:20px ; margin-left: -30px"
                    name="payment_method[]" class="form-check-input del_payment" type="checkbox" value="2">
                  </div>
            </th>
            <th rowspan="2" style="width: 120px" >

               <div class="mt-4" style="margin-bottom: 5px"> Mobile Banking:</div>
            </th>
            <th>Mobile No:</th>
            <th>Transition id</th>
            <th>Amount</th>
        </tr>
        <tr>
            <th><input  readonly type="text" class="form-control payment_inf"></th>
            <th><input readonly  type="text" class="form-control payment_inf"></th>
            <th  class="cashTh"><input readonly style="min-width: 100px" type="text" value="0"
                class="form-control mobile_amount payment_close"
                name="mobile_amount" id="mobile_amount_two">
                <input class="ajaxAmount ajaxMcash" value="0" type="hidden" id="ajaxMcash">
                <input class="beforeCash afterMcash" value="0" type="hidden" id="afterMcash">
            </th>
        </tr>


    </table>
    <table class="table table-bordered table-dark table-sm mt-2 bank_fill del_payment_close">
        <tr>
            <th rowspan="2">
                <div class="form-check mt-4" >
                    <input style="height: 20px; width:20px ; margin-left: -30px" name="payment_method[]"
                    class="form-check-input del_payment" type="checkbox" value="3" id="">
                  </div>
            </th>
            <th rowspan="2" style="width: 120px" >

               <div class="mt-4" style="margin-bottom: 5px"> Bank payment:</div>
            </th>
            <th>Account Type</th>
            <th>Account No:</th>
            <th>Amount</th>
        </tr>
        <tr>
            <th><input readonly  type="text" class="form-control payment_inf" ></th>
            <th><input readonly type="text" class="form-control payment_inf"></th>
            <th  class="cashTh"><input readonly style="min-width: 100px" type="text" value="0"
                class="form-control bank_amount payment_close" name="bank_amount" id="bank_amount_two">
                <input class="ajaxAmount ajaxBcash" value="0" type="hidden" id="ajaxBcash">
                <input class="beforeCash afterBcash" value="0" type="hidden" id="afterBcash">
            </th>
        </tr>




    </table>
    {{-- <div class="bg-info mt-2 mb-3 d-flex justify-content-end">
        <span class="btn mr-5 text-white" id=""> <i class="fa fa-plus"></i></span>
    </div> --}}
    <div class="row mt-5 payment_pay bg-drak">
        <div class="col-10 offset-2 p-2 d-flex justify-content-end">
            <label class="mx-2" for="">Total</label>
            <label class="mx-2" for="">Paid </label>
            <input readonly style="width: 200px" type="text"  value="0"
            class="form-control cashTotal" name="cash_total" id="cashTotal">
        </div>
    </div>
    <div class="row mt-2 payment_pay d-none">
        <div class="col-10 offset-2 d-flex justify-content-end">
            <label class="mx-2" for="">Total </label>
            <label class="mx-2" for="">Due </label>
            <input readonly style="width: 200px" type="text" value="0"
            class="form-control dewTotal" name="dew" id="dewTotal">
        </div>
    </div>
    <div class="d-none d-flex justify-content-center">
        <button type="submit"  class="btn btn-success" > submit</button>
    </div>

</div>
