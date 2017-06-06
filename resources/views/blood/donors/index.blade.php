@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Blood Donors</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li><a href="{{ route('blood-donor-create') }}" class="btn btn-action btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Blood Donor</a></li>
        <li>
            <form class="form-inline ng-pristine ng-valid" role="form" method="GET" action="{{ route('blood-donors-list') }}">
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
            @if(!$bloodDonors->count())
                <div class="alert alert-warning">No result found !</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Primary</th>
                        <th>Blood Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bloodDonors as $bloodDonor)
                        <tr>
                            <td>{{$bloodDonor->first_name}}</td>
                            <td>{{$bloodDonor->last_name}}</td>
                            <td>{{$bloodDonor->phone_primary}}</td>
                            <td>{{$bloodDonor->blood_type->name}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('blood-donor-edit',[$bloodDonor->id]) }}"
                                   popover="Edit" popover-trigger="mouseenter"><i
                                            class="fa fa-edit "></i></a>
                                {{--
                                {!! Form::open([
                                'method'=>'delete',
                                'route'=>['blood-donor-destroy',$bloodDonor->id],
                                'style'=>'display:inline',
                                'id'=>'delete-donor-'.$bloodDonor->id.'-form'
                                ]) !!}

                                <button id = 'delete-donor-{{$bloodDonor->id}}' type="submit" class="btn btn-danger btn-sm hidden-xs" popover="Delete"
                                        popover-trigger="mouseenter"><i
                                            class="fa fa-remove"></i>
                                </button>

                                {!!Form::close()!!} --}}

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

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="col-md-12  ">
                <span class="pull-right">
                    <?php echo $bloodDonors->appends(Request::except('page'))->render() ?>
                </span>
            </div>
        </section>
    </div>
@endsection
