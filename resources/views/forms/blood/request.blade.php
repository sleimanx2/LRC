<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Blood Type</label>
            {!! Form::select('blood_type_id', $allBloodTypes, old('blood_type_id'), [ 'class' => 'blood-type-select', 'required' ]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Blood Units</label>
            <div class="input-group ui-spinner" data-ui-spinner="">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="up" data-type="plus" data-field="blood_quantity">
                        <i class="fa fa-plus"></i>
                    </button>
                </span>
                {!! Form::text('blood_quantity', $form_action == 'create' ? 0 : old('blood_quantity'),['class'=>'input-number form-control', 'min'=>'0' ,'max'=>'100' , 'required'=>true]) !!}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="down" data-type="minus" data-field="blood_quantity">
                        <i class="fa fa-minus"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="">Platelets</label>
            <div class="input-group ui-spinner" data-ui-spinner="">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="up" data-type="plus" data-field="platelets_quantity">
                        <i class="fa fa-plus"></i>
                    </button>
                </span>
                {!! Form::text('platelets_quantity', $form_action == 'create' ? 0 : old('platelets_quantity'),['class'=>'input-number form-control', 'min'=>'0' ,'max'=>'100' , 'required'=>true]) !!}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-spin="down" data-type="minus" data-field="platelets_quantity">
                        <i class="fa fa-minus"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group" data-ng-controller="DonateDatepickerCtrl">
            <label for="">Due Date</label>
            <div class="input-group ui-datepicker">
                {!! Form::text('due_date', old('due_date'), ['class' => 'form-control datepicker', 'required']) !!}
                <span class="input-group-addon" ng-click="open($event)"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Taken By</label>
                {!! Form::select('taken_by', $allUsers, auth()->check() ? ($form_action == 'create' ? auth()->user()->id : old('taken_by')) : '', ['class' =>'form-control']) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="">Received From</label>
                {!! Form::text('received_from', old('received_from'), ['class' =>'form-control format-title-case', 'required']) !!}
            </div>
        </div>
    </div>
</div>

<hr/>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Patient Name</label>

            <div class="input-group">
                {!! Form::text('patient_name', old('patient_name'), ['class' => 'form-control format-title-case', 'pattern'=>'.{2,}', 'required', 'title'=>'2 characters minimum']) !!}
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default btn-toggle-gender" ><i class="fa fa-male"></i></button>
                </div>
                {!! Form::hidden('patient_gender', $form_action == 'create' ? 'male' : old('patient_gender'), ['class' => 'patient-gender-hidden-input']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="">Patient Age</label>
            {!! Form::input('number','patient_age', old('patient_age'), ['class' =>'form-control','min'=>'0','max'=>'150']) !!}
        </div>
        <div class="form-group">
            <label for="">Case</label>
            {!! Form::select('case', $allPatientCases, old('case')) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Blood Bank</label>
            {!! Form::select('blood_bank_id', $allBloodBanks, old('blood_bank_id')) !!}
        </div>
        <div class="form-group">
            <label for="">Contact Person</label>
            {!! Form::text('contact_name', old('contact_name'), ['class' => 'form-control format-title-case', 'pattern'=>'.{2,}', 'required', 'title'=>'2 characters minimum']) !!}
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Primary Phone Number</label>
                    {!! Form::text('phone_primary',old('phone_number'),['class'=>'form-control format-phone','pattern'=>'[+]?[0-9]+', 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Secondary Phone Number</label>
                    {!! Form::text('phone_secondary',old('phone_secondary'),['class'=>'form-control format-phone','pattern'=>'[+]?[0-9]+']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<hr/>

<div class="form-group">
    <label for="">Notes</label>
    {!! Form::textarea('note',old('note'),['class'=>'form-control', 'rows'=>'2']) !!}
</div>

<hr/>

<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <button type="submit" class="btn btn-success ">SAVE</button>
        </div>
    </div>
</div>
