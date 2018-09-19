@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Register</h5>

                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>UserName</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{old('name')}}"
                                       class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="Tu nombre de Usuario"
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text"
                                       name="first_name"
                                       id="first_name"
                                       value="{{old('first_name')}}"
                                       class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                       placeholder="Escribe tu nombre"
                                       autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="first_name">Last Name</label>
                                <input type="text"
                                       name="last_name"
                                       id="last_name"
                                       value="{{old('last_name')}}"
                                       class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                       placeholder="Escribe tu apellido"
                                       autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="last_name">Email</label>
                                <input type="text"
                                       name="email"
                                       id="email"
                                       value="{{old('email')}}"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="Tu Email"
                                       autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       value="{{old('password')}}"
                                       class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Repite tu Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       class="form-control"
                                       placeholder="Repite tu Password">
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customCheck1">Remember password</label>
                            </div>
                            <button dusk="register-btn"
                                    class="btn btn-lg btn-primary btn-block text-uppercase"
                                    type="submit">Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection