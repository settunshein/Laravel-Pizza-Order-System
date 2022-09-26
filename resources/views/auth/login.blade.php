<!DOCTYPE HTML>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#563d7c">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LOGIN')</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope&display=swap');

        body{
            font-family: 'Manrope', sans-serif;
        }

        a,
        input,
        button{
            font-size: 13.5px !important;
        }

        small{
            font-size: 12px;
        }

        /* Custom Styling Sweet Alert 2 */
        .swal2-popup {
            font-size: 12.5px !important;
        }

        .swal2-styled.swal2-confirm {
            padding-left: 25px !important;
            padding-right: 25px !important;
        }

        .swal2-styled.swal2-cancel,
        .swal2-styled.swal2-confirm {
            box-shadow: none !important; 
            outline: none !important;
            border-radius: 0 !important;
        }
    </style>
<body>

    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-4 mx-auto ">

                <form action="{{ route('login') }}" method="POST">
                @csrf
                    <h3 class="mb-4 text-center">LOGIN</h3>
                        
                    <div class="form-group mb-4">
                        <input class="form-control rounded-0" type="email" name="email" 
                        placeholder="Enter Your Email Address" autocomplete="off" autofocus>
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
            
                    <div class="form-group mb-4">
                        <input class="form-control rounded-0" type="password" name="password" 
                        placeholder="Enter Your Password">
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
            
                    <div class="form-group text-center">
                        <button class="btn btn-outline-dark rounded-0 btn-block" type="submit">
                            LOGIN
                        </button>
                    </div>
                </form>

                <div class="text-center">
                    <a href="{{ route('auth#registerPage') }}">REGISTER HERE</a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- Sweet Alert v2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'SUCCESS',
                text : "{{ session('success') }}",
                icon : 'success',
            })
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'ERROR',
                text : "{{ session('error') }}",
                icon : 'error',
            })
        @endif
    </script>
</body>
</html>