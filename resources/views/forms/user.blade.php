{{--Setting form settings --}}
<?php  $password = isset($password) ? $password : 'true'  ?>
<span data-ng-controller="locationFormCtrl">
<div class="form-group">
    <label for="">First Name</label>
    {!! Form::text('first_name', old('first_name'), ['class' =>
    'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
</div>
<div class="form-group">
    <label for="">Last Name </label>
    {!! Form::text('last_name', old('last_name'), ['class' =>
    'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
</div>
    <div class="form-group">
        <label for="">Username </label>
        {!! Form::text('username', old('username'), ['class' =>
        'form-control','pattern'=>'.{2,}','require'=>'','title'=>'2 characters minimum']) !!}
    </div>
<div class="form-group">
    <label for="">Email</label>
    {!! Form::email('email', old('email') , ['class' => 'form-control']) !!}
    <span></span>
</div>
    <div class="form-group">
        <label for="">Promo</label>
        {!! Form::text('promo', old('promo') , ['class' => 'form-control']) !!}
        <span></span>
    </div>
    @if($password == 'true')
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Password</label>
                    {!! Form::password('password', ['class' =>
                    'form-control','pattern'=>'.{6,16}','required'=>'true','title'=>'6 characters minimum and 16
                    characters maximum']) !!}
                    <span></span>
                </div>
                <div class="col-md-6">
                    <label for="">Confirm Password</label>
                    {!! Form::password('password_confirmation', ['class' =>
                    'form-control','pattern'=>'.{6,16}','required'=>'true','title'=>'6 characters minimum and 16
                    characters maximum']) !!}
                    <span></span>
                </div>
            </div>
        </div>
    @endif

    <div class="form-group">
        <label for="">Phone Numbers</label>
        {!! Form::select('phone_numbers[]', [], old('phone_numbers'), array('multiple','class'=>'select-tags','style'=>'width:100%')) !!}
    </div>
    <hr/>
    <div class="form-group">
        <label for="">Roles</label>
        {!! Form::select('roles_ids[]', $roles, old('roles_ids'), array('multiple')) !!}
    </div>
<hr/>
    {{--Location Field--}}
    @include('partials.location')
    {{--End Location Field--}}

    <div class="form-group">
        <div class="ui-map" id="map-canvas"></div>
    </div>
<hr/>
<button type="submit" class="btn btn-success">
    Save
</button>
<button class="btn btn-default" type="reset">Revert Changes
</button>
</span>
