@extends('layouts.master')

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ng-scope">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><i class="fa fa-pencil panel-ico"></i>Update a first
                            aider</strong>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($user,[
                        'route' => ['user-update', $user->id],
                        'name'=>'user_register_form'
                        ]) !!}
                        @include('forms.user',['password'=>'false'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
