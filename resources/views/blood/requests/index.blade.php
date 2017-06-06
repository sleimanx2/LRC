@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Blood Requests</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li><a href="" class="btn btn-action btn-success" data-toggle="modal" data-target="#modalAddBloodRequest"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Blood Request</a></li>
        <li>
            <form class="form-inline ng-pristine ng-valid" role="form" method="GET" action="{{ route('blood-requests-list') }}">
                <div class="form-group">
                    <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Search..." class="form-control ng-pristine ng-valid">
                </div>
                <div class="form-group">
                <span>
                    <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
                </span>
                </div>
            </form>
        </li>
    </ul>
</div>
@endsection

@section('content')
    <div class="page">
        <section class="panel panel-default table-dynamic">
            @if(!$bloodRequests->count())
                <div class="alert alert-warning">No result found !</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Blood Type</th>
                        <th>Blood</th>
                        <th>Platelets</th>
                        <th>Blood Bank</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bloodRequests as $bloodRequest)
                        <tr class="{{{ $bloodRequest->completed ? 'success' : 'warning' }}}">
                            <td>{{$bloodRequest->patient_name}}</td>
                            <td>{{$bloodRequest->blood_type->name or 'Not assigned' }}</td>
                            <td>
                                <span class="badge {{{ $bloodRequest->blood_quantity_confirmed == $bloodRequest->blood_quantity ? 'badge-success' :'badge-danger'  }}}">
                                    {{$bloodRequest->blood_quantity_confirmed}} / {{$bloodRequest->blood_quantity}}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{{ $bloodRequest->platelets_quantity_confirmed == $bloodRequest->platelets_quantity ? 'badge-success' :'badge-danger'  }}}">
                                    {{$bloodRequest->platelets_quantity_confirmed}} / {{$bloodRequest->platelets_quantity}}
                                </span>
                            </td>
                            <td>{{$bloodRequest->blood_bank->name_fmt or 'Not assigned' }}</td>
                            <td>
                                <span class="badge {{$bloodRequest->due_date == date('Y-m-d',time()) ? 'badge-warning' : ''}} {{$bloodRequest->due_date < date('Y-m-d',time()) ? 'badge-danger' : 'badge-success'}}">
                                      {{$bloodRequest->due_date}}
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-bordered-warning btn-sm"
                                   href="{{ route('blood-request-rescue',[$bloodRequest->id]) }}">Rescue</a>
                                <!-- <a class="btn btn-info btn-sm"
                                   href="{{ route('blood-request-edit',[$bloodRequest->id]) }}" popover="Edit"
                                   popover-trigger="mouseenter">
                                    <i class="fa fa-edit "></i>
                                </a> -->
                                {{--
                                {!! Form::open([
                                'method'=>'delete',
                                'route'=>['blood-request-destroy',$bloodRequest->id],
                                'style'=>'display:inline',
                                'id'=>'delete-request-'.$bloodRequest->id.'-form'
                                ]) !!}

                                <button id = 'delete-request-{{$bloodRequest->id}}' type="submit" class="btn btn-danger btn-sm hidden-xs" popover="Delete"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-remove"></i>
                                </button>

                                {!!Form::close()!!} --}}
                                <script type="text/javascript">
                                  $("#delete-request-{{ $bloodRequest->id }}").click(function(e){
                                    swal({
                                      title: "Are you sure?",
                                      type: "warning",
                                      showCancelButton: true,
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Yes, delete it!",
                                      closeOnConfirm: false
                                    },
                                    function(){
                                      $('#delete-request-{{$bloodRequest->id}}-form').submit();
                                    });
                                    e.preventDefault();
                                    return false;
                                  });
                                </script>
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
