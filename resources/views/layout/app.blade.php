<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link rel="stylesheet" href="{{ asset('libs/jsvectormap/css/jsvectormap.min.css')}}">
    <link href="{{asset('libs/simple-datatables/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/vanillajs-datepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css" />
     <!-- App css -->
     <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
    @include('partials.header')
    <div class="page-wrapper">
        <div class="page-content">
            @yield('content')
            @include('partials.footer')
        </div>
    </div>
    @include('partials.js')
</body>
</html>
