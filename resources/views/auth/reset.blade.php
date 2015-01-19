@extends('layouts.auth')

@section('content')
    <div class="page-forgot">

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

                <div class="info text-center">
                    <h2>Reset Password</h2>
                </div>

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

                    <form class="form-horizontal" role="form" method="POST" action="/password/reset">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation"
                                   placeholder="Password Confirmation">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-block btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
