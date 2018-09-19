@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form-label-group">
                                <label for="inputEmail">Email address</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="Email address"
                                       autofocus>
                            </div>
                            <div class="form-label-group">
                                <label for="inputPassword">Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Password"
                                       required>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       name="remember_me">
                                <label class="custom-control-label"
                                       for="customCheck1">Remember password</label>
                            </div>
                            <button dusk="login-btn"
                                    class="btn btn-lg btn-primary btn-block text-uppercase"
                                    type="submit">Sign in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




