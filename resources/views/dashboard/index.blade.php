@extends('layouts.dashboard')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Dashboard</h5>
</div>
@endsection

@section('content')
    <div class="page page-general">
        <div class="panel">
          <div class="panel-heading">
            <h4 class="panel-title">Active Emergencies</h4>
          </div>
          <div class="panel-body">
            <p><i>No Active Emergencies</i></p>
          </div>
        </div>
    </div>
@endsection
