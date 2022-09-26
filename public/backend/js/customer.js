$(document).on('change', '.role-select', function () {
    let role    = $(this).val();
    let user_id = $(this).data('id');
    let data = {
        'user_id': user_id,
        'role'   : role,
    };

    $.ajax({
        type: 'GET',
        url: 'http://localhost:8000/customer/change-role',
        data: data,
        dataType: 'json',

        success: function(response){
            $('#customerListTable tbody').load(location.href + ' #customerListTable tbody tr');
            Swal.fire({
                icon : 'success',
                title: 'SUCCESS',
                text : 'Customer\'s Role Changed to Admin Successfully',
            });
        }
    });
});
