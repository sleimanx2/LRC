@extends('layouts.master')

@section('content')
    <div class="page">
        <div class="page page-general">
            <div class="row panel">
                <div class="col-lg-4 col-xsm-6 panel-body">

                    <h4>
                        Blood Donor Stats
                        <span class="pull-right badge badge-primary">Total : {{$totalBloodDonors}}</span>
                    </h4>


                    @foreach($bloodTypes as $bloodType)
                        <?php $bloodDonorsCount = $bloodType->blood_donors_count(); ?>
                        <div>
                            <p class="text-muted medium">
                                <span class="badge">{{$bloodDonorsCount}}</span> {{$bloodType->name}}

                                <span class="pull-right">{{ @($bloodDonorsCount / $totalBloodDonors)*100}}
                                    %</span>
                            </p>
                            <progressbar class="progressbar-xs no-margin"
                                         value="{{ @($bloodDonorsCount / $totalBloodDonors)*100}}"
                                         type="warning"></progressbar>
                        </div>
                        <br>
                    @endforeach

                </div>
                <div class="col-lg-4 col-xsm-6 panel-body">
                    <h4>
                        Remaining Blood Request
                    </h4>
                    @if(! $remainingBloodRequests->isEmpty())
                        @foreach($remainingBloodRequests as $remainingBloodRequest)
                            <div>
                                <p class="text-muted medium">
                                    {{$remainingBloodRequest->patient_name}}
                                    <span class="pull-right">
                                        <span class="badge">{{$remainingBloodRequest->blood_type->name}}</span>
                                     <a class="btn btn-bordered-warning btn-xs"
                                        href="{{ route('blood-request-rescue',[$remainingBloodRequest->id]) }}"
                                        popover="Rescue"
                                        popover-trigger="mouseenter">

                                         <i class="fa fa-life-ring"></i>

                                     </a>
                                    </span>
                                </p>
                            </div>
                            <br>
                        @endforeach
                    @else
                        <p> You don't have any remaining blood request. Good Job.</p>
                    @endif

                    <h4>
                        Remaining Unconfirmed Blood Request
                    </h4>
                    @if(! $remainingUnconfirmedBloodRequests->isEmpty())
                        @foreach($remainingUnconfirmedBloodRequests as $remainingBloodRequest)
                            <div>
                                <p class="text-muted medium">
                                    {{$remainingBloodRequest->patient_name}}
                                    <span class="pull-right">
                                        <span class="badge">{{$remainingBloodRequest->blood_type->name}}</span>
                                     <a class="btn btn-bordered-warning btn-xs"
                                        href="{{ route('blood-request-rescue',[$remainingBloodRequest->id]) }}"
                                        popover="Rescue"
                                        popover-trigger="mouseenter">

                                         <i class="fa fa-life-ring"></i>

                                     </a>
                                    </span>
                                </p>
                            </div>
                            <br>
                        @endforeach
                    @else
                        <p> You don't have any remaining unconfirmed blood request. Good Job.</p>
                    @endif

                </div>
                <div class="col-lg-4 col-xsm-6 panel-body">
                    <h4>
                        Today's Report
                    </h4>
                    @if(! $emergencyReports->isEmpty())
                        @foreach($emergencyReports as $emergencyReport)
                            <div>
                                <p class="text-muted medium">
                                    {{$emergencyReport->report_category->name}}
                                    <span class="pull-right">
                                        <span class="badge">{{$emergencyReport->total}}</span>
                                    </span>
                                </p>
                            </div>
                            <br>
                        @endforeach
                        <p>
                            - Only categories with attached emergency are listed.
                        </p>
                    @else
                        <p>
                            Their is no registered emergency today. Let's hope it stays the same.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
