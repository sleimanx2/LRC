@extends('layouts.master')

@section('content')
    <div class="page ng-scope">
        <div class="row">

            @if($bloodRequest->completed or $bloodRequest->note)
                <div class="col-xs-12">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            @if($bloodRequest->completed)
                                <div class="callout-elem callout-elem-success">
                                    <h4><i class="fa fa-check"></i> This blood request was successfuly completed.</h4>
                                </div>
                            @endif
                            @if($bloodRequest->note)
                                <div class="callout-elem callout-elem-info">
                                    <h4>Request Note</h4>

                                    <p>{{$bloodRequest->note}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-list panel-ico"></i>Blood Request Info</strong>
                        <span class="badge {{$bloodRequest->due_date == date('Y-m-d',time()) ? 'badge-warning' : ''}} {{$bloodRequest->due_date < date('Y-m-d',time()) ? 'badge-danger' : 'badge-success'}} pull-right">Due: {{ $bloodRequest->due_date }} </span>

                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <ul class="list-unstyled list-info">
                                    <li>
                                        <span class="icon fa fa-heart-o"></span>
                                        <label>Patient Name</label>
                                        {!!
                                        Html::gender($bloodRequest->patient_gender)!!} {{ $bloodRequest->patient_name }}
                                    </li>

                                    <li>
                                        <span class="icon fa fa-calendar"></span>
                                        <label>Patient Age</label>
                                        {{ $bloodRequest->patient_age or 'Not defined'}}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-tint"></i>
                                        <label>Blood Type</label>
                                        {{ $bloodRequest->blood_type->name or 'Not defined'}}
                                    </li>
                                    <li>
                                        <i class="icon fa fa-crosshairs"></i>
                                        <label>Blood</label>
                                        {{ $bloodRequest->blood_quantity_confirmed }}
                                        /{{ $bloodRequest->blood_quantity }}
                                        &nbsp;&nbsp; <strong>/</strong>&nbsp;&nbsp;
                                        <i class="icon fa fa-crosshairs"></i>
                                        <label>Platelets </label>
                                        {{ $bloodRequest->platelets_quantity_confirmed}}
                                        /{{ $bloodRequest->platelets_quantity }}
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
                                    <li>
                                        <label for="">Completed</label>
                                        @if(  $bloodRequest->completed )
                                            <span popover="Confirmed" popover-trigger="mouseenter"
                                                  class="badge badge-success">
                                                 <i class="fa fa-check"></i>
                                            </span>
                                        @else
                                            <span popover="Not Confirmed" popover-placement="left"
                                                  popover-trigger="mouseenter"
                                                  class="badge badge-warning">
                                                 <i class="fa fa-times"></i>
                                            </span>
                                        @endif
                                        |
                                        <span>All donors confirmed</span>
                                        @if(  $bloodRequest->confirmed )
                                            <span popover="Confirmed" popover-trigger="mouseenter"
                                                  class="badge badge-success">
                                                 <i class="fa fa-check"></i>
                                            </span>
                                        @else
                                            <span popover="Not Confirmed" popover-placement="left"
                                                  popover-trigger="mouseenter"
                                                  class="badge badge-warning">
                                                 <i class="fa fa-times"></i>
                                            </span>
                                        @endif
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
                <div class="panel panel-default">
                    <div class="panel-body">


                        <a href="{{ route('blood-request-edit',[$bloodRequest->id]) }}" class="btn btn-info">Edit</a>
                        @if(!$bloodRequest->completed)

                            {!! Form::open([
                            'method'=>'post',
                            'route'=>['blood-request-set-completed',$bloodRequest->id],
                            'style'=>'display:inline',
                            'onsubmit'=>'return confirm("Are you sure you want mark
                            '.$bloodRequest->patient_name.'\'s request as complete ?");'
                            ]) !!}

                            <button class="btn btn-success">Set as complete</button>

                            {!!Form::close()!!}

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {{--Start Modal Scripts--}}
                <div class="modal fade" id="wontDonate" tabindex="-1" role="dialog"
                     aria-labelledby="favoritesModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>This donor can't donate before </h3>
                            </div>
                            {!! Form::open(['route' => 'blood-donor-wont-donate', 'method' => 'post']) !!}

                            <div class="modal-body">
                                <input type="hidden" name="bloodDonorId" id="bloodDonorId"/>
                                <input type="hidden" name="bloodRequestId" value="{{$bloodRequest->id}}"/>
                            <span class="list-unstyled">
                                <label class="ui-radio">
                                    <input name="delay" checked="checked" type="radio"
                                           value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                                </label>
                                <label class="ui-radio">
                                    <input name="delay" checked="checked" type="radio"
                                           value="{{strtotime('+2 weeks')}}"><span> 2 Weeks</span>
                                </label>
                                 <label class="ui-radio">
                                     <input name="delay" checked="checked" type="radio"
                                            value="{{strtotime('+3 weeks')}}"><span> 3 Weeks</span>
                                 </label>
                                  <label class="ui-radio">
                                      <input name="delay" checked="checked" type="radio"
                                             value="{{strtotime('+1 month')}}"><span> 1 Month</span>
                                  </label>
                                <label class="ui-radio">
                                    <input name="delay" type="radio"
                                           value="{{strtotime('+3 months')}}"><span> 3 Months</span>
                                </label>
                                <label class="ui-radio">
                                    <input name="delay" type="radio"
                                           value="{{strtotime('+6 months')}}"><span> 6 Months</span>
                                </label>
                                <label class="ui-radio">
                                    <input name="delay" type="radio"
                                           value="{{strtotime('+1 year')}}"><span> 1 Year</span>
                                </label>
                            </span>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-warning" type="reset" ng-click="cancel()">Cancel</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="willDonate" tabindex="-1" role="dialog"
                     aria-labelledby="favoritesModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>This donor will donate </h3>
                            </div>
                            {!! Form::open(['route' => 'blood-donor-will-donate', 'method' => 'post']) !!}
                            <div class="modal-body">

                                <input type="hidden" name="donor_id" id="donorId"/>
                                <input type="hidden" name="blood_request_id" value="{{$bloodRequest->id}}"/>

                            <span class="list-unstyled">
                                  <label class="ui-radio">
                                      <input name="will_donate_on" checked="checked" type="radio"
                                             value="{{strtotime('+0 day')}}"><span> Today</span>
                                  </label>
                                <label class="ui-radio">
                                    <input name="will_donate_on" checked="checked" type="radio"
                                           value="{{strtotime('+1 day')}}"><span> Tomorrow</span>
                                </label>
                                <label class="ui-radio">
                                    <input name="will_donate_on" type="radio" value="{{strtotime('+2 day')}}"><span> After tomorrow</span>
                                </label>
                            </span>

                                <div>
                                    <div class="panel-body" data-ng-controller="TimepickerCtrl">
                                        <div class="row">
                                            <div>
                                                <div class="form-group" data-ng-controller="DonateDatepickerCtrl">
                                                    <label for=""> <i class="fa fa-clock-o"></i> Will donate at </label>
                                                    <div class="input-group ui-datepicker">
                                                        <input name="time" required class="form-control timepicker">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Donation Type</h4>
                                <span class="list-unstyled">

                                    @if($bloodRequest->blood_quantity !== $bloodRequest->blood_quantity_confirmed)
                                        <label class="ui-radio">
                                            <input name="donation_type" checked="checked" type="radio"
                                                   value="blood"><span> Blood</span>
                                        </label>
                                    @endif
                                    @if($bloodRequest->platelets_quantity !== $bloodRequest->platelets_quantity_confirmed)
                                        <label class="ui-radio">
                                            <input name="donation_type" type="radio"
                                                   value="platelets"><span> Platelets</span>
                                        </label>
                                    @endif
                                </span>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-warning" type="reset" ng-click="cancel()">Cancel</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                {{--End Modal Scripts --}}

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-check panel-ico"></i>Successful Blood Donation</strong>
                    </div>
                    <div>
                        <div>
                            <div class="panel-group" id="accordion-success-donations">
                                <div class="panel panel-default">
                                    @foreach($bloodDonations as $bloodDonation)

                                        <div class="panel-heading">
                                            <div data-toggle="collapse" style="cursor: pointer;"
                                                 data-parent="#accordion-success-donations"
                                                 href="#{{ 'collapse-success-'.$bloodDonation->id  }}">
                                                {!! Html::gender($bloodDonation->donor->gender) !!}
                                                <span class="text-small">{{ $bloodDonation->donor->first_name }} {{$bloodDonation->donor->last_name}}</span>

                                                <span class="pull-right">
                                                    @if($bloodDonation->platelets)
                                                        <i popover="Platelets" popover-trigger="mouseenter"
                                                           class="fa fa-heart color-warning"></i>
                                                    @else
                                                        <i popover="Blood" popover-trigger="mouseenter"
                                                           class="fa fa-heart color-danger"></i>
                                                    @endif

                                                    <span popover="Donation Date" popover-trigger="mouseenter"
                                                          class="badge">
                                                        {{ $bloodDonation->will_donate_on}}
                                                        |
                                                        {{ $bloodDonation->time}}
                                                             </span>
                                                    @if(  $bloodDonation->confirmed )
                                                        <span popover="Confirmed" popover-trigger="mouseenter"
                                                              class="badge badge-success">
                                                             <i class="fa fa-check"></i>
                                                        </span>
                                                    @else
                                                        <span popover="Not Confirmed" popover-trigger="mouseenter"
                                                              class="badge badge-warning">
                                                             <i class="fa fa-times"></i>
                                                        </span>
                                                    @endif

                                                </span>
                                            </div>
                                        </div>
                                        <div id="{{ 'collapse-success-'.$bloodDonation->id  }}"
                                             class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul class="list-unstyled list-infolist-unstyled list-info">
                                                    <li>
                                                        <span class="icon fa fa-phone"></span>
                                                        <label>Phone</label>

                                                        {{ $bloodDonation->donor->phone_primary or 'Not defined'}}
                                                        /
                                                        {{ $bloodDonation->donor->phone_secondary or ''}}
                                                    </li>
                                                    <li>
                                                        <span class="icon fa fa-question"></span>
                                                        <label>Contacted By</label>

                                                        {{ $bloodDonation->user->first_name or 'Not defined'}}
                                                        {{ $bloodDonation->user->last_name or ''}}
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

                                                        <button onclick="openWontDonate({{ $bloodDonation->donor->id }})"
                                                                class="btn btn-bordered-danger">
                                                            Can't Donate
                                                        </button>


                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Only show blood donors if the request is not completed--}}
                @if( ! $bloodRequest->completed)

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong><i class="fa fa-list panel-ico"></i>Blood Donors Suggestions</strong>
                        </div>

                        <div>
                            <div class="panel-group" id="accordion-potential-donations">
                                <div class="panel panel-default">
                                    @foreach($bloodDonors as $bloodDonor)
                                        <div class="panel-heading">
                                            <div data-toggle="collapse" style="cursor: pointer;"
                                                 data-parent="#accordion-potential-donations"
                                                 href="#{{ 'collapse-potential-'.$bloodDonor->id  }}">
                                                {!! Html::gender($bloodDonor->gender) !!}

                                                @if($bloodDonor->golden_donor)
                                                    <span popover="Golden Donor" popover-trigger="mouseenter"
                                                          class="badge badge-warning">GD</span>
                                                @endif

                                                <span class="text-small">{{ $bloodDonor->first_name }} {{$bloodDonor->last_name}}</span>

                                                <span class="pull-right">
                                                    <span class="badge badge-distance" popover="Distance"
                                                          popover-trigger="mouseenter">{{Html::distance($bloodDonor->distance)}}</span>
                                                    <span class="badge">{{ Html::age($bloodDonor->birthday) }}
                                                        Years </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="{{ 'collapse-potential-'.$bloodDonor->id  }}"
                                             class="panel-collapse collapse">
                                            <div class="panel-body">
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
                                                        <button onclick="openWillDonate({{ $bloodDonor->id }})"
                                                                class="btn btn-bordered-success">
                                                            Will Donate
                                                        </button>
                                                        <button onclick="openWontDonate({{ $bloodDonor->id }})"
                                                                class="btn btn-bordered-danger">
                                                            Can't Donate
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
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