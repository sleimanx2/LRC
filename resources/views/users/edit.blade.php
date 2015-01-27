@extends('layouts.master')

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-8  ng-scope">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><i class="fa fa-pencil panel-ico"></i>Update a first
                            aider</strong>
                    </div>
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

                        {!! Form::model($user,[
                        'route' => ['user-update', $user->id],
                        'name'=>'user_register_form'
                        ]) !!}
                        @include('forms.user',['password'=>'false'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4  ng-scope">

                <div class="panel panel-default">
                    <div class="panel-heading"><strong><i class="fa fa-pencil panel-ico"></i>Change Password</strong>
                    </div>
                    <div class="panel-body">
                        {!! Form::open([
                        'route' => ['password-change', $user->id],
                        'name'=>'user_change_password_form'
                        ]) !!}
                        <div class="form-group">
                            <label for="">Password</label>
                            {!! Form::password('password', ['class' =>
                            'form-control','pattern'=>'.{6,16}','required'=>'true','title'=>'6 characters minimum and 16
                            characters maximum']) !!}
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            {!! Form::password('password_confirmation', ['class' =>
                            'form-control','pattern'=>'.{6,16}','required'=>'true','title'=>'6 characters minimum and 16
                            characters maximum']) !!}
                            <span></span>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Save
                        </button>

                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-body">
                        {!!Form::open([
                        'method'=>'delete',
                        'route'=>['user-destroy',$user->id],
                        'style'=>'display:inline',
                        'onsubmit'=>'return confirm("Are you sure you want to delete '.$user->first_name.' '.$user->last_name.' ?");'
                        ]) !!}

                        <button type="submit" class="btn btn-danger btn-block" popover="Delete"
                                popover-trigger="mouseenter"><i
                                    class="fa fa-remove"></i> Delete {{ $user->first_name }} {{ $user->last_name }}
                        </button>

                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
