@extends('layouts.master')

@section('content')
    <div class="page">
        <section class="panel panel-default table-dynamic">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><i class="fa fa-list panel-ico"></i>List of system emergencies</strong>
                </div>
                <div class="table-filters">
                    <div class="row">
                        <div class="col-sm-5 hidden-xs pull-right">
                            <a href="{{ route('emergency-create') }}" class="btn btn-success btn-width-long pull-right">
                                Add an emergency <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-sm-7">
                            {{--<form class="form-inline ng-pristine ng-valid" role="form" method="GET"--}}
                                  {{--action="{{ route('emergencies-list') }}">--}}

                                {{--<div class="form-group">--}}
                                    {{--<input type="text" name="search" value="{{ Request::get('search') }}"--}}
                                           {{--placeholder="Search emergencies"--}}
                                           {{--class="form-control ng-pristine ng-valid">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--{!! Form::select('category', ['All','Categorised'=>$categories] ,--}}
                                    {{--Request::get('category') , ['class' => 'form-control']) !!}--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                {{--<span>--}}
                                    {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                                {{--</span>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        </div>
                    </div>
                </div>
            </div>

            @if(!$emergencies->count())
                <div class="alert alert-warning">No result found !</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Report Category</th>
                        <th>Casualties </th>
                        <th class="hidden-xs">Location</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emergencies as $emergency)
                        <tr>
                            <td>{{$emergency->report_category->name or ""}}</td>
                            <td>{{$emergency->casualties_count or "0"}}
                                <a href="#">
                                    <i popover="@foreach($emergency->casualties as $casualty) {{ $casualty->name }} @endforeach" popover-trigger="mouseenter" class="fa fa-heart-o"></i>
                                </a>
                            </td>
                            <td class="hidden-xs"> {{$emergency->location}} </td>
                            <td class="hidden-xs"> {{$emergency->destination}} </td>
                            <td class="hidden-xs"> {{$emergency->created_at}} </td>
                            <td>

                                <a class="btn btn-info btn-xs" href="{{ route('emergency-manage',[$emergency->id]) }}"
                                   popover="Manage" popover-trigger="mouseenter"><i
                                            class="fa fa-cog "></i></a>

                                <a class="btn btn-info btn-xs" href="{{ route('emergency-edit',[$emergency->id]) }}"
                                   popover="Edit" popover-trigger="mouseenter"><i
                                            class="fa fa-edit "></i></a>
                                {!!Form::open([
                                'method'=>'delete',
                                'route'
                                =>['emergency-destroy',$emergency->id],
                                'style'=>'display:inline',
                                'onsubmit'=>'return confirm("Are you sure you want to delete '.$emergency->patient_name.' ?");'
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
                    <?php echo $emergencies->appends(Request::except('page'))->render() ?>
                </span>
            </div>
        </section>
    </div>
@endsection
