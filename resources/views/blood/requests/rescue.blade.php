@extends('layouts.master')

@section('content')
    <div class="page ng-scope">
        <div class="row">
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
                                        {{ $bloodRequest->patient_name }}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-tint"></i>
                                        <label>Blood Type</label>
                                        {{ $bloodRequest->blood_type->name or 'Not defined'}}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-crosshairs"></i>
                                        <label>Blood</label>
                                        {{ $bloodRequest->blood_quantity }}/2
                                        &nbsp;&nbsp; <strong>/</strong>&nbsp;&nbsp;
                                        <i class="icon fa fa-crosshairs"></i>
                                        <label>Platelets </label>
                                        {{ $bloodRequest->platelets_quantity }}/3
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
                                        <span class="icon fa fa-h-square"></span>
                                        <label>Blood Banks</label>
                                        {{ $bloodRequest->blood_bank->name or 'Not defined' }}
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


                    <ul class="list-group">
                        @foreach($bloodDonors as $bloodDonor)
                            <li class="list-group-item">

                                <span class="badge">~{{ round($bloodDonor->distance) }} KM</span>
                                <span class="badge">{{ 32 }} Years </span>
                                <span class="badge badge-warning">GD</span>
                                <span class="badge badge-info-alt"><i class="fa fa-male"></i></span>


                            <div class="dropdown text-normal nav-profile">
                                <a href="javascript:;" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-small"> <i class="fa fa-chevron-down color-gray-light"></i> </span>
                                </a>
                                <span class="text-small">{{ $bloodDonor->first_name }} {{$bloodDonor->last_name}}</span>

                                <div class="dropdown-menu pull-left with-arrow panel panel-default">

                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="#/pages/profile">
                                                <i class="fa fa-check color-success"></i>
                                                <span>Will Donate</span>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#/tasks">
                                                <i class="fa fa-close color-danger"></i>
                                                <span>Can't donate today</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            </li>
                        @endforeach
                    </ul>


                </div>

            </div>

        </div>

    </div>
@endsection