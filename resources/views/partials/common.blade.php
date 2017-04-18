<div class="modal fade" id="modalAddEmergency" tabindex="-1" role="dialog">
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

<div class="modal fade" id="modalAddBloodRequest" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><b>CREATE BLOOD REQUEST</b></h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['route'=>'blood-request-store','name'=>'blood_request_add_form']); !!}
                @include('forms.blood.request')
                {!! Form::close(); !!}
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
				<button type="button" class="btn btn-success">SAVE</button>
			</div> -->
		</div>
	</div>
</div>

