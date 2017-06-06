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

                <canvas id="bloodDonorStatsChart" height="180" style="margin-left: -18px"></canvas>

                <ul class="list-unstyled list-inline text-center m-t-sm">
                  @foreach($bloodTypes as $index => $bloodType)
                  <li>
                    <span class="label" style="display: inline-block;  background-color: rgba(205, 32, 38, {{ 1 - ($index * 0.05) }});">{{ $bloodType->name }}
                      <p style="margin: 0; margin-top: 5px; font-size: 14px">{{ $bloodType->blood_donors_count() }}</p>
                    </span>
                  </li>
                  @endforeach
                </ul>

                <script>
                  var chart = document.getElementById("bloodDonorStatsChart").getContext("2d");
                  var chartData = [
                      @foreach($bloodTypes as $index => $bloodType)
                      {
                          value: {{ $bloodType->blood_donors_count() }},
                          color: "rgba(205, 32, 38, {{ 1 - ($index * 0.05) }})",
                          highlight: "#8c1014",
                          label: "{{ $bloodType->name }}"
                      },
                      @endforeach
                  ];

                  var bloodDonorStatsChart = new Chart(chart).Doughnut(chartData,{
                      segmentShowStroke : true,
                      segmentStrokeColor : "#fff",
                      segmentStrokeWidth : 1,
                      animationSteps : 100,
                      animationEasing : "easeOutBounce",
                      animateRotate : true,
                      animateScale : false,
                      responsive: true,
                      showTooltips: true,
                      tooltipTemplate: "<%= label %>",
                      onAnimationComplete: function() {
                          this.showTooltip(this.segments, true); 
                      },
                      tooltipEvents: [],
                      tooltipFontSize: 10,
                  });
                </script>
            </div>
            <div class="col-lg-4 col-xsm-6 panel-body">
                <h4>
                    Remaining Blood Requests
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
                            popover-trigger="mouseenter" title="Rescue">

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
                    Unconfirmed Blood Requests
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
                              popover-trigger="mouseenter" title="Rescue">
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
