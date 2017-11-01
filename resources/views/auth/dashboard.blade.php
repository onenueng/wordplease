@extends('form')

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
		<a class="navbar-brand" href="/">Wordplease</a>
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
			<p class="navbar-text">Signed in as Resident Evil</p>
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				<input type="text" class="form-control" placeholder="AN">
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
					<li><a href="#">Admission note</a></li>
					<li><a href="#">On service note</a></li>
					<li><a href="#">Off service note</a></li>
					<li><a href="#">Discharge summary</a></li>
					<!-- 
					<li><a href="#">Something else here</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Separated link</a></li>
					-->
					</ul>
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#">User : foodev</a></li>
				<li><a href="/auth/logout">Logout</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="well table-responsive">
	<h3>My Documents :</h3><hr/>
	<table class="table table-hover">
	    <thead>
			<tr class="success">
				<th>Form</th>
				<th>AN</th>
				<th>Patient</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
	    </thead>
		<tbody>
	  		<tr class='info'><!--  clickable-row' data-href='create' style="cursor:pointer"> -->
		        <td>Admission note</td>
		        <td>58352436</td>
		        <td>42876354 : สมหญิง จริงนะ</td>
		        <td>Draft</td>
		        <td>
		        	<div class="btn-group">
						<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Select <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="/med/admit/note">Edit</a></li>
							<li><a href="#">Publish</a></li>
							<li><a href="#">Publish and Discharge</a></li>
						</ul>
					</div>
	    		</td>
			</tr>
			<!-- </a></h3> -->
			<tr class='info'><!--  clickable-row' data-href='create' style="cursor:pointer"> -->
				<td>Discharge summary</td>
				<td>58123432</td>
				<td>43454765 : สมยศ ถูกแล้ว</td>
				<td>Draft</td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Select <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">Edit</a></li>
							<li><a href="#">Publish</a></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr class='info'><!--  clickable-row' data-href='create' style="cursor:pointer"> -->
				<td>Admission note</td>
				<td>58123432</td>
				<td>43454765 : สมยศ ถูกแล้ว</td>
				<td>Published</td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Select <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">View</a></li>
							<li><a href="#">Off service</a></li>
							<li><a href="#">Add addendum</a></li>
						</ul>
					</div>
				</td>
			</tr>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".clickable-row").click(function() {
					window.document.location = $(this).data("href");
					});
				});
			</script>
		</tbody>
	</table>
</div>


@endsection