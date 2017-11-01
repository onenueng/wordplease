<!DOCTYPE html>
<html lang="th-TH">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
  <meta name="author" content="@yield('author')">
	<title>{{ Auth::user()->name . '@' . Auth::user()->division->name_eng_short }}</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-3.3.5/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ url('/assets/styles/jquery-ui-1.11.3.css') }}">

  <!-- script -->
  <!-- jQuery.js -->
  <script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
  <!-- tooltip.js -->
  <script src="{{ url('/assets/styles/bootstrap-3.3.5/js/tooltip.js') }}"></script>
  <!-- bootstrap.min.js -->
  <script src="{{ url('/assets/styles/bootstrap-3.3.5/js/bootstrap.min.js') }}"></script>
  <!-- jquery-ui.js -->
  <script src="{{ url('/assets/script/jquery-ui-1.11.3.min.js') }}"></script>

	<!-- style -->
	<style type="text/css">
/*	
    @font-face {
      font-family: 'CSPraJad';
      src: url('/assets/fonts/CSPraJad.otf');
    }

    @font-face {
      font-family: 'Roboto';
      font-style: normal;
      font-weight: 300;
      src: local('Roboto Light'), local('Roboto-Light'), url('/assets/fonts/Roboto-Light.ttf') format('ttf');
    }

    @font-face {
      font-family: 'Roboto';
      font-style: normal;
      font-weight: 400;
      src: local('Roboto'), local('Roboto-Regular'), url('/assets/fonts/Roboto-Regular.ttf') format('ttf');
    }
*/

		@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-Regular.ttf');
	}

	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-Bold.ttf');
		font-weight: bold;
	}

	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-Italic.ttf');
		font-style: italic;
	}

	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-BoldItalic.ttf');
		font-style: italic;
		font-weight: bold;
	}

    /*style for autocomplete vertical scroll*/
    .ui-autocomplete {
      font-family: "Roboto", Helvetica, Arial, sans-serif;
      max-height: 200px;
      overflow-y: auto;
      /* prevent horizontal scrollbar */
      overflow-x: hidden;
    }

    /* IE 6 doesn't support max-height
     * we use height instead, but this forces the menu to always be this tall
     */
    * html .ui-autocomplete {
      height: 200px;
    }

    .ui-tooltip {
      background: #666;
      color: white;
      border: none;
      padding: 10;
      opacity: 1;
      font-size: 12px;
    }

    body {
      font-family: "Roboto", Helvetica, Arial, sans-serif;
      font-size: 14px;
      line-height: 1.42857143;
      /*padding-top: 20px;*/
  		padding-bottom: 20px;
  		background-image: @yield('background_image');
    	background-repeat: repeat;
    	/*
    	-webkit-filter: grayscale(100%); /* Chrome, Safari, Opera 
			filter: grayscale(100%);
			*/
    }

		.navbar {
  		margin-bottom: 20px;
		}

        /*.input-group-addon.* style for confirmation*/
		.input-group-addon.primary {
			color: rgb(255, 255, 255);
			background-color: rgb(50, 118, 177);
			border-color: rgb(40, 94, 142);
		}
		.input-group-addon.success {
			color: rgb(255, 255, 255);
			background-color: rgb(92, 184, 92);
			border-color: rgb(76, 174, 76);
		}
		.input-group-addon.info {
			color: rgb(255, 255, 255);
			background-color: rgb(57, 179, 215);
			border-color: rgb(38, 154, 188);
		}
		.input-group-addon.warning {
			color: rgb(255, 255, 255);
			background-color: rgb(240, 173, 78);
			border-color: rgb(238, 162, 54);
		}
		.input-group-addon.danger {
			color: rgb(255, 255, 255);
			background-color: rgb(217, 83, 79);
			border-color: rgb(212, 63, 58);
		}
		
  </style>
  
  

  <!-- jQuery tooltip -->
  <script>
	$(document).ready(function() {
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});
	}); // prevent Enter key to summit form.
	$(function() {
		$( document ).tooltip();
	});
	function checkNote(id){
		$('#note_type_id').val(id);
		$('#action').val('check');
		$('#submit_button').trigger('click');
	}
	function createNote(id){
		$('#note_type_id').val(id);
		$('#action').val('create');
		$('#submit_button').trigger('click');
	}
  </script>
</head>
<body>
@if (session('confirm'))
<script type="text/javascript">
jQuery(function(){
	jQuery('#btn-confirm-create').click();
});
</script>
<!-- Button trigger modal -->
<button style="display: none;" type="button" id="btn-confirm-create" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-confirm-create"></button>

<!-- Modal -->
<div class="modal fade" id="modal-confirm-create" tabindex="-1" role="dialog" aria-labelledby="modal-confirm-createLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header alert alert-info">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-check-square-o" aria-hidden="true"></span> Please Confirm.</h4>
			</div>
			<div class="modal-body">
				<div class="input-group form-group">
					<span class="input-group-addon primary">HN</span>
					<input class="form-control" type="text" readonly value="{{ explode('|', session('confirm'))[0] }}">
				</div>
				<div class="input-group form-group">
					<span class="input-group-addon primary">Name</span>
					<input class="form-control" type="text" readonly value="{{ explode('|', session('confirm'))[1] }}">
				</div>
				<div class="input-group form-group">
					<span class="input-group-addon primary">AN</span>
					<input class="form-control" type="text" readonly value="{{ explode('|', session('confirm'))[2] }}">
				</div>
				<div class="input-group form-group">
					<span class="input-group-addon primary">Date Admit</span>
					<input class="form-control" type="text" readonly value="{{ explode('|', session('confirm'))[3] }}">
				</div>
				<div class="input-group form-group">
					<span class="input-group-addon primary">Date D/C</span>
					<input class="form-control" type="text" readonly value="{{ explode('|', session('confirm'))[4] }}">
				</div>
				<div class="input-group form-group">
					<span class="input-group-addon primary">Create</span>
					<input class="form-control" type="text" readonly value="{{ \App\IPDNote\NoteType::find(explode('|', session('confirm'))[5])->name }}">
				</div>
      </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancle</button>
				<button type="button" class="btn btn-success" onclick="createNote({{ explode('|', session('confirm'))[5] }})">Confirm</button>
			</div>
		</div>
	</div>
</div>
@endif
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
			<a class="navbar-brand"><span class="fa @yield('division_icon')"></span> {{ Auth::user()->division->name_eng_short }}</a>
		</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  <p class="navbar-text"><span class="fa fa-folder-open fa-rotate-90"></span> IPD Note</p>
	  <form method="POST" class="navbar-form navbar-left" action="@yield('form_post_url')">
	  	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="form-group">
				<input type="number" class="form-control" name="AN" placeholder="AN" required value="{{ (session('confirm') !== null) ? explode('|', session('confirm'))[2] : old('AN') }}">
			</div>
			<div class="btn-group"><!-- Split button -->
				<button type="button" class="btn btn-primary">Select</button>
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{-- <span class="caret"></span> --}}
					<span class="fa fa-terminal"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu">
					@yield('note_commands')
				</ul>
			</div>
			<input id="submit_button" style="display:none;" type="submit">
			<input type="hidden" name="note_type_id" id="note_type_id" value="">
			<input type="hidden" name="action" id="action" value="">
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li class="active"><a><span class="fa fa-user-md fa-lg"></span> {{ Auth::user()->name }}</a></li>
			<li><a href="/auth/logout" title="Logout"><span class="fa fa-sign-out fa-lg"></span></a></li>
		</ul>
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
@include('errors.invalid')
@include('partials.flash')
<div class="well table-responsive" style="background: rgba(0, 0, 0, 0.2);">
	<div class="col-md-offset-1 col-md-10">
		<h3 class="alert alert-info">My Notes : 
			<span class="btn btn-primary" type="button">All <span class="badge">{{ count($notes) }}</span></span> 
			<span class="btn btn-success" type="button">Publish <span class="badge">0</span></span> 
			<span class="btn btn-warning" type="button">Draft <span class="badge">{{ count($notes) }}</span></span>
            <span class="btn btn-danger" type="button">Overdue <span class="badge">{{ count($notes) }}</span></span> 
			</h3>
		<div class="panel panel-default">
			@if(count($notes) > 0)
			<table class="table table-hover table-bordered">
				<thead>
					<tr class="success">
						<th class="text-center">Note</th>
						<th class="text-center">AN</th>
						<th class="text-center">HN</th>
						<th class="text-center">Patient</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($notes as $note)
					<tr class='info'>
						<td class="text-center"><span style="font-size: 12px;" class="label label-info">{{ $note->type->name }}</span></td>
						<td class="text-center">{{ $note->AN }}</td>
						<td class="text-center">{{ $note->patient->HN }}</td>
						<td class="text-center">{{ $note->patient->getName() }}</td>
						<td class="text-center"><span style="font-size: 12px;" class="label label-danger">Overdue</span></td>
						<td class="text-center">
							<div class="btn-group dropup">
								<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Select <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{ url('/' . strtolower(Auth::user()->division->name_eng_short) . 'notes/' . $note->id . '/edit') }}"><span class="fa fa-edit"></span> Edit</a></li>
									<li><a onclick="alert('ยังไม่ได้ทำจ้า')"><span class="fa fa-archive"></span> Publish</a></li>
								</ul>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div>
	</div>
</div>
</div>
	<footer>
		@yield('footer')
	</footer>
</body>
</html>