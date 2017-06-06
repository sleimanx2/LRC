@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Edit User</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li><button class="btn btn-action btn-success" data-toggle="modal" data-target="#modalChangePassword"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Change Password</button></li>
    </ul>
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

                        {!! Form::model($user, ['route' => ['user-update', $user->id], 'name'=>'user_register_form']) !!}
                        @include('forms.user',['password'=>'false'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDial" aria-hidden="true" id="modalChangePassword">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">CHANGE PASSWORD</h4>
                </div>
                {!! Form::open(['route' => ['password-change', $user->id], 'name'=>'user_change_password_form']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
