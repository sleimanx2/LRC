@extends('layouts.master')

@section('content')
    <div class="page">
        <div class="page page-general">
            <div class="row panel">
                <div class="col-lg-3 col-xsm-6 panel-body">

                    <h4>
                        Blood Donor Stats
                        <span class="pull-right badge badge-primary">Total : {{$totalBloodDonors}}</span>
                    </h4>


                    @foreach($bloodTypes as $bloodType)
                        <?php $bloodDonorsCount = $bloodType->blood_donors_count(); ?>
                        <div>
                            <p class="text-muted medium">
                                <span class="badge">{{$bloodDonorsCount}}</span> {{$bloodType->name}}
                                <span class="pull-right">{{ ($bloodDonorsCount / $totalBloodDonors)*100}}
                                    %</span>
                            </p>
                            <progressbar class="progressbar-xs no-margin"
                                         value="{{ ($bloodDonorsCount / $totalBloodDonors)*100}}"
                                         type="warning"></progressbar>
                        </div>
                        <br>
                    @endforeach

                </div>


            </div>
        </div>
    </div>
@endsection
