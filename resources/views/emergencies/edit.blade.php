@extends('layouts.master')

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ng-scope">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><i class="fa fa-pencil panel-ico"></i>Edit an emergency
                            </strong>
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
                        {!! Form::model($emergency,['route'=>['emergency-update',$emergency->id],'name'=>'emergency_edit_form']);
                        !!}
                        @include('forms.emergency')
                        {!! Form::close(); !!}
                        <hr/>
                        {!!Form::open([
                        'method'=>'delete',
                        'route'=>['emergency-destroy',$emergency->id],
                        'style'=>'display:inline',
                        'onsubmit'=>'return confirm("Are you sure you want to delete this emergency ?");'
                        ]) !!}

                        <button type="submit" class="btn btn-danger btn-block" popover="Delete"
                                popover-trigger="mouseenter"><i
                                    class="fa fa-remove"></i> Delete this emergency
                        </button>

                        {!!Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
