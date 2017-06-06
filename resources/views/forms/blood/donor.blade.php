<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>Personal Information</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">First Name</label>
                    {!! Form::text('first_name', old('first_name'), ['class' =>
                    'form-control','pattern'=>'.{2,}','required'=>'true','title'=>'2 characters minimum']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Last Name </label>
                    {!! Form::text('last_name', old('last_name'), ['class' =>
                    'form-control','pattern'=>'.{2,}','required'=>'true','title'=>'2 characters minimum']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Blood Type</label>
                    {!! Form::select('blood_type_id',$bloodTypes,
                    old('blood_type_id')) !!}
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Date of Birth</label>
                    <div class="input-group ui-datepicker">
                        {!! Form::text('birthday', old('birthday'), ['class' => 'form-control datepicker']) !!}
                        <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-radio-group-label">Gender</label>
                    <label for="">Male</label>
                    {!! Form::radio('gender', 'male', true) !!}
                    &nbsp;&nbsp;
                    <label for="">Female</label>
                    {!! Form::radio('gender', 'female', false) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" data-ng-controller="DonateDatepickerCtrl">
                    <label for="">Can't Donate Before <small><i>(Make sure you know what you are doing.)</i></small></label>
                    
                    <div class="input-group ui-datepicker">
                        {!! Form::text('incapable_till', old('incapable_till'), ['class' => 'form-control datepicker']) !!}
                        <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <h4>Contact Information</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Primary Phone Number</label>
                    {!! Form::text(
                    'phone_primary',old('phone_number'),['class'=>'form-control','pattern'=>'.{8,8}','required'=>true,'title'=>'The number should contain 8 digits']) !!}
                    <span></span>
                </div> 
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Secondary Phone Number</label>
                    {!! Form::text(
                    'phone_secondary',old('phone_secondary'),['class'=>'form-control','pattern'=>'.{8, 8}','title'=>'The number should contain 8 digits']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Email</label>
                    {!! Form::email('email', old('email') , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <hr/>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>Location Information</h4>
            </div>
            <div class="col-md-12">
                @include('partials.location')
                <div class="form-group">
                    <div class="ui-map" id="map-canvas"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h4>Notes</h4>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::textarea('note', old('note'), ['class' => 'form-control autogrow']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success m-r-sm">SAVE</button>
<a href="{{ route('blood-donors-list') }}" class="btn btn-default">CANCEL</a>