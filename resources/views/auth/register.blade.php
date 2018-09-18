@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    <form>

                        <div class="form-group">
                            <label>UserName</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   placeholder="Tu nombre de Usuario"
                                   autofocus>
                        </div>
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text"
                                   id="first_name"
                                   name="first_name"
                                   class="form-control"
                                   placeholder="Escribe tu nombre"
                                   autofocus>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Last Name</label>
                            <input type="text"
                                   id="name"
                                   name="last_name"
                                   class="form-control"
                                   placeholder="Escribe tu apellido"
                                   autofocus>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Email</label>
                            <input type="text"
                                   id="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Tu Email"
                                   autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                    id="password"
                                   name="password"
                                    class="form-control"
                                    placeholder="Password"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="password">Repite tu Password</label>
                            <input type="password"
                                    id="password_confirmation"
                                   name="password_confirmation"
                                    class="form-control"
                                    placeholder="Repite tu Password"
                                   required>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection