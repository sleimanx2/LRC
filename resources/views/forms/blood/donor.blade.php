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
    <label for="">Blood Type</label>
    {!! Form::select('blood_type_id',$bloodTypes,
    old('blood_type_id'), ['class' => 'form-control']) !!}
</div>
<div class="form-group" data-ng-controller="DatepickerCtrl">
 <label for="">Birth Date</label>

 <div class="input-group ui-datepicker">
     {!! Form::text('birthday', old('birthday'), [
     'class' => 'form-control',
     'id'=>'datepicker',
     'datepicker-popup'=>'yyyy-M-dd',
     'ng-model'=>'dt',
     'ng-value'=> old('birthday'),
     'is-open'=>'opened',
     'datepicker-options'=>'dateOptions',
     'date-disabled'=>'disabled(date, mode)',
     'ng-required'=>'true',
     'close-text'=>'Close',
     ]) !!}

     <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
 </div>
</div>
<div class="form-group">
    <label for="">Email</label>
    {!! Form::email('email', old('email') , ['class' => 'form-control','required'=>'true']) !!}

    <span></span>
</div>
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
<div class="form-group">
    <label for="">Male</label>
    {!! Form::radio('gender', 'male', true); !!}
    &nbsp;&nbsp;
    <label for="">Female</label>
    {!! Form::radio('gender', 'female', false); !!}
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