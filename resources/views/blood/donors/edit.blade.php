@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Edit Blood Donor</h5>
</div>
@endsection

@section('content')
    <div class="page page-form">
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
                        {!!
                        Form::model($bloodDonor,['route'=>['blood-donor-update',$bloodDonor->id],'name'=>'blood_donor_add_form']);
                        !!}
                        @include('forms.blood.donor')
                        {!! Form::close(); !!}

                        <hr/>

                        {!!Form::open([
                        'method'=>'delete',
                        'route'=>['blood-donor-destroy',$bloodDonor->id],
                        'style'=>'display:inline',
                        'id'=>'delete-donor-'.$bloodDonor->id.'-form'
                        ]) !!}

                        <button id = 'delete-donor-{{$bloodDonor->id}}' type="submit" class="btn btn-danger btn-block" popover="Delete"
                                popover-trigger="mouseenter"><i
                                    class="fa fa-remove"></i> Delete {{ $bloodDonor->first_name.' '.$bloodDonor->last_name }}
                        </button>

                        {!!Form::close()!!}

                        <script type="text/javascript">
                            $("#delete-donor-{{ $bloodDonor->id }}").click(function(e){
                                swal({
                                            title: "Are you sure?",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "Yes, delete it!",
                                            closeOnConfirm: false
                                        },
                                        function(){
                                            $('#delete-donor-{{$bloodDonor->id}}-form').submit();
                                        });
                                e.preventDefault();
                                return false;
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
