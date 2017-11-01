<!-- 
Form post url medicinenotes.
Controller MedicineNotesController@store.
 -->
@extends('form')

@section('doc_title')
Medicine IPD note
@endsection

@section('script')
	<style type="text/css">
		body {
  padding-top: 20px;
  padding-bottom: 20px;
}

.navbar {
  margin-bottom: 20px;
}
	</style>
@endsection

@section('content')
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand">IPD note</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<!-- 
			<ul class="nav navbar-nav">
			<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
			<li><a href="#">Link</a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
			<li><a href="#">Something else here</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">Separated link</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">One more separated link</a></li>
			</ul>
			</li>
			</ul>
			-->
			<!-- <p class="navbar-text">Signed in as {{ session('user_name_en') }}</p> -->
			<p class="navbar-text">{{ session('user_role_name') . '@' . session('user_division_name') }}</p>
			{!! Form::open(['url' => 'medicinenotes', 'id' => 'create_note', 'class' => 'navbar-form navbar-left']) !!}
			<!-- <form class="navbar-form navbar-left" role="search"> -->
				<div class="form-group">
				<input type="number" class="form-control" name="AN" placeholder="AN" value="{{ old('AN') }}">
				</div>
				<!-- <button type="submit" class="btn btn-default">Submit</button> -->

				<!-- Split button -->
				<div class="btn-group">
				<button type="button" class="btn btn-primary">Create</button>
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu">
					<li><a onclick="createAdmissionNote()">Admission note</a></li>
					<li><a onclick="createServiceNote(3)">On service note</a></li>
					<li><a onclick="createServiceNote(4)">Off service note</a></li>
					<li><a onclick="createServiceNote(5)">Transfer note</a></li>
					<li><a onclick="alert('แก้ code อยู่จ้า')">Consultation note</a></li>
					<li><a onclick="createDCNote()">Discharge summary</a></li>
					<li><a onclick="alert('ออกแบบยังไม่เสร็จจ้า')">From previous notes</a></li>	
				</ul>
				</div>
				<input id="fire_create_note" style="display:none;" type="submit" value="Save">
				<input type="hidden" name="note_type_id" id="note_type_id" value="">
				<!-- <button type="submit" class="btn btn-default">Submit</button> -->


			
				

			{!! Form::close() !!}

			
				
<!-- 
			<script type="text/javascript">
					function createAdmissionNote(){
						// alert('admission');
						$('#note_type_id').val('1');
						// alert($('#note_type_id').val());
						$('#fire_create_note').trigger('click');
					}
					function saveForm(){
						$('#fire_create_note').trigger('click');
					}
				</script>
			 -->
			<!-- </form> -->
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a>{{ session('user_name') }}</a></li>
				<li><a href="/auth/logout">Logout</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
@include('errors.invalid')
@include('partials.flash')
<div class="well table-responsive">
	<h3>My Notes : Latest First</h3><hr/>
	<table class="table table-hover">
	    <thead>
			<tr class="success">
				<th>Note</th>
				<th>AN</th>
				<th>Patient</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
	    </thead>
		<tbody>
			@foreach ($notes as $note)
			<tr class='info'>
				<td>{{ $note->getNoteTypeName() }}</td>
				<td>{{ $note->AN }}</td>
				<td>{{ $note->patient_name }}</td>
				<td>Draft</td>
				<td>
		        	<div class="btn-group dropup">
						<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Select <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="/medicinenotes/{{ $note->id }}/edit">Edit</a></li>
							<li><a onclick="alert('ยังไม่ได้ทำจ้า')">Publish</a></li>
							<li><a onclick="alert('ยังไม่ได้ทำจ้า')">Publish and Discharge</a></li>
						</ul>
					</div>
	    		</td>
			</tr>
	  		@endforeach
	  		<!-- 
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".clickable-row").click(function() {
					window.document.location = $(this).data("href");
					});
				});
			</script>
		 -->
		</tbody>
	</table>
</div>

<script type="text/javascript">

	// jQuery(document).ready(function($) {
	// 	$(".clickable-row").click(function() {
	// 	window.document.location = $(this).data("href");
	// 	});
	// });

	function createAdmissionNote(){ // Create Admission note.
		$('#note_type_id').val('1'); // id 1 = admission note. 
		$('#fire_create_note').trigger('click'); // summit.
	}
	function createDCNote(){ // Create Discharge note.
		$('#note_type_id').val('2'); // id 2 = discharge summary.
		$('#fire_create_note').trigger('click'); // summit.
	}
	function createServiceNote(noteID){ // Create Admission note.
		$('#note_type_id').val(noteID); // id 3,4,5 = On, Off, Trnsfer.
		$('#fire_create_note').trigger('click'); // summit.
	}
	function saveForm(){
		$('#fire_create_note').trigger('click');
	}
</script>

@endsection