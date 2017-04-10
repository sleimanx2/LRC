@extends('layouts.master')

@section('content')
<div class="page page-form ng-scope">
    <div class="row">
        <div class="col-md-12 ng-scope">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-pencil panel-ico"></i>Add an emergency</strong>
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
                    {!! Form::open(['route'=>'emergency-store','name'=>'emergency_add_form']); !!}
                    @include('forms.emergency')
                    {!! Form::close(); !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection