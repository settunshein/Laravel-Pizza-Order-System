$(document).ready(function(){

    $('#sortingOption').change(function(){
        let eventOption = $('#sortingOption').val();
        // console.log(eventOption);

        if(eventOption == 'asc'){
            $.ajax({
                type    : 'GET',
                url     : 'http://localhost:8000/ajax/product-list',
                data    : { 'status': 'asc'},
                dataType: 'json',
                success: function(response){
                    let list = getProductList(response);
                    $('#productList').html(list);
                }
            });
        }else{
            $.ajax({
                type    : 'GET',
                url     : 'http://localhost:8000/ajax/product-list',
                data    : { 'status': 'desc'},
                dataType: 'json',
                success: function(response){
                    let list = getProductList(response);
                    $('#productList').html(list);
                }
            });
        }
    })

    //$('.add-to-cart').click(function () {
    $(document).on('click', '.add-to-cart', function(){
        let data = {
            'user_id'    : $('#userId').val(),
            'product_id' : $(this).data('id'),
            'count'      : 1,
        }
        console.log(data);

        $.ajax({
            type: 'GET',
            url: 'http://localhost:8000/ajax/add-to-cart',
            data: data,
            success: function (response) {
                if (response.status == 'success') {
                    console.log(response.cart_count);
                    //location.href = 'http://localhost:8000/home';
                    $('.cart-count').text(response.cart_count);
                    toastr.success('Pizza Added to Your Cart Successfully &nbsp;<i class="far fa-check-circle"></i>', 'SUCCESS', {
                        closeButton: true,
                        progressBar: true,
                    });
                }
            }
        })
    });

    function getProductList(response)
    {
        let list = '';
        for(let i=0; i<response.length; i++){
            list += `
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/storage/${response[i].image}" alt="${response[i].name}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fas fa-info-circle"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${response[i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[i].price.toLocaleString()} MMK</h5>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
        return list;
    }
});