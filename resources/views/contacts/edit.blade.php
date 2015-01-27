@extends('layouts.master')

@section('content')
    <div class="page page-form ng-scope">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ng-scope">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong><i class="fa fa-pencil panel-ico"></i>Edit a system
                            contact</strong>
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
                        {!! Form::model($contact,['route'=>['contact-update',$contact->id],'name'=>'contact_add_form']);
                        !!}
                        @include('forms.contact')
                        {!! Form::close(); !!}
                        <hr/>
                        {!!Form::open([
                        'method'=>'delete',
                        'route'=>['contact-destroy',$contact->id],
                        'style'=>'display:inline',
                        'onsubmit'=>'return confirm("Are you sure you want to delete '.$contact->name.' ?");'
                        ]) !!}

                            <button type="submit" class="btn btn-danger btn-block" popover="Delete"
                                    popover-trigger="mouseenter"><i
                                        class="fa fa-remove"></i> Delete {{ $contact->name }}
                            </button>

                        {!!Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
