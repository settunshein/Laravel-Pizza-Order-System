<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#563d7c">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Dropify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
    
    <link rel="stylesheet" href="{{ asset('backend/css/dashboard.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope&display=swap');

        * {
            font-family: 'Manrope', sans-serif;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .fa-trash-alt {
            padding-right: 1.5px;
            padding-left: 1.5px;
        }

        .btn,
        .card,
        table,
        input,
        select,
        textarea {
            font-size: 12.5px !important;
        }

        table tr td {
            vertical-align: middle !important;
        }

        .card-header {
            padding: 0.55rem 1.25rem !important;
        }

        .card-ttl {
            font-size: 13px !important;
        }

        /* Custom Styling Sidebar */
        .sidebar-heading span {
            font-size: 12px;
        }

        .nav-link svg {
            display: inline-block;
            width: 20px;
            text-align: left;
        }

        .nav-link {
            font-size: 13px;
        }

        /* Custom Styling Sweet Alert 2 */
        .swal2-popup {
            font-size: 12.5px !important;
        }

        .swal2-styled.swal2-confirm {
            padding-right: 25px !important;
            padding-left: 25px !important;
        }

        .swal2-styled.swal2-cancel,
        .swal2-styled.swal2-confirm {
            box-shadow: none !important;
            outline: none !important;
            border-radius: 0 !important;
        }

        /* Styling Search */
        .btn:focus,
        .search-input:focus {
            box-shadow: none !important;
        }

        /* Custom Syling Pagination */
        .pagination {
            margin-bottom: 0;
        }

        .info-blk li {
            margin-bottom: 20px;
        }

        .info-blk li i {
            display: inline-block;
            width: 14px;
            margin-right: 5px;
        }

        .info-blk strong {
            display: inline-block;
            width: 100px;
        }

        .dropify-wrapper .dropify-message .file-icon p {
            font-size: 13.5px !important;
        }

        .bg-custom-dark {
            background-color: #3D464D;
        }

        .bg-custom-warning {
            background-color: #FFD333;
        }

        .text-custom-dark {
            color: #3D464D;
        }

        .text-custom-warning {
            color: #FFD333;
        }

        .brand-logo span.h4 {
            font-weight: 600;
        }

        .custom-fs-11 {
            font-size: 11px;
        }

        .custom-fs-12 {
            font-size: 12.5px;
        }

        .custom-fs-13 {
            font-size: 13px;
        }

        .custom-fw-600 {
            font-weight: 600;
        }

        .sidebar-active,
        .sidebar .nav-link.sidebar-active .feather {
            color: #da542e !important;
        }

        .widget {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        }

        /* Styling Dropify */
        .dropify-wrapper {
            border-radius: 4.5px !important;
        }

        .dropify-wrapper .dropify-message p {
            font-size: initial !important;
        }

        /* Custom Styling Sweet Alert 2 */
        .swal2-popup {
            font-size: 12.5px !important;
        }

        .swal2-styled.swal2-confirm {
            padding-right: 25px !important;
            padding-left: 25px !important;
        }
    </style>
    @yield('css')
</head>