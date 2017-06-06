@extends('layouts.auth')

@section('content')
    <div class="page-signin">

        <div class="signin-header">
            <div class="container text-center">
                <section class="logo">
                    <a href="#">
                        <img src="/images/lrc-logo.png" alt="" width="200px" height="200px"/>
                    </a>
                </section>
            </div>
        </div>

        <div class="main-body">
            <div class="container">
                <div class="form-container">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="username" placeholder="Username" class="form-control" name="username"
                                       value="{{ old('username') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                    <input type="password" placeholder="Password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember"> Remember Me
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                            </div>
                        </fieldset>
                    </form>

                   <!--  <section>
                        <p class="text-center"><a href="/password/email">Forgot your password?</a></p>
                    </section> -->

                </div>
            </div>
        </div>
    </div>
@endsection
