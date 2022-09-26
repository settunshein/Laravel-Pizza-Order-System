$(document).on('click', '.del-admin-btn', function(e){
    e.preventDefault();
    let id = $(this).data('id');
    Swal.fire({
        title: 'Are You Sure?',
        text: "Do You Want to Delete this Admin?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        onfirmButtonText: 'OK',
        cancelButtonText: 'CANCEL',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'GET',
                url   : `/admin/delete/${id}`,

                success: function(){
                    $('#adminListTable tbody').load(location.href + ' #adminListTable tbody tr');
                    Swal.fire({
                        icon : 'success',
                        title: 'SUCCESS',
                        text : 'Admin Deleted Successfully',
                    });
                    
                }
            })
        }
    })
})/* End of Admin User Confirm Delete */

$(document).on('change', '.role-select', function () {
    let role    = $(this).val();
    let user_id = $(this).data('id');
    let data = {
        'user_id': user_id,
        'role'   : role,
    };
    console.log(data);
    $.ajax({
        type: 'GET',
        url: 'http://localhost:8000/admin/change-role',
        data: data,
        dataType: 'json',

        success: function(response){
            $('#adminListTable tbody').load(location.href + ' #adminListTable tbody tr');
            Swal.fire({
                icon : 'success',
                title: 'SUCCESS',
                text : 'Admin User\'s Role Changed to Customer Successfully',
            });
        }
    });
});