<div class="modal fade" id="modalAddEmergency" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Emergency</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
				<button type="button" class="btn btn-success">SAVE</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAddBloodRequest" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><b>CREATE BLOOD REQUEST</b></h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['route'=>'blood-request-store','name'=>'blood_request_add_form']); !!}
                	@include('forms.blood.request', ['form_action' => 'create'])
                {!! Form::close(); !!}
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
				<button type="button" class="btn btn-success">SAVE</button>
			</div> -->
		</div>
	</div>
</div>

@if(auth()->check())
<div class="modal fade" id="modalChangeUserPassword" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CHANGE PASSWORD</h4>
            </div>
            {!! Form::open(['route' => ['password-change', auth()->user()->id], 'name'=>'user_change_password_form']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Password</label>
                            {!! Form::password('password', ['class' => 'form-control','pattern'=>'.{4,16}','required'=>'true','title'=>'4 characters minimum']) !!}
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control','pattern'=>'.{4,16}','required'=>'true','title'=>'4 characters minimum']) !!}
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif