<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Products</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    {{--<link rel="stylesheet" href="{{mix('css/login.css')}}">--}}
</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Mi Shopping Cart</h5>
    @auth
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Features</a>
        <a class="p-2 text-dark" href="#">Enterprise</a>
        <a class="p-2 text-dark" href="#">Support</a>
        <a class="p-2 text-dark" href="#">Pricing</a>
    </nav>
    @else
    <a class="btn btn-outline-primary mr-2" href="{{route('register')}}">Register</a>
    <a class="btn btn-outline-primary" href="{{route('login')}}">Sign up</a>
    @endauth
</div>

<div class="container">
    @yield('content')
</div>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>