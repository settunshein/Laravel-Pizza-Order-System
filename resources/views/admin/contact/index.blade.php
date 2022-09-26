@extends('admin.layouts.master')

@section('contact-active', 'sidebar-active')

@section('title', 'Contact Message List')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Contact Message Management</h6>
</div>

<div class="row mb-5">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                            Contact Message List
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i>{{ $contacts->total() }} )
                                </a>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="card-body" id="contactMessageList">
                    <ul class="list-unstyled">
                        @foreach($contacts as $contact)
                        <li class="media p-3 border mb-3 d-flex align-items-center shadow-sm rounded">
                            <img src="https://ui-avatars.com/api/?background=006699&color=fff&name={{ $contact->name }}" class="mr-3 rounded-circle img-fluid" 
                            alt="{{ $contact->name }}" width="75px">
                            <div class="media-body">
                                <h6 class="my-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="left-col">
                                            <p class="mb-1">
                                                {{ $contact->subject }}
                                            </p>
                                            <p class="text-muted mb-0 custom-fs-13">
                                                {{ $contact->email }}
                                                <span class="text-danger custom-fs-11 custom-fw-600">
                                                    ( {{ $contact->name }} )
                                                </span> 
                                            </p>
                                        </div>

                                        <div class="right-col">
                                            <small class="mr-2">
                                                <b>
                                                    {{ $contact->created_at->toFormattedDateString() }}, 
                                                    {{ $contact->created_at->format('H:i A') }}
                                                </b>
                                            </small>
                                            <form action="{{ route('contact#delete', $contact->id) }}" class="d-inline-block" method="POST"
                                            id="contactDeleteForm{{$contact->id}}">
                                            @csrf
                                                <a href="javascript:;" class="text-danger del-contact-btn" data-id="{{ $contact->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                </h6>
                                <p>All my girls vintage Chanel baby. So you can have your cake. Tonight, tonight, tonight, I'm walking on air. Slowly swallowing down my fear, yeah yeah. Growing fast into a bolt of lightning. So hot and heavy, 'Til dawn. That fairy tale ending with a knight in shining armor. Heavy is the head that wears the crown.</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.del-contact-btn', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are You Sure?',
            text: "Do You Want to Delete this Message?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            onfirmButtonText: 'OK',
            cancelButtonText: 'CANCEL',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $('#contactDeleteForm'+id).submit();
            }
        })
    })/* End of Contact Confirm Delete */
</script>
@endsection