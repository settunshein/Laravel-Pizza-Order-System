$(document).on('click', '.order-status-btn', function(e){
    let order_status = $(this).data('status');
    $.ajax({
        type: 'GET',
        url : 'http://localhost:8000/order/status',
        data: { status: order_status },
        dataType: 'json',

        success: function(response){
            $('.order-count').html(Object.keys(response).length);
            let list = getOrderList(response, order_status);
            $('#orderList').html(list);
        }
    });
});


// Change Status with AJAX
$(document).on('change', '.status-select', function(){
    let currentStatus = $(this).val();
    setSelectBoxColor(currentStatus, $(this));
    let order_status  = $('.order-status').val();
    let parentNode    = $(this).parents('tr');
    let order_id      = parentNode.find('.order-id').val();
    let data = {
        'status'      : currentStatus,
        'order_id'    : order_id,
        'order_status': order_status,
    };

    console.log(order_status);

    $.ajax({
        type: 'GET',
        url : 'http://localhost:8000/order/change-status',
        data: data,
        dataType: 'json',

        success: function (response) {
            if ($('.order-ttl').text() !== 'Order List Table') {
                $('.order-count').html(($('.order-count').text() * 1) - 1);
                parentNode.remove();
            }
            let list = getOrderList(response, order_status);
            $('#orderList').html(list);
        }
    });
})


// Get Select Element
function getSelectEl(status)
{
    let selectElColor = status == 0 ? 'text-warning' : status == 1 ? 'text-success' : 'text-danger';
    return `
        <select name="status" class="status-select form-control form-control-sm rounded-0 ${selectElColor}">
            <option class="text-warning" value="0" ${status == 0 ? 'selected' : ''}>
                Pending
            </option>
            <option class="text-success" value="1" ${status == 1 ? 'selected' : ''}>
                Completed
            </option>
            <option class="text-danger"  value="2" ${status == 2 ? 'selected' : ''}>
                Canceled
            </option>
        </select>
    `;
}


// Get Order List
function getOrderList(response, order_status)
{
    if (order_status == 0) {
        $('.order-ttl').text('Pending Order List Table');
    } else if (order_status == 1) {
        $('.order-ttl').text('Completed Order List Table');
    } else if (order_status == 2) {
        $('.order-ttl').text('Canceled Order List Table');
    } else {
        $('.order-ttl').text('Order List Table');
    }

    let list = '';
    for(let i=0; i<response.length; i++){
        let serial_number = i + 1;
        list += `
            <tr class="text-center" id="orderList">
                <input type="hidden" class="order-id" value="${response[i].id}">
                <input type="hidden" class="order-status" value="${order_status}">
                <td>${serial_number}</td>
                <td>${response[i].user_name}</td>
                <td>${response[i].created_at}</td>
                <td>
                    <a href="/order/details/${response[i].order_code}" class="text-danger">
                        ${response[i].order_code}
                    </a>
                </td>
                <td>${response[i].total_price.toLocaleString()} MMK</td>
                <td>${getSelectEl(response[i].status)}</td>
            </tr>
        `;
    }
    return list;
}


// Set Select Box Color by Status
function setSelectBoxColor(status, thisEl)
{
    thisEl.removeClass('text-warning text-success text-danger');

    if(status == 0){
        thisEl.addClass('text-warning');
    }

    if(status == 1){
        thisEl.addClass('text-success');
    }

    if(status == 2) {
        thisEl.addClass('text-danger');
    }
}
