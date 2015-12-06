@extends('layouts.master')

@section('content')
    <div class="page ng-scope">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <div class="col-md-3">
                                     <button class="btn btn-default" disabled="true"> Start Time </button>
                                     {{ $emergency->start_time }}
                                </div>
                                <div class="col-md-3">

                                    <?php if($emergency->reach_time == 0): ?> 
                                        {!! Form::open(['route' => ['emergency-status-update',$emergency->id]]) !!}
                                         <button type='submit' name='status' value="reach_time" class="btn btn-success">Patient Reached</button>
                                        {!! Form::close() !!}
                                    <?php else: ?>
                                        <button  disabled="true" class="btn btn-default"> Reach Time </button>
                                        {{ $emergency->reach_time }}
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php if($emergency->transfer_time == 0): ?> 
                                        {!! Form::open(['route' => ['emergency-status-update',$emergency->id]]) !!}
                                         <button type='submit' name='status' value="transfer_time" class="btn btn-success">Patient Transfered</button>
                                        {!! Form::close() !!}
                                    <?php else: ?>
                                         <button disabled="true" class="btn btn-default">Transfer Time</button>
                                        {{ $emergency->transfer_time }}                                        
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php if($emergency->end_time == 0): ?> 
                                        {!! Form::open(['route' => ['emergency-status-update',$emergency->id]]) !!}
                                             <button type='submit' name='status' value="end_time" class="btn btn-success">Ambulance Returned</button>
                                        {!! Form::close() !!}
                                    <?php else: ?>
                                        <button disabled="true" class="btn btn-default">End Time</button>
                                        {{ $emergency->end_time }}                                        
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="row">

            {{--@if($bloodRequest->completed or $bloodRequest->note)--}}
            {{--<div class="col-xs-12">--}}
            {{--<div class="panel panel-default">--}}

            {{--<div class="panel-body">--}}
            {{--@if($bloodRequest->completed)--}}
            {{--<div class="callout-elem callout-elem-success">--}}
            {{--<h4><i class="fa fa-check"></i> This blood request was successfuly completed.</h4>--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--@if($bloodRequest->note)--}}
            {{--<div class="callout-elem callout-elem-info">--}}
            {{--<h4>Request Note</h4>--}}

            {{--<p>{{$bloodRequest->note}}</p>--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endif--}}

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-list panel-ico"></i>Emergency Info</strong>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <ul class="list-unstyled list-info">
                                    <li>
                                        <span class="icon fa fa-heart-o"></span>
                                        <label>Contact Name</label>
                                        {{ $emergency->contact_name }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-phone"></span>
                                        <label>Contact Phone</label>
                                        {{ $emergency->phone_primary  }}
                                        /
                                        {{$emergency->phone_secondary }}
                                    </li>

                                    <li>
                                        <i class="icon fa fa-ambulance"></i>
                                        <label>Ambulance</label>
                                        {{ $emergency->ambulance->plate_number }}
                                    </li>

                                    <li>
                                        <i class="icon fa fa-user-md"></i>
                                        <label>Report Case</label>
                                        Avp
                                    </li>
                                    <li>
                                        <span class="icon fa fa-group"></span>
                                        <label><strong>Team</strong></label>

                                    </li>
                                    <li>
                                        <span class="icon fa fa-user"></span>
                                        <label>Driver</label>
                                        {{ $emergency->driver->full_name }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-user"></span>
                                        <label>Scout</label>
                                        {{ $emergency->scout->full_name }}

                                    </li>
                                    <li>
                                        <span class="icon fa fa-user"></span>
                                        <label>Patient Aider</label>
                                        {{ $emergency->patient_aider->full_name }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-user"></span>
                                        <label>Assistant</label>
                                        {{ $emergency->assistant->full_name }}
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-h-square panel-ico"></i>Emergency Route</strong>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <ul class="list-unstyled list-info">
                                    <li>
                                        <span class="icon fa fa-location-arrow"></span>
                                        <label>Location</label>
                                        {{ $emergency->location }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-hospital-o"></span>
                                        <label>Destination</label>
                                        {{ $emergency->destination or 'undefined' }}
                                    </li>
                                </ul>

                                <map class="ui-map" zoom="11"
                                     center="[{{$emergency->location_latitude}}, {{$emergency->location_longitude}}]"
                                     scrollwheel="false">
                                    <marker position="[{{$emergency->location_latitude}}, {{$emergency->location_longitude}}]"
                                            animation="Animation.DROP"
                                            icon="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|E74C3C"></marker>

                                    @if($emergency->destination)
                                        <marker position="[{{$emergency->destination_latitude}}, {{$emergency->destination_longitude}}]"
                                                animation="Animation.DROP"
                                                icon="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|27AE60"></marker>
                                    @endif
                                </map>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ route('emergency-edit',[$emergency->id]) }}" class="btn btn-info">Edit</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="badge badge-primary" popover="Casualties Number" popover-trigger="mouseenter"> {{$emergency->casualties_count}}</span>
                            Casualties
                        </strong>
                    </div>
                    <div>
                        <div class="modal-body">
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
                            {!! Form::open(['route' => ['emergency-casualty-store',$emergency->id]]) !!}
                                @include('forms.casualties')
                            {!! Form::close() !!}
                            <hr/>
                            <accordion close-others="oneAtATime" class="ui-accordion ui-accordion-info">

                                @foreach($emergency->casualties as $casualty )
                                    <accordion-group>
                                        <accordion-heading>

                                            <span class="text-small">{{ $casualty->name }}</span>

                                    <span class="pull-right">

                                        <i popover="Edit" popover-trigger="mouseenter" class="fa fa-angle-down"></i>

                                    </span>
                                        </accordion-heading>
                                        {!! Form::model($casualty,['route' =>
                                        ['emergency-casualty-update',$casualty->id]]) !!}
                                        @include('forms.casualties')
                                        {!! Form::close() !!}
                                    </accordion-group>
                                @endforeach
                            </accordion>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-hospital-o panel-ico"></i>Nearest Hospitals</strong>
                    </div>

                    <div class="panel-body">
                        <accordion close-others="oneAtATime" class="ui-accordion ui-accordion-info">

                            @foreach($contacts as $contact )
                                <accordion-group>
                                    <accordion-heading>
                                        <span class="text-small">{{ $contact->name }}</span>
                                    <span class="pull-right">
                                    <span class="badge badge-distance" popover="Distance"
                                          popover-trigger="mouseenter">{{Html::distance($contact->distance)}}</span>
                                    </span>
                                    </accordion-heading>
                                    <ul class="list-unstyled list-infolist-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-phone"></span>
                                            <label>Phone</label>
                                            {{ $contact->phone_primary  or 'Not defined' }}
                                            /
                                            {{ $contact->phone_secondary  or '' }}
                                        </li>
                                    </ul>

                                </accordion-group>
                            @endforeach
                        </accordion>

                    </div>

                </div>


            </div>

        </div>

    </div>
@endsection