@extends('layouts.master')

@section('content')
    <div class="page">
        <section class="panel panel-default table-dynamic">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><i class="fa fa-list panel-ico"></i>List of blood requests</strong>
                </div>
                <div class="table-filters">
                    <div class="row">
                        <div class="col-sm-5 hidden-xs pull-right">
                            <a href="{{ route('blood-request-create') }}" class="btn btn-warning btn-width-long pull-right">
                                Add a blood request <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <form class="form-inline ng-pristine ng-valid" role="form" method="GET"
                                  action="{{ route('blood-requests-list') }}">

                                <div class="form-group">
                                    <input type="text" name="search" value="{{ Request::get('search') }}"
                                           placeholder="Search patient name"
                                           class="form-control ng-pristine ng-valid">
                                </div>
                                <div class="form-group">
                                <span>
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if(!$bloodRequests->count())
                <div class="alert alert-warning">No result found !</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Blood Type</th>
                        <th>Quantity</th>
                        <th>Blood Bank</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bloodRequests as $bloodRequest)
                        <tr>
                            <td>{{$bloodRequest->patient_name}}</td>
                            <td>{{$bloodRequest->blood_type->name or 'Not assigned' }}</td>
                            <td>{{$bloodRequest->quantity}}</td>
                            <td>{{$bloodRequest->blood_bank->name or 'Not assigned' }}</td>
                            <td>{{$bloodRequest->due_date}}</td>
                            <td>
                                <a class="btn btn-info btn-xs"
                                   href="{{ route('blood-request-edit',[$bloodRequest->id]) }}"
                                   popover="Edit" popover-trigger="mouseenter"><i
                                            class="fa fa-edit "></i></a>
                                {!! Form::open([
                                'method'=>'delete',
                                'route'=>['blood-request-destroy',$bloodRequest->id],
                                'style'=>'display:inline',
                                'onsubmit'=>'return confirm("Are you sure you want to delete '.$bloodRequest->patient_name.'\'s request?");'
                                ]) !!}

                                <button type="submit" class="btn btn-danger btn-xs hidden-xs" popover="Delete"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-remove"></i>
                                </button>

                                {!!Form::close()!!}

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="col-md-12  ">
                <span class="pull-right">
                    <?php echo $bloodRequests->appends(Request::except('page'))->render() ?>
                </span>
            </div>
        </section>
    </div>
@endsection
