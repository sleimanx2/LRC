@extends('layouts.master')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Dashboard</h5>
</div>
@endsection

@section('content')
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


                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ @($bloodDonorsCount / $totalBloodDonors)*100}}"
                        aria-valuemin="0" aria-valuemax="100" style="width:{{ @($bloodDonorsCount / $totalBloodDonors)*100}}%">
                          <span class="sr-only">{{ @($bloodDonorsCount / $totalBloodDonors)*100}}% Complete</span>
                        </div>
                      </div>
                    </div>
                    <br>
                @endforeach

            </div>
            <div class="col-lg-4 col-xsm-6 panel-body">
                <h4>
                    Remaining Blood Request
                </h4>
                @if(! $remainingBloodRequests->isEmpty())
                    <ul class="list-group">

                    @foreach($remainingBloodRequests as $remainingBloodRequest)

                      <li class="list-group-item">
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
                      </li>

                    @endforeach
                  </ul>
                @else
                    <p> You don't have any remaining blood request. Good Job.</p>
                    <br>
                @endif



            </div>
            <div class="col-lg-4 col-xsm-6 panel-body">
                <h4>
                    Remaining Unconfirmed Blood Request
                </h4>
                @if(! $remainingUnconfirmedBloodRequests->isEmpty())
                    <ul class="list-group">
                      @foreach($remainingUnconfirmedBloodRequests as $remainingBloodRequest)
                        <li class="list-group-item">
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
                        </li>
                      @endforeach
                    </ul>
                @else
                    <p> You don't have any remaining unconfirmed blood request. Good Job.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
