@extends('admin.layouts.master')

@section('category-active', 'sidebar-active')

@section('title', 'Category List')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Category Management</h6>
    <form action="{{ route('category#index') }}" method="GET">
        <div class="input-group">
            <p class="mb-0 mr-2" style="font-size: 12.5px; margin-top: 7px;">
                Search Key : <span class="text-danger">{{ request('search') }}</span>
            </p>
            <input type="text" class="search-input form-control rounded-0 border-dark" placeholder="Search by Category Name . . ." 
            style="width: 250px" name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-dark btn-sm rounded-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
          </div>
    </form>
</div>

<div class="row">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                            Category List Table
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i>{{ $categories->total() }} )
                                </a>
                            </span>
                        </p>
                        <a href="{{ route('category#create') }}" class="btn btn-sm btn-outline-dark rounded-0">
                            Create&nbsp;
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="categoryListTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr class="text-center">
                                <td>{{ ++$i }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <a href="{{ route('category#edit', $category->id) }}" 
                                    class="btn btn-sm btn-outline-dark rounded-0">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0 del-category-btn"
                                    data-id="{{ $category->id }}">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="4" class="font-weight-bold text-danger">
                                    No Category Found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.del-category-btn', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are You Sure?',
            text: "Do You Want to Delete this Category?",
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
                    url   : `/category/delete/${id}`,

                    success: function(){
                        $('#categoryListTable tbody').load(location.href + ' #categoryListTable tbody tr');
                        Swal.fire({
                            icon : 'success',
                            title: 'SUCCESS',
                            text : 'Category Deleted Successfully',
                        });
                    }
                })
            }
        })
    })/* End of Category Confirm Delete */
</script>
@endsection