@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Create User</h5>
</div>
@endsection

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
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
                        {!! Form::open(['url'=>'/register','name'=>'user_register_form']); !!}
                        @include('forms.user')
                        {!! Form::close(); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
