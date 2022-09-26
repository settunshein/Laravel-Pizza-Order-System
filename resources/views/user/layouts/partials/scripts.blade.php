    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>--}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js" integrity="sha512-3J4luatr5PhoGf9jQjLoPpGa+t78QHzwIS2aGBdOZqjRmfbZ03YsPWvd/KZRm/Frd/eh97azy0nPkyvmdTOeXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/mail/contact.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    
    <!-- Dropify -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" 
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        $(document).ready( function () {
            feather.replace()

            $('.dropify').dropify({
                messages: {
                    'default': 'Choose Your Upload Image',
                    'replace': 'Click or Drag and Drop to Replace',
                    'remove' : 'Remove',
                    'error'  : 'Error. The file is either not square, larger than 2 MB or not an acceptable file type'
                }
            });

            @if(session('success'))
                let message = "{{ session('success') }}";
                toastr.success(message + ' <i class="far fa-check-circle"></i>', 'SUCCESS', {
                    closeButton: true,
                    progressBar: true,
                });
            @endif

            @if(session('error'))
                toastr.success("{{ session('error') }}", "ERROR", {
                    closeButton: true,
                    progressBar: true,
                });
            @endif
        });
    </script>

    @yield('js')