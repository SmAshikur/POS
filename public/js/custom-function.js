//All functions use for purchase
$(document).ready(function(){
    $(document).on('click','.printMe',function(e){
        e.preventDefault();
        window.print()
    });
    $(document).on('click','.printMe2',function(e){
        e.preventDefault();
        $('.custom_model_two').show()
        setTimeout(function() {
            window.print()
        }, 2000)
        setTimeout(function() {
            $('.custom_model_two').hide()
        }, 3000)
    });
// function for quantity minimize
    $(document).on('click','.qtyMinPur',function(){
        var parent = $(this).closest('.purchaseRow');
        var qty = parseInt((+$(parent).find('.purQty').val()));
        if(qty<=2 || isNaN(qty)){
            $(parent).find('.purQty').val(1);
            toastr.info("Quantity can't be less than One")
        }else{
            $(parent).find('.purQty').val(qty-1);
        }
        calculate(parent);
    })
// function for quantity Add
    $(document).on('click','.qtyAddPur',function(){
        var parent = $(this).closest('.purchaseRow');
        var qty = parseInt((+$(parent).find('.purQty').val()));
        var q = parseInt(+$(this).attr('qty'));
        //alert(q)

        if(!isNaN(q) || q>0){
             if(q>qty){
                $(parent).find('.purQty').val(qty+1);
             }else{
                toastr.info('No more Product in Your Inventory')
             }
        }else{
            $(parent).find('.purQty').val(qty+1);
        }

            calculate(parent);
    })
    //keyup events for calculation
    $(document).on('keyup', '.purQty, .perPrice', function () {
        //var value = parseInt($(this).val())
            var parent = $(this).closest('.purchaseRow');
            calculate(parent);
    })
    $(document).on('change', '.purQty, .perPrice', function () {
        var value = parseInt($(this).val())
        if(value<=1 || isNaN(value)){
            $(this).val(1)
        }
        var parent = $(this).closest('.purchaseRow');
        calculate(parent);
    })

    //keyup events for profit

    $(document).on('keyup',' .profit', function () {
        var parent = $(this).closest('.purchaseRow');
        calculate(parent);
    })
    $(document).on('change',' .profit', function () {
        var value = parseInt($(this).val())
        if(value<=1 || isNaN(value)){
            $(this).val(0)
        }
        var parent = $(this).closest('.purchaseRow');
        calculate(parent);
    })

    //keyup events for discount

    $(document).on('keyup ',' .purDis', function () {
        var parent = $(this).closest('.purchaseRow');
        var value = parseInt($(this).val())
        if(value>100){
            $(this).val(100)
            toastr.info("Discount can't be over 100")
        }
        calculate(parent);
    })
    $(document).on(' change',' .purDis', function () {
        var value = parseInt($(this).val())
        if(value<=1 || isNaN(value)){
            $(this).val(0)
        }else if(value>100){
            $(this).val(100)
            toastr.info("Discount can't be over 100")
        }
        var parent = $(this).closest('.purchaseRow');
        calculate(parent);
    })


// function for add purchase calculation
    function calculate(e){
        PayDone()
        var qty = parseInt(+$(e).find('.purQty').val());
        var qtyChange = parseInt(+$(e).find('.new_qty').attr('new_qty'));
        var soldChange = parseInt(+$(e).find('.new_sold_qty').attr('new_qty'));
        var soldOldQty = parseInt(+$(e).find('.new_sold_qty').attr('old_qty'));
        var oldQty = parseInt(+$(e).find('.new_qty').attr('old_qty'));
        // alert(qtyChange)
        // alert(oldQty)
        // alert(soldChange)
        //alert(soldOldQty)
       if ( !isNaN(soldChange)){
        if(soldOldQty > 0 && !isNaN(soldOldQty)){
            if(soldChange > qty && !isNaN(soldChange )){
                var newSoldQty = soldOldQty + (soldChange-qty)
                var newQty = oldQty - (qtyChange-qty)
             }else if(soldChange == qty && !isNaN(soldChange )) {
                 var newSoldQty =  soldOldQty
                 var newQty = oldQty
             }else if(soldChange < qty && !isNaN(soldChange )) {
                 var newSoldQty =soldOldQty - (qty-soldChange)
                 var newQty =oldQty + (qty-qtyChange)
             }
           }else{
            var newSoldQty = soldChange-qty
            var newQty = qtyChange+qty
           }
       }else{
        if(oldQty > 0 && !isNaN(oldQty)){
            if(qtyChange > qty && !isNaN(qtyChange )){
                var newQty = oldQty + (qtyChange-qty)
            }else if(qtyChange == qty && !isNaN(qtyChange )) {
                var newQty = oldQty
            }else if(qtyChange < qty && !isNaN(qtyChange )) {
                var newQty =oldQty - (qty-qtyChange)
            }
            }else{
                    var newQty = qtyChange-qty
            }
       }
        $(e).find('.new_qty').val(newQty);
        $(e).find('.new_sold_qty').val(newSoldQty);
        var price = parseInt(+$(e).find('.perPrice').val());
        var dis = parseInt(+$(e).find('.purDis').val());
        // console.log(price)
        // console.log(qty)
        // console.log(dis)
        var disCount = parseInt((price/100)*dis)

        var disCountedPrice =  price-disCount
        //alert(disCountedPrice)
       // var totalDisCountedPrice =  qty*disCountedPrice
        var sum = 0;
        var sumBefore =0;
        var sumDis =0;
        $(e).find('.total').val(qty*disCountedPrice);
        $(e).find('.total_before').val(qty*price);
        $(e).find('.total_dis').val(qty*disCount);
        // if(isNaN(totalDisCountedPrice)){
        //     $(e).find('.total').val(totalDisCountedPrice);
        // }{
        //     $(e).find('.total').val(qty*price);
        // }
        $('.total').each(function(i,e){
            sum += +$(e).val();
        });
        $('.total_before').each(function(i,e){
            sumBefore += +$(e).val();
        });
        $('.total_dis').each(function(i,e){
            sumDis += +$(e).val();
        });
        var upaid = parseInt($('.grandPay').val())
       // alert(upaid)
        if(upaid>0 && !isNaN(upaid)){
            var cashBack= parseInt(sum-upaid)
            if(cashBack <0){
                $('.cashBackDiv').show();
                toastr.success('you have to cash back !')
                $('.paymore,.payment').hide();
                $('.grandTotal').val(0);
                $('.cashBack').val(Math.abs(cashBack));
                var pos = parseInt(cashBack)
                PayDone()
               // alert(pos)
            }else{
                //$('.cashBack')
                $('.cashBackDiv , .payment').hide();
                $('.paymore').show();
                $('.grandTotal').val(cashBack);
                PayDone()
            }
        }else{
            $('.grandTotal').val(sum);
            $('.dewTotal').val(sum)

        }
        $('.grandBefore').val(sumBefore);
        //alert(sumBefore)
        $('.grandDis').val(sumDis);
        var profit = parseInt(+$(e).find('.profit').val());
        var perProfit = parseInt((price/100)*profit)
        $(e).find('.final').val(price+perProfit);

    //alert(sum)
    } ;
    $('.cashBackDiv').hide()
    // $(document).on('change','.payment_method',function(){
    //     $("select:unselect").map(function(i, el) {
    //         alert('hi')
    //     })
    // })
    $(document).on('click','.paymore',function(){
        $('.payment').show()
        $('.payment').removeClass('payment_method_second')
        $('.payment').addClass('payment_method')
    })
    $(document).on('click','.coming_soon',function(){
        alert('coming soon')
    })
    $(document).on('click','.custom_model_btn',function(){
        // alert('hi')

     })
    $(document).on('click','.payment-add-btn',function(){
        // $('.payment_head').text('Add Balance')
        // $('.payment_foot').text('Add ')
        $('.pay_add').text('Add Balance ')
        $('.payment_type').val(1)
        $('.payment_model').fadeIn(300)
      //  $('.addBtnpay').hide()
    })

    $(document).on('click','.payment-del-btn',function(){
        //  $('.addBtnpay').show()
        //  $('.payment_head').text('Withdraw Balance')
        //  $('.payment_foot').text('Withdraw ')
        $('.pay_add').text('Withdraw Balance ')
         $('.payment_type').val(2)
         $('.payment_model').fadeIn(300)
     })
     $(document).on('click','.payment-pur-btn',function(){
         $('.addBtnpay').show()
         $('.payment_head').text('Withdraw Balance')
         $('.payment_foot').text('Payment ')
         $('.payment_type').val(4)
         $('.custom_model_three').fadeIn(300)
         PayDone()
     })
     $(document).on('click','.custom_modal_three_close, .purchasePay',function(){
        $('.custom_model_three').fadeOut(300)
     })
     $(document).on('click','.payment-cash-btn',function(){
        // $('.payment').show()
        //  $('.payment_main').removeClass('payment_method_two')
        //  $('.payment_main').addClass('payment_method')
        $('.addBtnpay').show()
         $('.payment_head').text('Withdraw Balance')
         $('.payment_foot').text('Cash Back')
         $('.payment_type').val(5)
         $('.custom_model_three').fadeIn(300)
     })
     $(document).on('click','.payment-rtn-btn',function(){
        // $('.payment').show()
        //  $('.payment_main').removeClass('payment_method_two')
        //  $('.payment_main').addClass('payment_method')
        $('.addBtnpay').show()
         $('.payment_head').text('Withdraw Balance')
         $('.payment_foot').text('Cash Back')
         $('.payment_type').val(5)
         $('.custom_model_three').fadeIn(300)
     })
     $(document).on('click','.payment-sell-rtn-btn',function(){
        // $('.payment').show()
        //  $('.payment_main').removeClass('payment_method_two')
        //  $('.payment_main').addClass('payment_method')
        $('.addBtnpay').show()
         $('.payment_head').text('Withdraw Balance')
         $('.payment_foot').text('Cash Back')
         $('.payment_type').val(6)
         $('.custom_model_three').fadeIn(300)
     })
     $(document).on('click','.payment-sell-btn',function(){
        // $('.payment').show()
        //  $('.payment_main').removeClass('payment_method_two')
        //  $('.payment_main').addClass('payment_method')
        $('.addBtnpay').show()
         $('.payment_head').text('Withdraw Balance')
         $('.payment_foot').text('Cash Back')
         $('.payment_type').val(3)
         $('.custom_model_three').fadeIn(300)
     })
     $(document).on('click','.payment-ex-btn',function(){
        // $('.payment').show()
        //  $('.payment_main').removeClass('payment_method_two')
        //  $('.payment_main').addClass('payment_method')
        $('.addBtnpay').show()
        $('.payTitle').text('Payment Type : Expense')
         $('.payment_foot').text('Cash Back')
         $('.payment_type').val(7)
         $('.custom_model_three').fadeIn(300)
     })
    // $('.payment_method,.payment_method_two').on("select2:unselecting", function(e){
    //     var val = $('.payment_method').val();
    //     if(val == 1){
    //         $('.cash_fill').hide()
    //         $('.cash_amount').val(0)
    //         PayDone()
    //     }else if(val == 2){
    //         $('.mobile_fill').hide()
    //         $('.mobile_amount').val(0)
    //         PayDone()
    //     }else if(val ==3){
    //         $('.bank_fill').hide()
    //         $('.bank_amount').val(0)
    //         PayDone()
    //     }
    //     //alert(val);
    // }).trigger('change');
    // $(document).on('change','.payment_method_two',function(){
    //     PayDone()
    //     $(".payment_method_two :selected").map(function(i, el) {
    //         var p_method=($(el).val());
    //         if(p_method === '1'){
    //             $('.cash_fill').fadeIn(500)
    //          }else if(p_method === '2'){
    //             $('.mobile_fill').fadeIn(500)
    //          }else if(p_method === '3'){
    //             $('.bank_fill').fadeIn(500)
    //          }
    //     })
    //     //alert('val')
    // })
    $(document).on('change','.payment_method',function(){
        PayDone()


    })
    $(document).on('click','del_payment',function(){
       // $('.payment_method').find('.cack').hide();
    })
    $(document).on('change','.del_payment', function () {
        if (this.checked){
            var parent= $(this).closest('.del_payment_close')
            $(parent).find('input').removeAttr('readonly')
        }else{
            var parent= $(this).closest('.del_payment_close')
            $(parent).find('.payment_close').val(0)
            $(parent).find('.payment_inf').val(' ')
            $(parent).find('input').attr('readonly',true)
            PayDone()
        }
    })
    $(document).on('keyup','.cash_amount, .mobile_amount, .bank_amount',function(){
    //  alert($(this).val())
    //   var cash = parseInt($('.cash_amount').val())
    //   alert(cash)
        PayDone()
    })
    $(document).on('change', '.cash_amount, .mobile_amount, .bank_amount', function () {
        $('.payment_pay').fadeIn(500)
        var value = parseInt($(this).val())
        if(value<-1 || isNaN(value)){
            $(this).val(0)
            PayDone()
        }
        PayDone()
    })
    // function for ajax check balance
    checkBalance()
    function checkBalance (){
        $.ajax({
            type: "get",
            url: "/get-cash",
            contentType: false,
            success: function (response) {
               if(!isNaN(response)){
                    $('.ajaxCash').val(response)
               }
            }
        })
        $.ajax({
            type: "get",
            url: "/get-mobile-cash",
            contentType: false,
            success: function (response) {
               if(!isNaN(response)){
                    $('.ajaxMcash').val(response)
               }
            }
        })
        $.ajax({
            type: "get",
            url: "/get-bank-cash",
            contentType: false,
            success: function (response) {
               if(!isNaN(response)){
                    $('.ajaxBcash').val(response)
               }
            }
        })
    }
    // function check balance end
    $(document).on('keyup change','.payment_close,.payment_type', function () {
       // alert('ji')
       checkBalance()
       PayDone()
        var parent= $(this).closest('.cashTh')
        var ajaxAmount=parseInt($(parent).find('.ajaxAmount').val())
        console.log(ajaxAmount)
        var payment_type = $('.payment_type').val()
        //alert(payment_type)
        var afterCash=parseInt($(parent).find('.beforeCash').val())
        var cashback = parseInt($('.cashBack').val())
        value= $(this).val()
        if(payment_type == 2 || payment_type == 4 || payment_type == 6 ){
            if(value>ajaxAmount && !isNaN(ajaxAmount)){
                $(parent).find('.payment_close').val(ajaxAmount)
                toastr.warning('You dont have that much amount! you have '+ajaxAmount+'')
               // toastr.success(ajaxAmount)
                PayDone()
            }
        }
        if(payment_type == 3 || payment_type== 4 || payment_type ==5 || payment_type == 6){
            if(value>afterCash ){
                if(ajaxAmount>afterCash){
                    $(parent).find('.payment_close').val(afterCash)
                    //toastr.info('No need to pay more')
                    PayDone()
                }else{
                    $(parent).find('.payment_close').val(ajaxAmount)
                    toastr.info('No need to Pay ')
                    PayDone()
                }
            }
       }

        // }else if(payment_type == 5){
        //     if(cashback >0 ){
        //         $('.cashBack').val(0)
        //         $(parent).find('.payment_close').val(ajaxCash)
        //         toastr.success('vai')
        //     }
        // }

    })
    $(document).on('change','.payment_type',function(){
        PayDone()
    })
    refresh()
    function refresh(){
        $('.grandTotal').val()
        $('.payTotal').val()
        $('.dewTotal').val()
    }
    function PayDone(){
        var total_price = parseInt($('.grandTotal').val())
        var payment_type = $('.payment_type').val()
        if(payment_type == 2 || payment_type ==1){
            var cash = parseInt($('#cash_amount').val())
            //alert(cash)
            var mobileCash = parseInt($('#mobile_amount').val())
            var bankCash = parseInt($('#bank_amount').val())
        }else{
            var cash = parseInt($('#cash_amount_two').val())
          //  alert(cash)
            var mobileCash = parseInt($('#mobile_amount_two').val())
            var bankCash = parseInt($('#bank_amount_two').val())
        }

        var total_pay = parseInt(cash+bankCash+mobileCash)

        if(!isNaN(total_pay) && total_pay>=0){
            $('.cashTotal').val(total_pay)
            //$('.cashTotal').val(total_pay)
            //alert(total_pay)
            console.log(cash)
            console.log(total_pay);
        }
       // alert(total_price)
        var total_due =total_price-total_pay
        $('.afterCash').val(parseInt(total_price-(mobileCash+bankCash)))
        $('.afterMcash').val(parseInt(total_price-(cash+bankCash)))
        $('.afterBcash').val(parseInt(total_price-(cash+mobileCash)))
        if(!isNaN(total_pay) && total_pay>=0 && total_pay<=total_price){
          //  alert(to)
            $('.payTotal').val(total_pay)
            if(!isNaN(total_due) && total_due>=0 && total_due<=total_price){
                $('.dewTotal').val(total_price-total_pay)
            }
        }else{
           // $('.payTotal').val()
            $('.payTotal').val(total_pay)
            $('.cashBack').val(total_price+total_pay)
        }

        // if(total_due == 0){
        //     $('#purchaseAddbtn').fadeIn(2000)
        // }
    }
    //$('select').picker();
});
