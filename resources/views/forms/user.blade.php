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
    <label for="">Email</label>
    {!! Form::email('email', old('email') , ['class' => 'form-control','required'=>'true']) !!}

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
        <label for="">Phone Primary</label>
        {!! Form::text(
        'phone_primary',old('phone_number'),['class'=>'form-control','pattern'=>'.{8,8}','required'=>true,'title'=>'The
        number should contain 8 digits']) !!}
        <span></span>
    </div>
<div class="form-group">
    <label for="">Phone Secondary</label>
    {!! Form::text(
    'phone_secondary',old('phone_secondary'),['class'=>'form-control','pattern'=>'.{8,8}','title'=>'The number
    should contain 8 digits']) !!}
</div>
    <hr/>
    <div class="form-group">
        {!! Form::select('roles_ids[]', $roles, old('roles_ids'), array('multiple')) !!}
    </div>
<hr/>
<div class="form-group">
    {!! Form::hidden('location', old('location')
    ,['id'=>'location','class'=>'form-control','data-ng-value'=>'form.location']) !!}
    <google-places location=location></google-places>
</div>
<div class="form-group">

    {!! Form::hidden('latitude', old('latitude')
    ,['id'=>'latitude','class'=>'form-control','data-ng-model'=>'form.latitude','data-ng-value'=>'form.latitude']) !!}

    {!! Form::hidden('longitude', old('longitude')
    ,['id'=>'longitude','class'=>'form-control','data-ng-model'=>'form.longitude','data-ng-value'=>'form.longitude'])
    !!}

</div>

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

