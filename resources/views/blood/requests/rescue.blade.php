@extends('layouts.master')

@section('content')
    <div class="page ng-scope">
        <div class="row">
            @if($bloodRequest->note)

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="callout-elem callout-elem-info">
                            <h4>Request Note</h4>

                            <p>{{$bloodRequest->note}}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-list panel-ico"></i>Blood Request Info</strong>
                        <span class="badge badge-success pull-right">Due: {{ $bloodRequest->due_date }} </span>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <ul class="list-unstyled list-info">
                                    <li>
                                        <span class="icon fa fa-heart-o"></span>
                                        <label>Patient Name</label>
                                        {!! Html::gender($bloodRequest->patient_gender)!!} {{ $bloodRequest->patient_name }}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-tint"></i>
                                        <label>Blood Type</label>
                                        {{ $bloodRequest->blood_type->name or 'Not defined'}}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-crosshairs"></i>
                                        <label>Blood</label>
                                        {{ $bloodRequest->blood_quantity_confirmed }}/{{ $bloodRequest->blood_quantity }}
                                        &nbsp;&nbsp; <strong>/</strong>&nbsp;&nbsp;
                                        <i class="icon fa fa-crosshairs"></i>
                                        <label>Platelets </label>
                                        {{ $bloodRequest->platelets_quantity_confirmed }}/{{ $bloodRequest->platelets_quantity }}
                                    </li>

                                    <li>
                                        <i class="icon fa fa-user-md"></i>
                                        <label>Case</label>
                                        {{ $bloodRequest->case }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-user"></span>
                                        <label>Contact Name</label>
                                        {{ $bloodRequest->contact_name  }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-phone"></span>
                                        <label>Contact Phone</label>
                                        {{ $bloodRequest->phone_primary  }}
                                        /
                                        {{$bloodRequest->phone_secondary }}
                                    </li>
                                    <li>
                                        <span class="icon fa fa-question"></span>
                                        <label>Blame: </label>
                                        {{ $bloodRequest->user->first_name or 'Not defined' }}
                                        .{{ $bloodRequest->user->last_name or 'Not defined' }}
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-h-square panel-ico"></i>Blood Bank Info</strong>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <ul class="list-unstyled list-info">
                                    <li>
                                        <span class="icon fa fa-hospital-o"></span>
                                        <label>Name</label>
                                        {{ $bloodRequest->blood_bank->name }}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-phone"></i>
                                        <label>Phone</label>

                                        {{ $bloodRequest->blood_bank->phone_primary or 'Not defined'}}
                                        /
                                        {{ $bloodRequest->blood_bank->phone_secondary or ''}}
                                    </li>
                                </ul>

                                <map class="ui-map" zoom="11"
                                     center="[{{$bloodRequest->blood_bank->latitude}}, {{$bloodRequest->blood_bank->longitude}}]"
                                     scrollwheel="false">
                                    <marker position="[{{$bloodRequest->blood_bank->latitude}}, {{$bloodRequest->blood_bank->longitude}}]"
                                            title="{{$bloodRequest->blood_bank->name}}"
                                            animation="Animation.DROP"></marker>

                                </map>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-list panel-ico"></i>Blood Donors Suggestions</strong>
                    </div>

                    <div class="panel-body">
                        <accordion close-others="oneAtATime" class="ui-accordion ui-accordion-info">
                            @foreach($bloodDonors as $bloodDonor)

                                <accordion-group>
                                    <accordion-heading>
                                        {!! Html::gender($bloodDonor->gender) !!}

                                        @if($bloodDonor->golden_donor)
                                            <span class="badge badge-warning">GD</span>
                                        @endif

                                        <span class="text-small">{{ $bloodDonor->first_name }} {{$bloodDonor->last_name}}</span>

                                    <span class="pull-right">
                                        <span class="badge badge-distance">~{{ round($bloodDonor->distance) }} KM</span>
                                        <span class="badge">{{ Html::age($bloodDonor->birthday) }}
                                            Years </span>

                                    </span>

                                    </accordion-heading>
                                    <ul class="list-unstyled list-infolist-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-phone"></span>
                                            <label>Phone</label>

                                            {{ $bloodDonor->phone_primary or 'Not defined'}}
                                            /
                                            {{ $bloodDonor->phone_secondary or ''}}
                                        </li>
                                        <li>
                                            <span class="icon fa fa-envelope"></span>
                                            <label>Email</label>

                                            {{ $bloodDonor->email or 'Not defined'}}

                                        </li>
                                        <li>
                                            <button class="btn btn-bordered-success">
                                                Will Donate
                                            </button>
                                            <button class="btn btn-bordered-danger">
                                                Can't Donate
                                            </button>
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