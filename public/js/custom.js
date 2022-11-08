$(document).ready(function(){
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $('#name').keyup(function(){
        console.log($(this).val());
    });
    $(".previewImg").hide();

    $('.imagerender').change(function(){
        //console.log($(this).get(0).files[0])
        var file = $(this).get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $(".previewImg").fadeIn();
                $(".previewImg").attr("src", reader.result);
                $(".editPreviewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
     })
// for category
    $('#addCategoryFormBtn').click(function(){
        alert('hi')
    })


     $(document).on('click', '#editCat', function () {
        //event.preventDefault();
        $(".previewImg").fadeIn();
        var id = $(this).attr('cat_id');
        console.log(id)
        $.ajax({
            type: "get",
            url: "category/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
               // console.log(response)
                $(".editPreviewImg").fadeIn();
                $('#eidtImg').attr('src','images/'+response.image+'');
                $('#catName').val(response.name)
                $('#catId').val(response.id)
            },error:function(){
                console.log('error')
            }
        })
    });
    $(document).on('submit','#updateForm', function (e) {
        e.preventDefault();
       var id = $('#catId').val()
       let  UpformData = new FormData($("#updateForm")[0]);
        console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "category/"+id,
            data: UpformData,
            contentType: false,
           // contentType: false,
            processData: false,

            success: function (response) {
                toastr.success("category update successfully")
               // $('#categoryTbody').html('')
               //location.reload(true);
               //allData()
               // console.log(response)
            },error:function(err){
                console.log(err.responseJSON.errors.name)
                console.log(err.responseJSON.errors.image)
                $('#errName').text(err.responseJSON.errors.name);
                //$('#Erraddress').text(err.responseJSON.errors.address);
                $('#errImg').text(err.responseJSON.errors.image);
               // $('#Errmobile').text(err.responseJSON.errors.mobile);
               // console.log(err.responseJSON.errors)
            }
        });

    });

    $(document).on('click','#editModalcloser', function (e){
        location.reload(true);
    })
    // for brand
    $(document).on('click','#editBrandModalcloser', function (e){
        location.reload(true);
    })
    $(document).on('click', '#editBrand', function (event) {
       event.preventDefault();
       var id = $(this).val();
       $.ajax({
           type: "get",
           url: "brand/"+id+"/edit",
           data: "data",
           dataType: "json",
           success: function (response) {

               $('#brandImg').attr('src','images/'+response.image+'');
               $(".previewImg").fadeIn();
               $('#brandName').val(response.name)
               $('#brandId').val(response.id)
           },error:function(){
               console.log('error')
           }
       })
   });
   $(document).on('submit','#brandUpdateForm', function (e) {
       e.preventDefault();
      var id = $('#brandId').val()
      let  UpformData = new FormData($("#brandUpdateForm")[0]);
       console.log(UpformData);
       $.ajax({
           type: "POST",
           url: "brand/"+id,
           data: UpformData,
           contentType: false,
          // contentType: false,
           processData: false,

           success: function (response) {
              // $('#brandTbody').html('')
              // brandData()
               //console.log(response)
              // location.reload(true);
               toastr.success("category update successfully")
           },error:function(err){
            console.log(err.responseJSON.errors.name)
            console.log(err.responseJSON.errors.image)
            $('#errBrandName').text(err.responseJSON.errors.name);
            //$('#Erraddress').text(err.responseJSON.errors.address);
            $('#errBrandImg').text(err.responseJSON.errors.image);
               //$('#Errname').text(err.responseJSON.errors.name);
               //$('#Erraddress').text(err.responseJSON.errors.address);
              // $('#Errimage').text(err.responseJSON.errors.image);
              // $('#Errmobile').text(err.responseJSON.errors.mobile);
              // console.log(err.responseJSON.errors)
           }
       });

   });


   // for product
   $(document).on('keyup','#new_cat_name',function(){
        $('#cat_name').val('')
   })
   $(document).on('change','#cat_name',function(){
        $('#new_cat_name').val('')
   })
   $(document).on('keyup','#new_brand_name',function(){
        $('#brand_nam').val('')
   })
   $(document).on('change','#brand_nam',function(){
        $('#new_brand_name').val('')
   })

   $(document).on('click', '#editProduct', function (event) {
        event.preventDefault();
        var id = $(this).val();
        console.log(id)
        $.ajax({
            type: "get",
            url: "product/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $(".previewImg").fadeIn();
                $('.editProductImg').attr('src','images/'+response.image+'');
                $('#productName').val(response.real_name)
                $('#product_qty').val(response.qty)
                $('#productCat_id').val(response.cat_id)
                $('#productBrand_id').val(response.brand_id)
                $('#productImg').val(response.image)
                $('#productsId').val(response.id)
                $('.barCode').val(response.bar_code)
                $('#des').val(response.description)
               // console.log(response)
            },error:function(){
                console.log('error')
            }
        })
    });
    $(document).on('click', '.showProduct', function (event) {
        event.preventDefault();
        var id = $(this).attr('pro_id');
        console.log(id)
            $.ajax({
                type: "get",
                url: "/product/"+id,
                data: "data",
                dataType: "json",
                success: function (response) {
                   // $(".previewImg").fadeIn();
                   if(response.image != null){
                    $('.editProductImg').attr('src','/images/'+response.image);
                   }else{
                    $('.editProductImg').attr('src','/images/setting/noImage.webp');
                   }
                   if(response.category != null){
                    $('.cat').text(response.category.name)
                   }else{
                    $('.cat').text("No Categories")
                   }
                   if(response.brand != null){
                    $('.brand').text(response.brand.name)
                   }else{
                    $('.brand').text("No Brand")
                   }
                    $('.productName').text(response.name)
                   if(response.inventory != null){
                    $('.qty').text(response.inventory.qty)
                    $('.rate').text('৳'+response.inventory.target_price)
                   }else{
                    $('.qty').text(0)
                   // $('.rate').text('   ৳')
                   }
                   if(response.sold != null){
                    $('.sold-qty').text(response.sold.qty)
                   }else{
                    $('.sold-qty').text(0)
                   }
                    $('#productImg').val(response.image)
                    $('#productsId').text(response.id)
                    $('.description').text(response.description)
                    $('.barCode').text(response.bar_code)
                    $('.product_model').fadeIn(500)
                    console.log(response)
                },error:function(){
                    console.log('error')
                }
            })
    });
    $(document).on('click','.product_modal_close',function(){
        $('.product_model').fadeOut(1000)
    })
    $(document).on('submit','#productAddForm', function (e) {
        e.preventDefault();
     //   alert('hi')
        let  UpformData = new FormData($("#productAddForm")[0]);
         console.log(UpformData);
         $.ajax({
             type: "POST",
             url: "/product",
             data: UpformData,
             contentType: false,
            // contentType: false,
             processData: false,

             success: function (response) {
                 console.log(response)
                 toastr.success("New product Added")
             },error:function(err){
                toastr.error("fill up all needed thing")
                if(err.responseJSON.errors.bar_code != undefined){
                    toastr.error(err.responseJSON.errors.bar_code)
                }
                if(err.responseJSON.errors.name != undefined){
                    toastr.error(err.responseJSON.errors.name)
                }
                if(err.responseJSON.errors.new_cat_name != undefined){
                    toastr.error(err.responseJSON.errors.new_cat_name)
                }
                if(err.responseJSON.errors.new_brand_name != undefined){
                    toastr.error(err.responseJSON.errors.new_brand_name)
                }
                if(err.responseJSON.errors.image != undefined){
                    toastr.error(err.responseJSON.errors.image)
                }
                ///console.log(err.responseJSON.errors.new_cat_name)
                //  $('#Ename').text(err.responseJSON.errors.name);
                //  $('#Ecode').text(err.responseJSON.errors.bar_code);
                //  $('#Eimage').text(err.responseJSON.errors.image);
                // $('#Errmobile').text(err.responseJSON.errors.mobile);
                // console.log(err.responseJSON.errors)
             }
         });

     });
    $(document).on('submit','#productUpdateForm', function (e) {
       e.preventDefault();
        //alert("i am ready");
       var id = $('#productsId').val()
       let  UpformData = new FormData($("#productUpdateForm")[0]);
        console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/product/"+id,
            data: UpformData,
            contentType: false,
           // contentType: false,
            processData: false,

            success: function (response) {
               toastr.success('Product Update Successfully!')
                location.reload(true);
            },error:function(err){
                if(err.responseJSON.errors.bar_code != undefined){
                    toastr.error(err.responseJSON.errors.bar_code)
                }
                if(err.responseJSON.errors.name != undefined){
                    toastr.error(err.responseJSON.errors.name)
                }
                if(err.responseJSON.errors.new_cat_name != undefined){
                    toastr.error(err.responseJSON.errors.new_cat_name)
                }
                if(err.responseJSON.errors.new_brand_name != undefined){
                    toastr.error(err.responseJSON.errors.new_brand_name)
                }
                if(err.responseJSON.errors.image != undefined){
                    toastr.error(err.responseJSON.errors.image)
                }
            }
        });

    });
    // product end  here

// purcahse

    $('#new_suplier').hide()
    $('#hide_suplier').hide()


    $(document).on('click','#show_supiler',function(){
        $('#new_suplier').fadeIn()
        $('#show_supiler').hide()
        $('#hide_suplier').fadeIn()
    })
    $(document).on('click','#hide_suplier',function(){
        $('#new_suplier').fadeOut()
        $('#hide_suplier').hide()
        $('#show_supiler').fadeIn()

    })
    $(document).on('click','.payment_model_close',function(){
        $('.payment_model').fadeOut(300)
        PaymentRefresh()
    })
    getContact()
    invoiceRefresh()
    PaymentRefresh()

    function invoiceRefresh(){
        $('.dewTotal').val(0)
        $('.payTotal').val(0)
        $('.cashBack').val(0)
    }
    function PaymentRefresh(){
        $('#cashTotal').val(0)
        $(".del_payment").prop("checked", false)
        var parent= $('.del_payment_close')
        $(parent).find('.payment_close').val(0)
        $(parent).find('.payment_inf').val(' ')
        $(parent).find('input').attr('readonly',true)
    }
    function calRefresh(){
        $('.grandTotal').val(0)
        $('.grandBefore').val(0)
        $('.grandDis').val(0)
    }
    $(document).on('keyup change','#purchaseProductSearch' ,function (e){
        e.preventDefault();
        var search = $(this).val();
      $('#submitBtn').show();
      $("#showCalculateBtn").fadeIn(2000)
        if(search.length >=4 ){
            $.ajax({
                url:'/get-product',
                type:"get",
                data:{search:search},
                success:function (resp) {
                 // console.log(resp);
                   $.each(resp,function(key,value){
                 //  console.log(value)
                var parent =$('.'+value.id+'').val()
                    if(value.id != parent){
                        if(value.name == search || value.bar_code == search){
                            toastr.success('data match')
                             $('.proTable').append('<tr value="'+value.id+'" class=" purchaseRow" id="close'+value.id+'">\
                             <td  class=" -2  mt-2"><input name="p_id[]" value="'+value.id+'" class="'+value.id+'" type="hidden">\
                             <input type="text"  id=""  value="'+value.name+'" pro_id="'+value.id+'" class="showProduct form-control pro_name " readonly>\
                             </td>\
                             <td class="   mt-2">\
                             <input type="text"  name="price[]" class="form-control perPrice checkZero" value="100">\
                             </td>\
                             <td class="   mt-2">\
                                 <div class="input-group">\
                                     <span class="btn btn-success input-append qtyMinPur"> -</span>\
                                     <input type="text" name="qty[]" class="form-control purQty checkZero" value="1">\
                                     <span  class="btn btn-success input-append qtyAddPur"> + </span>\
                                 </div>\
                             </td>\
                             <td class="   mt-2">\
                             <input type="text" name="discount[]" class="form-control purDis checkNaN" value="0">\
                             </td>\
                             <td class="   mt-2" >\
                             <input type="hidden"  name="total_before[]" class="form-control total_before value="1" readOnly>\
                             <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                             <input type="text"  name="total_price[]" class="form-control total value="100" readOnly>\
                             </td>\
                             <td class="   mt-2">\
                             <input type="text" name="profit[]" class="form-control profit checkNaN" value="0">\
                             </td>\
                             <td class="">\
                             <input readonly type="text" name="target_price[]" class="form-control final" value="100">\
                             </td>\
                             <td>\
                             <span p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> \
                             </td>\
                             </tr>');
                         }else if(value.name!= search){
                            toastr.warning("no data match")
                         }
                    }else{
                        toastr.warning("this product is already In")
                    }
                })
                    },error:function(){
                        alert("error");
                    }
            })
        }

    // $(document).on('dblclick','.p_close' ,function (e){
    //     e.preventDefault()
    //     $(this).parents('.purchaseRow').remove();
    // })
    })
    $('#purAlert').hide()
    $(document).on('submit','#purchaseAdd', function (e) {
        e.preventDefault();
        let  UpformData = new FormData($("#purchaseAddForm")[0]);
         console.log(UpformData);
         $.ajax({
             type: "POST",
             url: "/purchas",
             data: UpformData,
             contentType: false,
            // contentType: false,
             processData: false,
             success: function (valueonse) {
                 toastr.success("Purchase Done successfully !")
                 $('.proTable tr').remove();
                 invoiceRefresh()
                 calRefresh()
                 PaymentRefresh()
                 $('#invoice_no').val('')
             },error:function(err){
                toastr.error("Fillup all needed fills")
                if(err.responseJSON.errors.seller_id != undefined){
                    toastr.error(err.responseJSON.errors.seller_id)
                }
                if(err.responseJSON.errors.grand_total != undefined){
                    toastr.error(err.responseJSON.errors.grand_total)
                }
                if(err.responseJSON.errors.invoice_no != undefined){
                    toastr.error(err.responseJSON.errors.invoice_no)
                }
                if(err.responseJSON.errors.payment_method != undefined){
                    toastr.error("chose a payment method!")
                }
                if(err.responseJSON.errors.pay != undefined){
                    toastr.error(err.responseJSON.errors.pay)
                }
              //  console.log(err)
             }
         });
    });
    $(document).on('click', '#editPurchas', function () {
        $('.proTable tr').remove();
         var id = $(this).val();
         $('.cashTotal').val(0)
         console.log(id)
         $.ajax({
             type: "get",
             url: "purchas/"+id+"/edit",
             data: "data",
             dataType: "json",
             success: function (response) {
                 $('.select3').val(response.seller_id)
                 $('#purchasId').val(response.id)
                 $('#purchaseUpdatebtn').val(response.id)
                 $('.grandBefore').val(response.grand_before)
                 $('.grandDis').val(response.grand_dis)
                 $('.grandPay').val(response.grand_pay)
                 $('.grandDew').val(response.grand_dew)
                 $('.dewTotal').val(response.grand_dew)
                 $('.oldGrandTotal').val(response.grand_total)
                 $('.grandTotal').val(response.grand_dew)
                 $('.payment').hide()
                 $('#invoice_no').val(response.invoice_no)
                console.log(response.contact.id);
                 $.each(response.inventory,function(key,value){
               console.log(value.product)
                     $('.proTable').append('<tr class="purchaseRow bg-dark"  id="close'+value.id+'">\
     <td ><input name="p_id[]" value="'+value.product.id+'" class="'+value.id+'" type="hidden">\
     <input name="inventory_id[]" value="'+value.id+'" type="hidden">\
     <input type="text" name="st_name[]" value="'+value.product.name+'" pro_id="'+value.product.id+'" class="showProduct form-control" readonly>\
     </td>\
     <td >\
     <input type="text"  name="price[]" class="form-control perPrice" value="'+value.price+'">\
     </td>\
     <td >\
         <div class="input-group">\
         <span class="btn btn-success input-append qtyMinPur"> -</span>\
         <input type="text"   name="qty[]" class="form-control purQty" value="'+value.qty+'">\
         <span  class="btn btn-success input-append qtyAddPur"> + </span>\
         </div>\
     </td>\
     <td >\
     <input type="text"  name="discount[]" class="form-control purDis" value="'+value.discount+'">\
     </td>\
     <td >\
     <input type="hidden"  name="total_before[]" class="form-control total_before value="'+value.total_price+'" readOnly>\
      <input type="hidden"  name="total_dis[]" class="form-control total_dis value="'+value.total_price+'" readOnly>\
     <input type="text"   name="total_price[]" class="form-control total " value="'+value.total_price+'" readOnly>\
     </td>\
     <td >\
     <input type="text"   name="profit[]" class="form-control profit" value="'+value.profit+'">\
     </td>\
     <td >\
     <input readOnly type="text"  id="final'+value.id+'" name="target_price[]" class="form-control final  " value="'+value.target_price+'">\
     </td>\
     <td>\
     <span p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> \
     </td>\
     </tr>');
                 })
                 //$(".editPreviewImg").fadeIn();
                // $('#eidtImg').attr('src','images/'+response.image+'');
                // $('#catName').val(response.name)
               //  $('#catId').val(response.id)
             },error:function(){
                 console.log('error')
             }
         })
    });
    $('#purchaseUpdatebtn').hide()
    $('#purchaseUpdate').hide()
    $(document).on('submit','#purchaseUpdateForm', function (e) {
       e.preventDefault();
        var id = $('#purchasId').val()
       //alert(id);
       let  UpformData = new FormData($("#purchaseUpdateForm")[0]);
        console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/purchas/"+id,
            data: UpformData,
            contentType: false,
           // contentType: false,
            processData: false,
            success: function (response) {
                toastr.success("New purchase updated")
                invoiceRefresh()
                PaymentRefresh()
            },error:function(err){
               toastr.error("Fillup all needed fills")
               // alert('error')
              console.log(err)
                $('.Eseller').text(err.responseJSON.errors.seller_id);
                $('.Etotal').text(err.responseJSON.errors.price);
                $('.Edew').text(err.responseJSON.errors.qty);
               // $('#Errmobile').text(err.responseJSON.errors.mobile);
               // console.log(err.responseJSON.errors)
            }
        });


    });

    // purchase End here !
    // this is as a defualt for both purcahse,sell,return invoice !
    $(document).on('click','.showPurchas',function(){
       var id= $(this).val()
       var url= $(this).attr('url')
       //alert('hi')
       $('.showtr tr').remove()
       $('.payment_method tr').remove()
       $('.custom_model_two').show()
       $.ajax({
           type: "get",
           url: "/"+url+"/"+id,
           data: "data",
           dataType: "json",
           success: function (response) {
              // console.log(response)
               var invoice_date= new Date(response.created_at);
               $('.invoice_no').text(response.invoice_no)
               $('.contact').text(response.contact.name)
               $('.mobile').text(response.contact.mobile)
               $('.invoice_date').text(invoice_date.toLocaleString())
               $('.address').text(response.contact.address)
              if(response.inventory != undefined){
               $.each(response.inventory,function(key,value){
                   $('.showtr').append('<tr>\
                   <th scope="row">'+parseInt(key)+1+'</th>\
                   <td>'+value.product.real_name+'</td>\
                   <td>'+value.qty+'</td>\
                   <td>৳'+value.price+'</td>\
                   <td>৳'+value.total_price+'</td>\
                 </tr>')
               })
              }else if(response.sold != undefined){
               $.each(response.sold,function(key,value){
                   $('.showtr').append('<tr>\
                   <th scope="row">'+parseInt(key)+1+'</th>\
                   <td>'+value.product.real_name+'</td>\
                   <td>'+value.qty+'</td>\
                   <td>৳'+value.price+'</td>\
                   <td>৳'+value.total_price+'</td>\
                 </tr>')
               })
              }else if(response.backs != undefined){
               $.each(response.backs,function(key,value){
                   $('.showtr').append('<tr>\
                   <th scope="row">'+parseInt(key)+1+'</th>\
                   <td>'+value.product.real_name+'</td>\
                   <td>'+value.qty+'</td>\
                   <td>৳'+value.price+'</td>\
                   <td>৳'+value.total_price+'</td>\
                 </tr>')
               })
              }else if(response.sell_backs != undefined){
                $.each(response.sell_backs,function(key,value){
                    $('.showtr').append('<tr>\
                    <th scope="row">'+parseInt(key)+1+'</th>\
                    <td>'+value.product.real_name+'</td>\
                    <td>'+value.qty+'</td>\
                    <td>৳'+value.price+'</td>\
                    <td>৳'+value.total_price+'</td>\
                  </tr>')
                })
               }
              console.log(response)
               $.each(response.payment, function(key,value){
                if(value.cash != null){ console.log(value.cash)}
                if(value.mcash != null){ console.log(value.mcash)}
                if(value.bcash != null){ console.log(value.bcash)}
                   var method = JSON.parse(value.payment_method)
                   var date= new Date(value.created_at);
                   if(value.cash != null){ x = value.cash.cash_amount +"৳"}else{x='-'}
                   if(value.mcash != null){ y = value.mcash.mobile_amount+"৳"}else{y='-'}
                   if(value.bcash != null){ z = value.bcash.bank_amount+"৳"}else{z='-'}
                  // alert(date.toLocaleString())
                   $('.payment_method').append('<tr>\
                   <td scope="row">'+parseInt(key+1)+'</td>\
                   <td class="">'+x+'</td>\
                   <td class="">'+y+'</td>\
                   <td class="">'+z+'</td>\
                   <td scope="row">'+date.toLocaleString()+'</td>\
                   </tr>')
               })
               if(response.grand_total != undefined){
               $('.grand_total').text('৳'+response.grand_total)
               $('.grand_pay').text('৳'+response.grand_pay)
               $('.grand_dew').text('৳'+response.grand_dew)
               if(response.grand_dew>0){
                   $('.status').text('Unpaid')
               }else if (response.grand_dew == 0){
                   $('.status').text('Paid')
               }
               $('.grand_before').text('৳'+response.grand_before)
               $('.grand_dis').text('৳'+response.grand_dis)
           }else{
               $('.grand_total').text('৳'+response.return_total)
               $('.grand_pay').text('৳'+response.return_pay)
               $('.grand_dew').text('৳'+response.return_dew)
               if(response.return_dew>0){
                   $('.status').text('Unpaid')
               }else if (response.return_dew == 0){
                   $('.status').text('Paid')
               }
               $('.grand_before').text('৳'+response.return_before)
               $('.grand_dis').text('৳ 0')
           }
           }
       })
    })


// Purchase return strat here!

    $(document).on('change','#invoicePurchase' ,function (e){
        var id = $(this).val();
        e.preventDefault();
        $.ajax({
            url:'/get-rtn-product',
            type:"get",
            data:{id:id},
        // dataType: 'json',
            success:function (resp) {
            console.log(resp.id)
            //alert(resp.seller_id)
            $('.seller_id').val(resp.seller_id)
            $('#seller_name').val(resp.contact.real_name)
                $.each(resp.inventory,function(key,value){
                console.log(value)
                // $('.select2').append('<option value="'+value.id+'">'+value.name+'</option>')
                    $('.invoice .ajOption').remove()
                    $('.invoice').append('<option class="ajOption" value="'+value.product.name+'">'+value.product.name+'</option>')
                })
            }
        })
    })
    $(document).on('change','.testing' ,function (e){
        e.preventDefault();
        var search = $(this).val();
    //alert(search)
        if(search.length >=4 ){
            $.ajax({
                url:'/get-inv-product',
                type:"get",
                data:{search:search},
            // dataType: 'json',
                success:function (resp) {
                // console.log(resp);
               // getContact()
                $.each(resp,function(key,value){
                    var parent =$('.'+value.id+'').val()
                    //parentId =$('.'+value.name+'').atr('id')
                    if(value.inventory.purchase != null){
                       var contact_name = value.inventory.purchase.contact.name
                    }else{
                        var contact_name = " "
                    }
                    if(value.id != parent){
                    //alert('hi')
                    if(value.name == search){
                        toastr.success('data match')
                        $('.proTable').append('<tr class="purchaseRow" value="'+value.id+'"  id="close'+value.id+'">\
                        <input name="p_id[]" value="'+value.id+'" class="'+value.id+'" type="hidden">\
                        <td style="min-width: 250px; text-align:start" pro_id="'+value.id+'" class="showProduct" >Product Name: '+value.name+' <br> Seller Name: '+contact_name+'\
                        </td><td style="min-width: 100px"> \
                        <input class="form-control" name="price[]" value="'+value.inventory.price+'" readOnly>  </td>\
                        <td>\
                        <input type="text"  value="'+value.inventory.price+'" name="return_price[]" class="form-control perPrice" >\
                        </td>\
                        <input type="hidden" name="discount[]" class="form-control purDis " value="0">\
                        <input name="inv_id[]" value="'+value.inventory.id+'" type="hidden">\
                        <input name="product_id[]" value="'+value.inventory.product_id+'" type="hidden"> \
                        <input name="purchase_id[]" value="'+value.inventory.purchases_id+'" type="hidden"> \
                        <input name="new_qty[]" new_qty="'+value.inventory.qty+'" class="new_qty" value="0"  type="hidden">\
                        <td  >\
                            <div class="input-group">\
                            <span  class="btn btn-success input-append qtyMinPur"> -</span>\
                        <input type="text" name="qty[]" class="form-control purQty " value="1">\
                        <span qty="'+value.inventory.qty+'" class="btn btn-success input-append qtyAddPur "> +</span>\
                            </div>\
                        </td>\
                        <td >\
                        <input type="hidden"  name="total_before[]" class="form-control total_before value="1" readOnly>\
                        <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                        <input type="text" name="total_price[]" class="form-control total"value="'+value.inventory.price+'">\
                        </td>\
                        <td style="min-width: 60px"> <span class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> </td>\
                        </tr>');
                    }else if(value.name!= search){
                    // toastr.warning("no data match")
                    }
                }else{
                    toastr.warning('product already selected')
                }
                })
                    },error:function(){
                        alert("error");
                    }
            })
        }




    })
    $(document).on('submit','#returnPurForm', function (e) {
        e.preventDefault();
        let  UpformData = new FormData($("#returnPurForm")[0]);
        console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/return",
            data: UpformData,
            contentType: false,
            // contentType: false,
            processData: false,
            success: function (response) {
                toastr.success("product return successfully")
                $('.proTable tr').remove();
                invoiceRefresh()
                calRefresh()
                PaymentRefresh()
                $('#invoice_no').val('')
            },error:function(err){
                toastr.error("Fillup all needed fills")
                // alert('error')
          //  console.log(err.responseJSON)
                if(err.responseJSON.errors.seller_id != undefined){
                    toastr.error(err.responseJSON.errors.seller_id)
                }
                if(err.responseJSON.errors.grand_total != undefined){
                    toastr.error(err.responseJSON.errors.grand_total)
                }
                if(err.responseJSON.errors.invoice_no != undefined){
                    toastr.error(err.responseJSON.errors.invoice_no)
                }
                if(err.responseJSON.errors.payment_method != undefined){
                    toastr.error("chose a payment method!")
                }
                if(err.responseJSON.errors.grand_pay != undefined){
                    toastr.error(err.responseJSON.errors.grand_pay)
                }
            }
        });


    });
    $(document).on('click', '#editBack', function () {
        //event.preventDefault();
    // $(".previewImg").fadeIn();
    $('#purchaseAdd').hide()
    $('#purchaseUpdate').show()
    $('#purchaseUpdatebtn').show()
    $('#purchaseAddbtn').hide()
    //$('.editPurchas').hide()
    $('.proTable tr').remove();
    //getContact()
        var id = $(this).val();
        console.log(id)
        $.ajax({
            type: "get",
            url: "/return/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#seller_id').val(response.contact.id)
                $('#seller_name').val(response.contact.name)
                $('#purchasId').val(response.id)
                $('#purchaseUpdatebtn').val(response.id)
                $('#select-2').val(response.seller_id)
                $('#invoice_no').text(response.invoice_no)
                $('.grandPay').val(response.return_pay)
                $('.dewTotal').val(response.return_dew)
                $('.grandBefore').val(response.return_before)
                $('.oldGrandTotal').val(response.return_total)
                $('.grandTotal').val(response.return_dew)
            //console.log(response.backs);
                $.each(response.backs,function(key,value){
                   // console.log(value)
                    var next_qty=  parseInt(value.product.inv.qty)+parseInt(value.qty)
                    if(value.product.inv.purchase != null){
                        var contact_name = value.product.inv.purchase.contact.name
                     }else{
                         var contact_name = " "
                     }
                var parent =$('.'+value.id+'').val()
                if(value.id != parent){
                    //var margin =((value.target_price- value.price)/value.price)*100
                    $('.proTable').append('<tr class="purchaseRow bg-dark" value="'+value.id+'"  id="close'+value.id+'">\
                    <input value="'+value.id+'" class="'+value.id+'">\
                    <td style="min-width: 250px; text-align:start" pro_id="'+value.product.id+'" class="showProduct" >Product Name: '+value.product.name+' <br> Seller Name:'+contact_name+'  \
                    </td><td style="min-width: 100px"> \
                    <input class="form-control" name="price[]" value="'+value.price+'" readOnly>  </td>\
                    <td>\
                    <input type="text"  p_id="'+value.id+'" value="'+value.return_price+'" name="return_price[]" class="form-control perPrice" >\
                    </td>\
                    <input name="backs_id[]" value="'+value.id+'" type="hidden">\
                    <input name="inv_id[]" value="'+value.inv_id+'" type="hidden">\
                    <input name="product_id[]" value="'+value.product_id+'" type="hidden"> \
                    <input name="purchase_id[]" value="'+value.purchase_id+'" type="hidden"> \
                    <input name="new_qty[]" new_qty="'+value.qty+'" class="new_qty"  type="hidden" \
                    value="'+value.product.inv.qty+'"  old_qty="'+value.product.inv.qty+'">\
                    <td  >\
                        <div class="input-group">\
                        <span  p_id="'+value.id+'" class="btn btn-success input-append qtyMinPur"> -</span>\
                    <input type="text" name="qty[]" class="form-control purQty " value="'+value.qty+'">\
                    <span qty="'+next_qty+'" class="btn btn-success input-append qtyAddPur "> +</span>\
                        </div>\
                    </td>\
                    <td class="d-none">\
                        <input type="text"  name="discount[]" class="form-control purDis" value="0">\
                    </td>\
                    <td >\
                    <input type="hidden"  name="total_before[]" class="form-control total_before value="'+value.price+'" readOnly>\
                    <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                    <input type="text" p_id="'+value.id+'" name="total_price[]" class="form-control total"value="'+value.price+'">\
                    </td>\
                    <td style="min-width: 60px"> <span p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> </td>\
                    </tr>');
                }else{
                    toastr('alredy exists')
                }
                })
                //$(".editPreviewImg").fadeIn();
            // $('#eidtImg').attr('src','images/'+response.image+'');
            // $('#catName').val(response.name)
            //  $('#catId').val(response.id)
            },error:function(){
                console.log('error')
            }
        })
    });
    $(document).on('submit','#returnUpdateForm', function (e) {
        e.preventDefault();
        var id = $('#purchasId').val()
        let  UpformData = new FormData($("#returnUpdateForm")[0]);
        //console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/return/"+id,
            data: UpformData,
            contentType: false,
            // contentType: false,
            processData: false,
            success: function (response) {

                toastr.success("Return updated")
                invoiceRefresh()
                PaymentRefresh()
               // console.log(response)
                // location.reload(true);
            },error:function(err){
                toastr.error("Fillup all needed fills")
                // alert('error')
            //console.log(err)

            }
        });


    });

// Purchase return end here!
// Sell strat here  !
    $(document).on('keyup , change','#invProduct' ,function (e){
        e.preventDefault();
        var search = $(this).val();
    $('#submitBtn').show();
    $("#showCalculateBtn").fadeIn(2000)
        if(search.length >=4 ){
            $.ajax({
                url:'/get-inv-product',
                type:"get",
                data:{search:search},
            // dataType: 'json',
                success:function (resp) {
                //console.log(resp);
               // getContact()
                $.each(resp,function(key,value){

                console.log(value.inventory.id)
                var parent =$('.'+value.id+'').val()
                // alert(parent)
                    if(value.id != parent){
                        if(value.name == search){
                        //  alert(value.id)
                            toastr.success('data match')
                            $('.proTable').append('<tr class="purchaseRow" value="'+value.id+'"  id="close'+value.id+'">\
                            <input name="p_id[]" value="'+value.id+'" class="'+value.id+'" type="hidden">\
                            <td style="min-width: 200px" pro_id="'+value.id+'" class="showProduct"> '+value.name+' \
                            </td><td style="min-width: 100px"> '+value.inventory.target_price+' TK </td>\
                            <input value="'+value.inventory.price+'" name="price[]" type="hidden" >\
                            <td>\
                            <input type="text" value="'+value.inventory.target_price+'" name="sold_price[]" class="form-control perPrice ">\
                            </td>\
                            <input name="inv_id[]" value="'+value.inventory.id+'" type="hidden">\
                            <input name="product_id[]" value="'+value.inventory.product_id+'" type="hidden"> \
                            <input name="purchase_id[]" value="'+value.inventory.product_id+'" type="hidden"> \
                            <input name="new_qty[]" new_qty="'+value.inventory.qty+'" class="new_qty" value="0"\
                            type="hidden">\
                            <td  >\
                                <div class="input-group">\
                                <span  class="btn btn-success input-append qtyMinPur"> -</span>\
                            <input type="text" id="qty'+value.id+'" name="qty[]" class="form-control purQty" value="1">\
                            <span qty="'+value.inventory.qty+'" class="btn btn-success input-append qtyAddPur "> +</span>\
                                </div>\
                            </td>\
                            <td >\
                            <input type="text" name="discount[]" class="form-control purDis " value="0">\
                            </td>\
                            <td >\
                            <input type="hidden"  name="total_before[]" class="form-control total_before value="1" readOnly>\
                            <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                            <input type="text"   name="total_price[]" class="form-control total "value="'+value.inventory.total_price+'">\
                            </td>\
                            <td style="min-width: 60px"> <span p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> </td>\
                            </tr>');
                        }else if(value.name!= search){
                        // toastr.warning("no data match")
                        }
                    }else{
                        toastr.warning('already selected!')
                    }
                })
                    },error:function(){
                        alert("error");
                    }
            })
        }



    })
    $(document).on('submit','#sellAddForm', function (e) {
        e.preventDefault();
        let  UpformData = new FormData($("#sellAddForm")[0]);
         console.log(UpformData);
         $.ajax({
             type: "POST",
             url: "/sell",
             data: UpformData,
             contentType: false,
             processData: false,
             success: function (valueonse) {
                 toastr.success("New Sells Added")
                 $('.proTable tr').remove();
                 invoiceRefresh()
                 calRefresh()
                 PaymentRefresh()
                 $('#invoice_no').val('')
             },error:function(err){
                toastr.error("Fillup all needed fills")
                if(err.responseJSON.errors.customer_id != undefined){
                    toastr.error("chose a customer")
                }
                if(err.responseJSON.errors.grand_total != undefined){
                    toastr.error(err.responseJSON.errors.grand_total)
                }
                if(err.responseJSON.errors.invoice_no != undefined){
                    toastr.error(err.responseJSON.errors.invoice_no)
                }
                if(err.responseJSON.errors.payment_method != undefined){
                    toastr.error("chose a payment method!")
                }
                if(err.responseJSON.errors.grand_pay != undefined){
                    toastr.error(err.responseJSON.errors.grand_pay)
                }
             }
         });


     });
    $(document).on('click', '#editSell', function () {
        //event.preventDefault();
       $('#purchaseAdd').hide()
       $('#purchaseUpdate').show()
       $('#purchaseUpdatebtn').show()
       $('#purchaseAddbtn').hide()
       $('.editPurchas').hide()
       $('.proTable tr').remove();
       //getContact()
        var id = $(this).val();
        console.log(id)
        $.ajax({
            type: "get",
            url: "/sell/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response)
                $('#seller_id').val(response.customer_id)
                $('#purchasId').val(response.id)
                $('.grandBefore').val(response.grand_before)
                $('.grandDis').val(response.grand_dis)
                $('.grandPay').val(response.grand_pay)
                $('.grandDew').val(response.grand_dew)
                $('.oldGrandTotal').val(response.grand_total)
                $('.grandTotal').val(response.grand_dew)
               // $('.grandTotal').val(response.grand_total)
                $('#invoice_no').val(response.invoice_no)
               // console.log(response);
                $.each(response.sold,function(key,value){
                    var next_qty = value.qty+value.product.inv.qty
                console.log(value.product)
                    $('.proTable').append('<tr class="purchaseRow bg-dark" value="'+value.id+'"  id="close'+value.id+'">\
                    <td style="min-width: 200px" pro_id="'+value.product.id+'" class="showProduct"> '+value.product.name+' \
                    </td><td style="min-width: 100px"> '+value.sold_price+' TK </td>\
                    <input value="'+value.price+'" name="price[]" type="hidden" >\
                    <td>\
                    <input type="text" value="'+value.sold_price+'" name="sold_price[]" class="form-control perPrice ">\
                    </td>\
                    <input name="sold_id[]" value="'+value.id+'" type="hidden">\
                    <input name="inv_id[]" value="'+value.inv_id+'" type="hidden">\
                    <input name="product_id[]" value="'+value.product_id+'" type="hidden"> \
                    <input name="purchase_id[]" value="'+value.product_id+'" type="hidden"> \
                    <input name="new_qty[]" new_qty="'+value.qty+'" \
                    old_qty="'+value.product.inv.qty+'" class="new_qty" value="'+value.qty+'"  type="hidden">\
                    <td  >\
                        <div class="input-group">\
                        <span  class="btn btn-success input-append qtyMinPur"> -</span>\
                    <input type="text" id="qty'+value.id+'" name="qty[]" class="form-control purQty" value="'+value.qty+'">\
                    <span qty="'+next_qty+'" class="btn btn-success input-append qtyAddPur "> +</span>\
                        </div>\
                    </td>\
                    <td >\
                    <input type="text" name="discount[]" class="form-control purDis " value="'+value.discount+'">\
                    </td>\
                    <td >\
                    <input type="hidden"  name="total_before[]" class="form-control total_before value="1" readOnly>\
                    <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                    <input type="text"   name="total_price[]" class="form-control total "value="'+value.total_price+'">\
                    </td>\
                    <td style="min-width: 60px"> <button p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </button> </td>\
                    </tr>');
                })
            },error:function(){
                console.log('error')
            }
        })
    });
    $(document).on('submit','#sellUpdateForm', function (e) {
        e.preventDefault();
      //   alert("i am ready");
         var id = $('#purchasId').val()
        let  UpformData = new FormData($("#sellUpdateForm")[0]);
         //console.log(UpformData);
         $.ajax({
             type: "POST",
             url: "/sell/"+id,
             data: UpformData,
             contentType: false,
            // contentType: false,
             processData: false,
             success: function (response) {

                 toastr.success("New Sell updated")
                 invoiceRefresh()
                 PaymentRefresh()
                // $('#brandTbody').html('')
                // brandData()
                 console.log(response)
                // location.reload(true);
             },error:function(err){
                toastr.error("Fillup all needed fills")
                // alert('error')
               console.log(err)
                 $('.Eseller').text(err.responseJSON.errors.seller_id);
                 $('.Etotal').text(err.responseJSON.errors.price);
                 $('.Edew').text(err.responseJSON.errors.qty);
                // $('#Errmobile').text(err.responseJSON.errors.mobile);
                // console.log(err.responseJSON.errors)
             }
         });


     });
// sell end here !

$(document).on('dblclick','.p_close' ,function (e){
    e.preventDefault()
    $(this).parents('.purchaseRow').remove();

})


// sold product return start here
    $(document).on('change','#invoiceSell' ,function (e){
        var id = $(this).val();
        e.preventDefault();
        $.ajax({
            url:'/get-rtn-sold',
            type:"get",
            data:{id:id},
        // dataType: 'json',
            success:function (resp) {
                //alert(resp.customer_id)
                $('#seller_id').val(resp.customer_id)
                $('#seller_name').val(resp.contact.name)
            console.log(resp)
                $.each(resp.sold,function(key,value){
                console.log(value)
                // $('.select2').append('<option value="'+value.id+'">'+value.name+'</option>')
                    $('.invoice').append('<option value="'+value.product.name+'">'+value.product.name+'</option>')
                })
            }
        })
    })
    $(document).on('change','.returnSellPro' ,function (e){
        e.preventDefault();
        var search = $(this).val();
    //alert(search)
        if(search.length >=4 ){
            $.ajax({
                url:'/get-inv-sold',
                type:"get",
                data:{search:search},
            // dataType: 'json',
                success:function (resp) {
                // console.log(resp);
              //  getContact()
                $.each(resp,function(key,value){

                    //parentId =$('.'+value.name+'').atr('id')
                // console.log(resp)
                    //$('#seller_id').val(resp.sold.sell.customer_id)
                    var parent =$('.'+value.id+'').val()
                    if(value.id != parent){
                    // alert(value.inv.qty)
                    // alert(value.sold.qty)
                //console.log(value)
                    if(value.name == search){

                        toastr.success('product match')
                        $('.proTable').append('<tr class="purchaseRow" value="'+value.id+'"  id="close'+value.id+'">\
                        <input value="'+value.id+'" class="'+value.id+'" type="hidden">\
                        <td style="min-width: 250px; text-align:start" pro_id="'+value.id+'" class="showProduct">Product Name: '+value.name+' <br> Seller Name:  \
                        </td><td style="min-width: 100px"> \
                        <input class="form-control" name="price[]" value="'+value.sold.price+'" readOnly>  </td>\
                        <td>\
                        <input type="text"  value="'+value.sold.price+'" name="return_price[]" class="form-control perPrice" >\
                        </td>\
                        <input type="hidden" name="discount[]" class="form-control purDis " value="0">\
                        <input name="inv_id[]" value="'+value.sold.inv_id+'" type="hidden">\
                        <input name="sold_id[]" value="'+value.sold.id+'" type="hidden">\
                        <input name="product_id[]" value="'+value.sold.product_id+'" type="hidden"> \
                        <input name="purchase_id[]" value="'+value.sold.purchases_id+'" type="hidden"> \
                        <input name="new_qty[]" new_qty="'+value.inv.qty+'" class="new_qty" value="0" \
                        type="hidden">\
                        <input name="new_sold_qty[]" new_qty="'+value.sold.qty+'" class="new_sold_qty" value="0" \
                        type="hidden">\
                        <td  >\
                            <div class="input-group">\
                            <span  class="btn btn-success input-append qtyMinPur"> -</span>\
                        <input type="text" name="qty[]" class="form-control purQty " value="1">\
                        <span qty="'+value.sold.qty+'" class="btn btn-success input-append qtyAddPur "> +</span>\
                            </div>\
                        </td>\
                        <td >\
                        <input type="hidden"  name="total_before[]" class="form-control total_before value="1" readOnly>\
                        <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                        <input type="text" name="total_price[]" class="form-control total"value="'+value.sold.price+'">\
                        </td>\
                        <td style="min-width: 60px"> <span class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> </td>\
                        </tr>');
                    }else if(value.name!= search){
                        toastr.warning("no data match")
                    }
                }else{
                    toastr.warning('product already selected')
                }
                })
                    },error:function(){
                        alert("error");
                    }
            })
        }




    })
    $(document).on('submit','#returnSellProductForm', function (e) {
        e.preventDefault();
       // alert("i am ready");
        let  UpformData = new FormData($("#returnSellProductForm")[0]);
        console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/product-return",
            data: UpformData,
            contentType: false,
            // contentType: false,
            processData: false,
            success: function (response) {
                toastr.success("product return successfully")
                $('.proTable tr').remove();
                invoiceRefresh()
                calRefresh()
                PaymentRefresh()
            },error:function(err){
                toastr.error("Fillup all needed fills")
                // alert('error')
                console.log(err.responseJSON)
                if(err.responseJSON.errors.customer_id != undefined){
                    toastr.error("chose a customer")
                }
                if(err.responseJSON.errors.grand_total != undefined){
                    toastr.error(err.responseJSON.errors.grand_total)
                }
                if(err.responseJSON.errors.invoice_no != undefined){
                    toastr.error(err.responseJSON.errors.invoice_no)
                }
                if(err.responseJSON.errors.payment_method != undefined){
                    toastr.error("chose a payment method!")
                }
                if(err.responseJSON.errors.grand_pay != undefined){
                    toastr.error(err.responseJSON.errors.grand_pay)
                }
            }
        });


    });
    $(document).on('click', '#editSellReturn', function () {
        //event.preventDefault();
    // $(".previewImg").fadeIn();
    // alert('hi')
    $('#purchaseAdd').hide()
    $('#purchaseUpdate').show()
    $('#purchaseUpdatebtn').show()
    $('#purchaseAddbtn').hide()
    //$('.editPurchas').hide()
    $('.proTable tr').remove();
    //getContact()
        var id = $(this).val();
        $.ajax({
            type: "get",
            url: "/product-return/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
            // console.log(response.sell_backs)
                $('#seller_id').val(response.contact.id)
                $('#seller_name').val(response.contact.name)
                $('#purchasId').val(response.id)
                $('#purchaseUpdatebtn').val(response.id)
                $('#select-2').val(response.seller_id)
                $('#invoice_no').text(response.invoice_no)
                $('.grandPay').val(response.return_pay)
                $('.dewTotal').val(response.return_dew)
                $('.grandBefore').val(response.return_before)
                $('.oldGrandTotal').val(response.return_total)
                $('.grandTotal').val(response.return_dew)
            //console.log(response.backs);
                $.each(response.sell_backs,function(key,value){
                console.log(value.product.sold.qty)
                var parent =$('.'+value.id+'').val()
                var next_qty = parseInt(value.qty+ value.product.sold.qty)
                if(value.id != parent){
                    //var margin =((value.target_price- value.price)/value.price)*100
                    $('.proTable').append('<tr class="purchaseRow bg-dark" value="'+value.id+'"  id="close'+value.id+'">\
                    <input value="'+value.id+'" class="'+value.id+'" type="hidden">\
                    <td style="min-width: 250px; text-align:start" >Product Name: '+value.product.name+' <br> Seller Name:  \
                    </td><td style="min-width: 100px"> \
                    <input class="form-control" name="price[]" value="'+value.price+'" readOnly>  </td>\
                    <td>\
                    <input type="text"  p_id="'+value.id+'" value="'+value.return_price+'" name="return_price[]" class="form-control perPrice" >\
                    </td>\
                    <input name="backs_id[]" value="'+value.id+'" type="hidden">\
                    <input name="inv_id[]" value="'+value.inv_id+'" type="hidden">\
                    <input name="sold_id[]" value="'+value.sold_id+'" type="hidden">\
                    <input name="product_id[]" value="'+value.product_id+'" type="hidden"> \
                    <input name="purchase_id[]" value="'+value.purchase_id+'" type="hidden"> \
                    <input name="new_qty[]" new_qty="'+value.qty+'" old_qty="'+value.product.inventory.qty+'"\
                    class="new_qty" value="0" type="hidden">\
                    <input name="new_sold_qty[]" new_qty="'+value.qty+'" old_qty="'+value.product.sold.qty+'"\
                    class="new_sold_qty" value="0"  type="hidden">\
                    <td  >\
                        <div class="input-group">\
                        <span  p_id="'+value.id+'" class="btn btn-success input-append qtyMinPur"> -</span>\
                    <input type="text" name="qty[]" class="form-control purQty " value="'+value.qty+'">\
                    <span qty="'+next_qty+'" class="btn btn-success input-append qtyAddPur "> +</span>\
                        </div>\
                    </td>\
                    <td class="d-none">\
                        <input type="text"  name="discount[]" class="form-control purDis" value="0">\
                    </td>\
                    <td >\
                    <input type="hidden"  name="total_before[]" class="form-control total_before value="'+value.price+'" readOnly>\
                    <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                    <input type="text" p_id="'+value.id+'" name="total_price[]" class="form-control total"value="'+value.price+'">\
                    </td>\
                    <td style="min-width: 60px"> <span p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> </td>\
                    </tr>');
                }else{
                    toastr.info('already here')
                }
                })
                //$(".editPreviewImg").fadeIn();
            // $('#eidtImg').attr('src','images/'+response.image+'');
            // $('#catName').val(response.name)
            //  $('#catId').val(response.id)
            },error:function(){
                console.log('error')
            }
        })
    });
    $(document).on('submit','#returnSellUpdateForm', function (e) {
        e.preventDefault();
        var id = $('#purchasId').val()
        let  UpformData = new FormData($("#returnSellUpdateForm")[0]);
        //console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/product-return/"+id,
            data: UpformData,
            contentType: false,
            // contentType: false,
            processData: false,
            success: function (response) {

                toastr.success("Return updated")
                invoiceRefresh()
                PaymentRefresh()
            },error:function(err){
                toastr.error("Fillup all needed fills")
                // alert('error')
            console.log(err)
                $('.Eseller').text(err.responseJSON.errors.seller_id);
                $('.Etotal').text(err.responseJSON.errors.price);
                $('.Edew').text(err.responseJSON.errors.qty);
                // $('#Errmobile').text(err.responseJSON.errors.mobile);
                // console.log(err.responseJSON.errors)
            }
        });


    });
// sold product return end here


// sell return strat here
$(document).on('keyup , change','#soldProduct' ,function (e){
    e.preventDefault();
    var search = $(this).val();
   // console.log(search)
  //alert($('.'+id+'').attr('id'))
  //$('#selectedProduct'+id+'').remove()
  $('#submitBtn').show();
  $("#showCalculateBtn").fadeIn(2000)
    if(search.length >=4 ){
        $.ajax({
            url:'/get-inv-sold',
            type:"get",
            data:{search:search},
           // dataType: 'json',
            success:function (resp) {
               console.log(resp);
             //  getContact()
               $.each(resp,function(key,value){
                alert('hi')
               console.log(value.sold)
                if(value.name == search){
                    toastr.success('data match')
                    $('.proTable').append('<tr class="purchaseRow" value="'+value.id+'"  id="close'+value.id+'">\
                    <td style="min-width: 200px" pro_id="'+value.id+'" class="showProduct"> '+value.name+' \
                    </td><td style="min-width: 100px"> '+value.sold.target_price+' TK </td>\
                    <td>\
                    <input type="text"  p_id="'+value.id+'" id="price'+value.id+'" \
                    price="'+value.sold.target_price+'" value="'+value.sold.target_price+'" name="price[]" class="form-control price price'+value.id+'" value="0">\
                    </td>\
                    <input name="p_id[]" value="'+value.sold.id+'" type="hidden">\
                    <input name="product_id[]" value="'+value.sold.product_id+'" type="hidden"> \
                    <input name="purchase_id[]" value="'+value.sold.product_id+'" type="hidden"> \
                    <input name="new_qty[]" value="'+value.sold.qty+'" class="new_qty'+value.id+'"  type="hidden">\
                    <td  >\
                        <div class="input-group">\
                        <span  p_id="'+value.id+'" class="btn btn-success input-append qtyMin"> -</span>\
                    <input type="text" p_id="'+value.id+'" id="qty'+value.id+'" name="qty[]" class="form-control qty qty'+value.id+'" value="1">\
                    <span qty="'+value.sold.qty+'" p_id="'+value.id+'" class="btn btn-success input-append qtyAdd "> +</span>\
                        </div>\
                    </td>\
                    <td >\
                    <input type="text" p_id="'+value.id+'" id="dis'+value.id+'" name="dis[]" class="form-control dis dis'+value.id+'" value="0">\
                    </td>\
                    <td >\
                    <input type="hidden"  name="total_before[]" class="form-control total_before value="1" readOnly>\
                    <input type="hidden"  name="total_dis[]" class="form-control total_dis value="0" readOnly>\
                    <input type="text" p_id="'+value.id+'" id="final'+value.id+'" name="st_final[]" class="form-control final final'+value.id+'"value="0">\
                    </td>\
                    <td style="min-width: 60px"> <span p_id="'+value.id+'" class="btn btn-danger btn-sm mx-2 text-bold p_close"> X </span> </td>\
                    </tr>');
                }else if(value.name!= search){
                   // toastr.warning("no data match")
                }
            })
                },error:function(){
                    alert("error");
                }
        })
    }



})

$(document).on('submit','#returnSellForm', function (e) {
    e.preventDefault();
    let  UpformData = new FormData($("#returnSellForm")[0]);
     console.log(UpformData);
     $.ajax({
         type: "POST",
         url: "/product-return",
         data: UpformData,
         contentType: false,
        // contentType: false,
         processData: false,
         success: function (valueonse) {

             toastr.success("product return to inventory successfully")
            // $('#brandTbody').html('')
            // brandData()
             //console.log(response)
            // location.reload(true);
         },error:function(err){
            toastr.error("Fillup all needed fills")
            // alert('error')
           console.log(err.responseJSON)
            // $('#Esell').text(err.responseJSON.errors.seller_id);
            // $('#Etotal').text(err.responseJSON.errors.grand_total);
            // $('#Edew').text(err.responseJSON.errors.dew);
            // $('#Errmobile').text(err.responseJSON.errors.mobile);
            // console.log(err.responseJSON.errors)
         }
     });


 });





    // contact (supplier and customer) strat here
    $(document).on('submit','#contactAddForm', function (e) {
        e.preventDefault();
        let  UpformData = new FormData($("#contactAddForm")[0]);
         console.log(UpformData);
         $.ajax({
             type: "POST",
             url: "/contact",
             data: UpformData,
             contentType: false,
            // contentType: false,
             processData: false,
             success: function (response) {
                $('.select3 .option').remove()
                getContact()
                getCustomer()
                 toastr.success("New Contact Added")
             },error:function(err){
                // alert('error')
                console.log(err.responseJSON)
                 $('#Cname').text(err.responseJSON.errors.name);
                 $('#Cmobile').text(err.responseJSON.errors.mobile);
                 $('#Caddress').text(err.responseJSON.errors.address);
             }
         });


     });
     function getContact(){
        $.ajax({
            type: "get",
            url: "/get-contact",
            contentType: false,
            success: function (response) {
                $.each(response,function(key,value){
                    var id = parseInt(value.id)
                    $('.selectS').append('<option class="option" value="'+id+'">'+value.name+'</option>')
                   // console.log(value.id)
                })
            }
         })
     }
     $(document).on('click','.suplier',function(){
        $('.conType').val(1)
     })
     $(document).on('click','.customer',function(){
        $('.conType').val(2)
    })
     getCustomer()
     function getCustomer(){
        $.ajax({
            type: "get",
            url: "/get-customer",
            contentType: false,
            success: function (response) {
                $.each(response,function(key,value){
                    var id = parseInt(value.id)
                    $('.selectC').append('<option class="option" value="'+id+'">'+value.name+'</option>')
                   // console.log(value.id)
                })
            }
         })
     }



    //  $(document).on('click','.get-contact' ,function (){
    //     alert('hi')
    //     getContact()
    //  })


    //print

    $(document).on('click', '#printMe', function (e) {
        e.preventDefault();
        window.print()

      });
// due start from here
    function dew_purchase (id){
        $('.dewRow tr').remove()
        $.ajax({
            type: "get",
            url: "/contact/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {
            //   console.log(response);
            $('.seller').text(response.name)
            //  $('.length').text(response.name)
            var a=0;
            $('.length').text(response.dew_purchase.length)
            $.each(response.dew_purchase,function(key,value){
                key = key+1
                console.log(value)
                $('.dewRow').append('<tr>\
                <th>'+key+' </th>\
                <th>'+value.purchase.invoice_no+'</th>\
                <th>'+value.amount+'</th>\
                <th><button value="'+value.amount+'" c_id="'+id+'" dew_id="'+value.id+'" pur_id="'+value.purchase.id+'" class="btn btn-success btn-sm due-btn">Pay</button></th>\
                </tr>')
            console.log( value.amount)
            a += value.amount
            })
            $('#amount').val(a)
            }
            });
    }
    function dew_sell (id){
        $('.dewRow tr').remove()
        $.ajax({
            type: "get",
            url: "/contact/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {
            //   console.log(response);
            $('.seller').text(response.name)
            //  $('.length').text(response.name)
            var a=0;
            $('.length').text(response.dew_sell.length)
            $.each(response.dew_sell,function(key,value){
                key = key+1
                console.log(value)
                $('.dewRow').append('<tr>\
                <th>'+key+' </th>\
                <th>'+value.sell.invoice_no+'</th>\
                <th>'+value.amount+'</th>\
                <th><button value="'+value.amount+'" c_id="'+id+'" dew_id="'+value.id+'" pur_id="'+value.sell.id+'" class="btn btn-success btn-sm due-btn">Pay</button></th>\
                </tr>')
            console.log( value.amount)
            a += value.amount
            })
            $('#amount').val(a)
            }
            });
    }
    function dew_back (id){
        $('.dewRow tr').remove()
        $.ajax({
            type: "get",
            url: "/contact/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {
              console.log(response.name);
            $('.seller').text(response.name)
            //  $('.length').text(response.name)
            var a=0;
            $('.length').text(response.dew_back.length)
            $.each(response.dew_back,function(key,value){
                key = key+1
                console.log(value)
                $('.dewRow').append('<tr>\
                <th>'+key+' </th>\
                <th>'+value.back.invoice_no+'</th>\
                <th>'+value.amount+'</th>\
                <th><button value="'+value.amount+'" c_id="'+id+'" dew_id="'+value.id+'" pur_id="'+value.back.id+'" class="btn btn-success btn-sm due-btn">Pay</button></th>\
                </tr>')
            console.log( value.amount)
            a += value.amount
            })
            $('#amount').val(a)
            }
            });
    }
    function dew_return (id){
        $('.dewRow tr').remove()
        $.ajax({
            type: "get",
            url: "/contact/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {
              console.log(response);
            $('.seller').text(response.name)
            //  $('.length').text(response.name)
            var a=0;
            $('.length').text(response.dew_return.length)
            $.each(response.dew_return,function(key,value){
                key = key+1
                console.log(value)
                $('.dewRow').append('<tr>\
                <th>'+key+' </th>\
                <th>'+value.return.invoice_no+'</th>\
                <th>'+value.amount+'</th>\
                <th><button value="'+value.amount+'" c_id="'+id+'" dew_id="'+value.id+'" pur_id="'+value.return.id+'" class="btn btn-success btn-sm due-btn">Pay</button></th>\
                </tr>')
            console.log( value.amount)
            a += value.amount
            })
            $('#amount').val(a)
            }
            });
    }
    $(document).on('click', '#dewShow', function () {
        $('.custom_model').show()
        var id = $(this).val();
        var type = $(this).attr('type');

        if(type == 'purchase'){
            dew_purchase(id)
            $('.payment_type').val(4)
        }else if(type == 'sell'){
            dew_sell(id)
            $('.payment_type').val(3)
        }else if(type == 'return'){
            dew_return(id)
            $('.payment_type').val(6)
        }else if(type == 'back'){
            dew_back(id)
            $('.payment_type').val(5)
        }
    })
    $(document).on('click','.due-btn',function(){
        $('.custom_model_three').fadeIn(300)
        $('.grandTotal').val($(this).val())
        $('#dew_id').val($(this).attr('dew_id'))
        $('#pur_id').val($(this).attr('pur_id'))
        $('#c_id').val($(this).attr('c_id'))
    })
    // $(document).on('keyup', '#newPay', function () {
    //     var pay = parseFloat($(this).val())
    //     var amount = parseFloat($('#amount').val())
    //     $('#newDew').val(amount-pay)
    // })

    $(document).on('submit','#dueUpdateForm', function (e) {
        e.preventDefault();
        $('.pay-btn').fadeOut(100)
        $('.wait-btn').text('........')
        var c_id = $('#c_id').val()
        var id = $('#dew_id').val()
        var type = parseInt($('.payment_type').val())
       // alert(type)
        // alert(id);
        let  UpformData = new FormData($("#dueUpdateForm")[0]);
        console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/dew/"+id,
            data: UpformData,
            contentType: false,
            // contentType: false,
            processData: false,
            success: function (response) {
                if(type == 4){
                    dew_purchase(c_id)
                    toastr.success("Purchase Due updated")
                }else if(type == 3){
                    dew_sell(c_id)
                    alert(c_id)
                    toastr.success("Sell Due updated")
                }else if(type == 6){
                    dew_return(c_id)
                    toastr.success("Purchase Return Due updated")
                }else if(type == 5){
                    dew_back(c_id)
                    toastr.success("Sell Back Due updated")
                }
                PaymentRefresh()
                $('.wait-btn').text('')
                $('.pay-btn').fadeIn(4000)
            },error:function(err){
                toastr.error("Fillup all needed fills")
                $('.wait-btn').text('')
                $('.pay-btn').fadeIn(4000)
                // alert('error')
            console.log(err)
                $('.Eseller').text(err.responseJSON.errors.seller_id);
                $('.Etotal').text(err.responseJSON.errors.price);
                $('.Edew').text(err.responseJSON.errors.qty);
            }
        });
    });
// due functionality end here!
//expenses start here !
    $(document).on('click', '#editExpenses', function () {
        var id = $(this).val();
    alert(id);
        $.ajax({
            type: "get",
            url: "expenses/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
            console.log(response)
            $('#expense').val(response.expense)
            $('#expenseId').val(response.id)
            $('#expense_category').val(response.expense_category)
            }
            });
    })
    $(document).on('click', '#expenseBtn', function (e) {
        e.preventDefault();
        var id = $('#expenseId').val()
        $(this).html('Sending..');
        $.ajax({
        data: $('#expenseFrom').serialize(),
        url: "expenses/"+id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            toastr.success("Role update successfully")
            location.reload(true);
            //  $('#ajaxModel').modal('hide');
            // table.draw();
            },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
    });
    });
//Expense End here
//role strat here

$(document).on('click', '#editRole', function () {
    var id = $(this).val();

  // alert(from);
    $.ajax({
        type: "get",
        url: "role/"+id+"/edit",
        data: "data",
        dataType: "json",
        success: function (response) {
            console.log(response)
          $('#name').val(response.name)
          $('#role').val(response.role)
          $('#roleId').val(response.id)
        }
        });
})
$(document).on('click', '#roleBtn', function (e) {
    e.preventDefault();
    var id = $('#roleId').val()
    $(this).html('Sending..');
    $.ajax({
      data: $('#roleFrom').serialize(),
      url: "role/"+id,
      type: "POST",
      dataType: 'json',
      success: function (data) {
        if(data=='0'){
            toastr.error('You are Admin! You cant change your own Role')
        }else{
            toastr.success("Role update successfully")
            location.reload(true);
        }
          },
      error: function (data) {
          console.log('Error:', data);
          $('#saveBtn').html('Save Changes');
      }
  });
});
//role end here
//// custom Modal

$(document).on('click','.custom_model_btn',function(){
   // alert('hi')
    $('.custom_model').fadeIn(300)
})
$(document).on('click','.custom_model_btn2',function(){
     //alert('hi')
     $('.custom_model_two').fadeIn(300)
 })
$(document).on('click','.custom_modal_close',function(){
    //alert('hi')
    $('.custom_model').fadeOut()
    $('.custom_model_two').fadeOut()
})


 //balance Add withdraw
    $(document).on('submit','#balanceAddForm', function (e) {
        e.preventDefault();
        var payment_type =$('.payment_type').val()
        $('.pay-btn').fadeOut(100)
        $('.wait-btn').text('........')
        let  UpformData = new FormData($("#balanceAddForm")[0]);
    //  console.log(UpformData);
        $.ajax({
            type: "POST",
            url: "/payment",
            data: UpformData,
            contentType: false,
            // contentType: false,
            processData: false,
            success: function (resp) {
                console.log(payment_type)
                toastr.success("Successfully Done")
                PaymentRefresh()
                $('.wait-btn').text('')
                $('.pay-btn').fadeIn(4000)
            },error:function(err){
                toastr.error("Fillup all needed fills")
                $('.wait-btn').text('')
                $('.pay-btn').fadeIn(4000)
            }
        });


    });



});
