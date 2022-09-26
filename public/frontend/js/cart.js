$(document).ready(function(){
    $('.btn-plus').click(function () {
        let rowCount = $('#cartListTable tbody tr').length;
        calculateCount($(this));
        calculateTotal(rowCount);
    });


    $('.btn-minus').click(function () {
        let rowCount = $('#cartListTable tbody tr').length;
        calculateCount($(this));
        calculateTotal(rowCount);
    });


    function calculateCount(thisEl)
    {
        let parentNode = thisEl.parents('tr');
        let price      = parentNode.find('#price').data('price');
        let qty        = parentNode.find('#qty').val();
        let total      = price * qty;
        parentNode.find('#total').html(`${total.toLocaleString()} MMK`);
        parentNode.find('#total_amt').val(total);
    }


    function calculateTotal(rowCount = null)
    {
        if (rowCount > 0) {
            let subTotal = 0;
            $('#cartListTable tbody tr').each(function (index, row) {
                subTotal += Number( $(row).find('#total_amt').val() );
                $('#subTotalPrice').html(`${subTotal.toLocaleString()} MMK`);
                $('#grandTotalPrice').html(`${(subTotal+3000).toLocaleString()} MMK`)
            });
        } else {
            $('#subTotalPrice').html('0 MMK');
            $('#grandTotalPrice').html('3,000 MMK');
        }
    }


    // Submit Order
    $('#orderBtn').click(function(){
        let orderList = [];

        let random = Math.floor(Math.random() * 10000000001)
        $('#cartListTable tbody tr').each(function(index, row){
            orderList.push({
                'user_id'   : $(row).find('.user-id').val(),
                'product_id': $(row).find('.product-id').val(),
                'qty'       : $(row).find('#qty').val(), 
                'total'     : $(row).find('#total_amt').val(),
                'order_code': 'POS'+random,
            });
        });

        $.ajax({
            type: 'GET',
            url : 'http://localhost:8000/ajax/order',
            data: Object.assign({}, orderList),
            dataType: 'json',
            success: function(response){
                if( response.status ){
                    location.href = 'http://localhost:8000/home';
                }
            }
        })
    });


    // Clear Cart
    $('#clearCartBtn').click(function(){
        $('#cartListTable tbody tr').remove();
        $('#subTotalPrice').html('0 MMK');
        $('#grandTotalPrice').html('0 MMK');

        $.ajax({
            type: 'GET',
            url : 'http://localhost:8000/ajax/clear-cart',
            dataType: 'json',

            success: function (response) {
                toastr.success('Your Cart Cleared Successfully &nbsp;<i class="far fa-check-circle"></i>', 'SUCCESS', {
                    closeButton: true,
                    progressBar: true,
                });
            }
        });
    });


    // Remove Cart Item
    $('.btn-remove').click(function(){
        let parentNode = $(this).parents('tr');
        let product_id = parentNode.find('.product-id').val();
        let cart_id    = parentNode.find('.cart-id').val();
        parentNode.remove();
        
        let rowCount = $('#cartListTable tbody tr').length;
        calculateTotal( rowCount );

        $.ajax({
            type: 'GET',
            url : 'http://localhost:8000/ajax/remove-cart',
            data: { product_id: product_id, cart_id: cart_id },
            dataType: 'json',

            success: function (response) {
                toastr.success('Pizza Removed Successfully &nbsp;<i class="far fa-check-circle"></i>', 'SUCCESS', {
                    closeButton: true,
                    progressBar: true,
                });
            }
        });
    });
});