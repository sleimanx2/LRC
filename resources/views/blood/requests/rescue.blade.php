@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Blood Rescue</h5>
    <ul class="list-unstyled toolbar pull-right">
        <li class="blood-request-info-header">
            <span>Completed</span>
            @if($bloodRequest->completed)
                <span popover="Confirmed" popover-trigger="mouseenter" class="badge badge-success"><i class="fa fa-check"></i></span>
            @else
                <span popover="Not Confirmed" popover-placement="left" popover-trigger="mouseenter" class="badge badge-warning"><i class="fa fa-times"></i></span>
            @endif
            
            <span class="m-l-sm">All Donors Confirmed</span>
            @if($bloodRequest->confirmed)
                <span popover="Confirmed" popover-trigger="mouseenter" class="badge badge-success"><i class="fa fa-check"></i></span>
            @else
                <span popover="Not Confirmed" popover-placement="left" popover-trigger="mouseenter" class="badge badge-warning"><i class="fa fa-times"></i></span>
            @endif
        </li>
        <li><a href="{{ route('blood-request-edit',[$bloodRequest->id]) }}" class="btn btn-info btn-action"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit Request</a></li>
        @if(!$bloodRequest->completed)
        <li>
            {!! Form::open(['method'=>'post', 'route'=>['blood-request-set-completed',$bloodRequest->id], 'style'=>'display:inline', 'onsubmit'=>'return confirm("Are you sure you want mark
            '.$bloodRequest->patient_name.'\'s request as complete ?");'
            ]) !!}

            <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Set as Complete</button>

            {!!Form::close()!!}
        </li>
        @endif
    </ul>
</div>
@endsection

@section('content')
<div class="page">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-list panel-ico"></i>Blood Request Info</strong>
                    <span class="badge {{$bloodRequest->due_date == date('Y-m-d',time()) ? 'badge-warning' : ''}} {{$bloodRequest->due_date < date('Y-m-d',time()) ? 'badge-danger' : 'badge-success'}} pull-right">Due: {{ Carbon\Carbon::parse($bloodRequest->due_date)->diffForHumans() }} </span>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <ul class="list-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-heart-o"></span>
                                            <label>Patient Name</label>
                                            <div class="pull-right">{!! Html::gender($bloodRequest->patient_gender) !!}<span class="sub-panel-title">{{ $bloodRequest->patient_name }}</span></div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-calendar"></span>
                                            <label>Patient Age</label>
                                            <div class="pull-right">{{ $bloodRequest->patient_age or 'Not defined'}}</div>
                                        </li>
                                        <li>
                                            <i class="icon fa fa-user-md"></i>
                                            <label>Case</label>
                                            <div class="pull-right">{{ $bloodRequest->case }}</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <div class="blood-request-info">
                                        <span class="blood-type">{{ $bloodRequest->blood_type->name or 'Not defined'}}</span>
                                        <div class="blood-units">
                                            <label><i popover="Blood" popover-trigger="mouseenter" class="fa fa-heart color-danger"></i>&nbsp;&nbsp;Blood Units</label>
                                            <div class="badge pull-right">{{ $bloodRequest->blood_quantity_confirmed }} / {{ $bloodRequest->blood_quantity }}</div>
                                            <br>
                                            <label><i popover="Platelets" popover-trigger="mouseenter" class="fa fa-heart color-warning"></i>&nbsp;&nbsp;Platelets</label>
                                            <div class="badge pull-right">{{ $bloodRequest->platelets_quantity_confirmed}} / {{ $bloodRequest->platelets_quantity }}</div>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-user"></span>
                                            <label>Contact Name</label>
                                            <div class="pull-right">{{ $bloodRequest->contact_name }}</div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-phone"></span>
                                            <label>Contact Phone</label>
                                            <div class="pull-right">{{ $bloodRequest->phone_primary  }} / {{$bloodRequest->phone_secondary }}</div>
                                        </li>
                                        <li>
                                            <span class="icon fa fa-bullhorn"></span>
                                            <label>Who to Blame</label>
                                            <div class="pull-right">{{ $bloodRequest->user->first_name or 'Not defined' }} {{ $bloodRequest->user->last_name or 'Not defined' }}</div>
                                        </li>
                                        @if($bloodRequest->note)
                                        <li class="blood-request-notes">
                                            <span class="icon fa fa-sticky-note"></span>
                                            <label>Important Notes</label>
                                            <p>{{$bloodRequest->note}}</p>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
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
                                    {{ $bloodRequest->blood_bank->phone_primary or 'Not defined'}} / {{ $bloodRequest->blood_bank->phone_secondary or ''}}
                                </li>
                            </ul>

                            <div class="form-group">
                                <div class="ui-map" id="map-canvas"></div>
                            </div>

                            <script type="text/javascript">
                                var location_name =  "{{ $bloodRequest->blood_bank->name }}";
                                var location_latitude = {{ $bloodRequest->blood_bank->latitude }};
                                var location_longitude = {{ $bloodRequest->blood_bank->longitude }};
                                var location_marker = null;

                                $(document).ready(function() {
                                    initMap();
                                    moveMap();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-check panel-ico"></i>Successful Blood Donations</strong>
                </div>
                <div class="panel-group" id="accordion-success-donations">
                    <div class="panel panel-default">
                        @foreach($bloodDonations as $bloodDonation)
                            <div class="panel-heading">
                                <div data-toggle="collapse" style="cursor: pointer;" data-parent="#accordion-success-donations" href="#{{ 'collapse-success-'.$bloodDonation->id  }}" class="collapse-panel-heading">
                                    {!! Html::gender($bloodDonation->donor->gender) !!}
                                    <span class="text-small sub-panel-title">{{ $bloodDonation->donor->first_name }} {{$bloodDonation->donor->last_name}}</span>

                                    <span class="pull-right">
                                        @if($bloodDonation->platelets)
                                            <span class="badge badge-outline"><i popover="Platelets" popover-trigger="mouseenter" class="fa fa-heart color-warning"></i></span>
                                        @else
                                            <span class="badge badge-outline"><i popover="Blood" popover-trigger="mouseenter" class="fa fa-heart color-danger"></i></span>
                                        @endif

                                        @if($bloodDonation->confirmed)
                                            <span popover="Confirmed" popover-trigger="mouseenter" class="badge badge-success"><i class="fa fa-check"></i></span>
                                        @else
                                            <span popover="Not Confirmed" popover-trigger="mouseenter" class="badge badge-warning"><i class="fa fa-times"></i></span>
                                        @endif

                                        <span popover="Donation Date" popover-trigger="mouseenter" class="badge">
                                            {{ $bloodDonation->will_donate_on}}
                                            {{ $bloodDonation->time ? ' | ' . $bloodDonation->time : '' }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{ 'collapse-success-'.$bloodDonation->id  }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="list-unstyled list-infolist-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-phone"></span>
                                            <label>Phone</label>
                                            {{ $bloodDonation->donor->phone_primary or 'Not defined'}} / {{ $bloodDonation->donor->phone_secondary or ''}}
                                        </li>
                                        <li>
                                            <span class="icon fa fa-question"></span>
                                            <label>Contacted By</label>
                                            {{ $bloodDonation->user->first_name or 'Not defined'}} {{ $bloodDonation->user->last_name or ''}}
                                        </li>
                                        <li>
                                            @if( ! $bloodDonation->confirmed )
                                                {!!Form::open([
                                                'route'=>['blood-donation-confirmed',$bloodDonation->id],
                                                'style'=>'display:inline',
                                                'onsubmit'=>'return confirm("Are you sure you want to confirm
                                                '.$bloodDonation->user->first_name.' donation ?");'
                                                ]) !!}

                                                <button type="submit" class="btn btn-success"
                                                        popover="Confirm"
                                                        popover-trigger="mouseenter">
                                                    Confirm
                                                </button>

                                                {!!Form::close()!!}
                                            @endif

                                            <button onclick="openWontDonate({{ $bloodDonation->donor->id }})" class="btn btn-bordered-danger">Can't Donate</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if( !$bloodRequest->completed )
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-list panel-ico"></i>Suggested Blood Donors</strong>
                </div>

                <div class="panel-group" id="accordion-potential-donations">
                    <div class="panel panel-default">
                        @foreach($bloodDonors as $bloodDonor)
                            <div class="panel-heading">
                                <div data-toggle="collapse" style="cursor: pointer;" data-parent="#accordion-potential-donations" href="#{{ 'collapse-potential-'.$bloodDonor->id  }}">
                                    {!! Html::gender($bloodDonor->gender) !!}

                                    @if($bloodDonor->golden_donor)
                                        <span popover="Golden Donor" popover-trigger="mouseenter" class="badge badge-warning">GD</span>
                                    @endif

                                    <span class="text-small sub-panel-title">{{ $bloodDonor->first_name }} {{$bloodDonor->last_name}}</span>

                                    <span class="pull-right">
                                        <span class="badge badge-distance" popover="Distance" popover-trigger="mouseenter">{{Html::distance($bloodDonor->distance)}}</span>
                                        <span class="badge">{{ Html::age($bloodDonor->birthday) }} Years </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{ 'collapse-potential-'.$bloodDonor->id  }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="list-unstyled list-infolist-unstyled list-info">
                                        <li>
                                            <span class="icon fa fa-phone"></span>
                                            <label>Phone</label>
                                            {{ $bloodDonor->phone_primary or 'Not defined'}} / {{ $bloodDonor->phone_secondary or ''}}
                                        </li>
                                        <li>
                                            <button onclick="openWillDonate({{ $bloodDonor->id }})" class="btn btn-bordered-success">Will Donate</button>
                                            <button onclick="openWontDonate({{ $bloodDonor->id }})" class="btn btn-bordered-danger">Can't Donate</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<div class="modal fade" id="wontDonate" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Can't Donate Before</h4>
            </div>
            {!! Form::open(['route' => 'blood-donor-wont-donate', 'method' => 'post']) !!}
            <div class="modal-body">
                <input type="hidden" name="bloodDonorId" id="bloodDonorId"/>
                <input type="hidden" name="bloodRequestId" value="{{$bloodRequest->id}}"/>
                
                <span class="list-unstyled">
                    <label class="ui-radio">
                        <input name="delay" checked="checked" type="radio" value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" checked="checked" type="radio" value="{{strtotime('+2 weeks')}}"><span> 2 Weeks</span>
                    </label>
                     <label class="ui-radio">
                         <input name="delay" checked="checked" type="radio" value="{{strtotime('+3 weeks')}}"><span> 3 Weeks</span>
                     </label>
                      <label class="ui-radio">
                          <input name="delay" checked="checked" type="radio" value="{{strtotime('+1 month')}}"><span> 1 Month</span>
                      </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+3 months')}}"><span> 3 Months</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+6 months')}}"><span> 6 Months</span>
                    </label>
                    <label class="ui-radio">
                        <input name="delay" type="radio" value="{{strtotime('+1 year')}}"><span> 1 Year</span>
                    </label>
                </span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="reset">CANCEL</button>
                <button class="btn btn-success" type="submit">SAVE</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="willDonate" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Will Donate</h4>
            </div>
            {!! Form::open(['route' => 'blood-donor-will-donate', 'method' => 'post']) !!}
            <div class="modal-body">
                <input type="hidden" name="donor_id" id="donorId"/>
                <input type="hidden" name="blood_request_id" value="{{$bloodRequest->id}}"/>

                <span class="list-unstyled">
                    <label class="ui-radio">
                      <input name="will_donate_on" checked="checked" type="radio" value="{{strtotime('+0 day')}}"><span> Today</span>
                    </label>
                    <label class="ui-radio">
                        <input name="will_donate_on" checked="checked" type="radio" value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                    </label>
                    <label class="ui-radio">
                        <input name="will_donate_on" type="radio" value="{{strtotime('+2 day')}}"><span> After Tomorrow</span>
                    </label>
                </span>
                <div class="row m-t-sm">
                    <div class="col-md-6">
                        <h5>Will Donate At</h5>
                        <div class="input-group ui-datepicker">
                            <input name="time" required class="form-control timepicker">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Donation Type</h5>
                        <span class="list-unstyled" style="padding-top: 4px; display: block;">
                            @if($bloodRequest->blood_quantity !== $bloodRequest->blood_quantity_confirmed)
                                <label class="ui-radio">
                                    <input name="donation_type" checked="checked" type="radio" value="blood"><span> Blood</span>
                                </label>
                            @endif
                            @if($bloodRequest->platelets_quantity !== $bloodRequest->platelets_quantity_confirmed)
                                <label class="ui-radio">
                                    <input name="donation_type" type="radio" value="platelets"><span> Platelets</span>
                                </label>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="reset">CANCEL</button>
                <button class="btn btn-success" type="submit">SAVE</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function openWillDonate(id) {
            $('#donorId').val(id);
            $('#willDonate').modal('show');
        }

        function openWontDonate(id) {
            $('#bloodDonorId').val(id);
            $('#wontDonate').modal('show');
        }

    </script>
@endsection
