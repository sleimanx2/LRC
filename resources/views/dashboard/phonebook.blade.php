@extends('layouts.dashboard')

@section('sub-header')
<div class="clearfix">
    <h5 class="page-title">Dashboard</h5>
</div>
@endsection

@section('content')
    <div class="page page-general">
        <div class="phonebook-container">
            <div class="overlay" onclick="hidePhonebookSidebar()"></div>
            @include('partials.phonebook')
        </div>
    </div>
@endsection
