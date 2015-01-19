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
                    <h2>Password Reset</h2>

                    <p class="text-small">Enter your email address that you used to register. We'll send you an email
                        with a link to reset your password.</p>
                </div>

                <div class="form-container">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

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

                    <form class="form-horizontal" role="form" method="POST" action="/password/email">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email" placeholder="Email"
                                   value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-block btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
