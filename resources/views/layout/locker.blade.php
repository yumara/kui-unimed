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

     <!-- App css -->
     <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-xxl">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
            @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
