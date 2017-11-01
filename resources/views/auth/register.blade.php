@extends('auth.auth')
@section('doc_title')
Register
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-danger">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<!-- 
						text username
						<div class="form-group">
							<label class="col-md-4 control-label">Username :</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>
 -->
						<!-- text sap_id -->
						<div class="form-group">
							<label class="col-md-4 control-label">SAP ID :</label>
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder='หากยังไม่มี SAP ID ให้เลือก username ตามต้องการ' name="sap_id" value="{{ old('sap_id') }}">
							</div>
						</div>

						<!-- text name -->
						<div class="form-group">
							<label class="col-md-4 control-label">Name (th) :</label>
							<!-- <div class='col-md-2'>
				                <select class="form-control" name='division_id' id='division_id_selected' value='26'>
				                    <option selected disabled hidden value=''></option>
									<option value="1">คุณ</option>
									<option value="2">พญ.</option>
									<option value="3">อ.พญ.</option>
									<option value="4">ผศ.พญ.</option>
									<option value="5">รศ.พญ.</option>
									<option value="6">ศ.พญ.</option>
									<option value="7">ศ.เกียรติคุณ พญ.</option>
									<option value="2">นพ.</option>
									<option value="3">อ.นพ.</option>
									<option value="4">ผศ.นพ.</option>
									<option value="5">รศ.นพ.</option>
									<option value="6">ศ.นพ.</option>
									<option value="7">ศ.เกียรติคุณ นพ.</option>
								</select>
							</div> -->
							<div class="col-md-4">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<!-- text name_en -->
						<div class="form-group">
							<label class="col-md-4 control-label">Name (en) :</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}">
							</div>
						</div>

						<!-- radio gender -->
						<div class="form-group">
							{!! Form::label('gender','Gender :',['class' => 'control-label col-md-4']) !!}
					        <div class='col-md-6'>
					            <label class="radio-inline">
					            	@if (old('gender') == 0)
					                <input type="radio" name="gender" value="0" checked>Female
					                @else
					                <input type="radio" name="gender" value="0">Female
					                @endif
					            </label>
					            <label class="radio-inline">
					            	@if (old('gender') == 1)
					                <input type="radio" name="gender" value="1" checked>Male
					                @else
					                <input type="radio" name="gender" value="1">Male
					                @endif
					            </label>
					        </div>
					    </div>

					    <!-- dob_tmp datetimepicker input  -->
            <div class='form-group'>
            	<input type="hidden" name="dob" id = "dob" value="{{ old('dob') }}">
                {!! Form::label('dob_tmp','Birthdate :',['class' => 'control-label col-md-4']) !!}
                <div class='col-md-6'>
                    <div class="input-group date" id='datetimepicker_dob_tmp'>
                        {!! Form::text('dob_tmp', null, ['class' => 'form-control', 'placeholder' => 'dd-mm-yyyy']) !!}                        
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker_dob_tmp').datetimepicker({
                                    locale: 'th',
                                    // format: 'YYYY-MM-DD',
                                    format: 'DD-MM-YYYY',
                                    showTodayButton: true,
                                    showClear: true
                                });
                            });
                            $('#datetimepicker_dob_tmp').focusout(function() {
                            	$('#dob_tmp').val(handleYear($('#dob_tmp').val()));
                            	// alert($('#dob_tmp').val());
                            	var dateArr = $('#dob_tmp').val().split('-');
                            	$('#dob').val(dateArr[2] + '-' + dateArr[1] + '-' + dateArr[0]);
                            	// alert($('#dob').val());
                            })
                        </script>
                    </div>
                </div>
            </div>

					    <!-- select division_id -->
					    <!-- 
					    <div class='form-group'>
				            {!! Form::label('division_id','Department :',['class' => 'control-label col-md-4']) !!}
				            <div class='col-md-6'>
				                <select class="form-control" name='division_id' id='division_id_selected' value='26'>
				                    <option selected disabled hidden value=''></option>
									<option value="1">ภาควิชากายวิภาคศาสตร์</option>
									<option value="2">ภาควิชากุมารเวชศาสตร์</option>
									<option value="3">ภาควิชาจักษุวิทยา</option>
									<option value="4">ภาควิชาจิตเวชศาสตร์</option>
									<option value="5">ภาควิชาจุลชีววิทยา</option>
									<option value="6">ภาควิชาชีวเคมี</option>
									<option value="7">ภาควิชาตจวิทยา</option>
									<option value="8">ภาควิชานิติเวชศาสตร์</option>
									<option value="9">ภาควิชาปรสิตวิทยา</option>
									<option value="10">ภาควิชาพยาธิวิทยา</option>
									<option value="11">ภาควิชาพยาธิวิทยาคลินิก</option>
									<option value="12">ภาควิชาเภสัชวิทยา</option>
									<option value="13">ภาควิชารังสีวิทยา</option>
									<option value="14">ภาควิชาวิทยาภูมิคุ้มกัน</option>
									<option value="15">ภาควิชาวิสัญญีวิทยา</option>
									<option value="16">ภาควิชาเวชศาสตร์การธนาคารเลือด</option>
									<option value="17">ภาควิชาเวชศาสตร์ป้องกันและสังคม</option>
									<option value="18">ภาควิชาเวชศาสตร์ฉุกเฉิน</option>
									<option value="19">ภาควิชาเวชศาสตร์ฟื้นฟู</option>
									<option value="20">ภาควิชาศัลยศาสตร์</option>
									<option value="21">ภาควิชาศัลยศาสตร์ออร์โธปิดิคส์ฯ</option>
									<option value="22">ภาควิชาสรีรวิทยา</option>
									<option value="23">ภาควิชาสูติศาสตร์-นรีเวชวิทยา</option>
									<option value="24">ภาควิชาโสต นาสิก ลาริงซ์วิทยา</option>
									<option value="25">ภาควิชาอายุรศาสตร์</option>
									<option value="26">ฝ่ายการพยาบาล</option>
									<option value="27">กองอำนวยการ</option>
									<option value="28">การศึกษา</option>
									<option value="29">Visitor</option>
				                </select>
				            </div>
				        </div>
 -->
				        <!-- select role_id -->
				        <!-- 
					    <div class='form-group'>
				            {!! Form::label('role_id','Role :',['class' => 'control-label col-md-4']) !!}
				            <div class='col-md-6'>
				                <select class="form-control" name='role_id' id='role_id_selected' onchange="toggleLNO();">
				                    <option selected disabled hidden value=''></option>
				                    <option value="1">Staff</option>
				                    <option value="2">Resident</option>
				                    <option value="3">Nurse</option>
				                    <option value="4">Officer</option>
				                    <option value="5">Student</option>                    
				                </select>
				                <script type="text/javascript">
				                	function toggleLNO(){
				                		var x = parseInt($('#role_id_selected').val());
				                		if (x < 3)
				                			$('#lno').show();
				                		else
				                			$('#lno').hide();
				                	}
				                </script>
				            </div>
				        </div>
 -->
				        <!-- text licence_no -->
						<div class="form-group" id='lno'>
							<label class="col-md-4 control-label">Register code :</label>
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="สำหรับแพทย์ให้ใส่เลข ว." name = "licence_no" value="{{ old('licence_no') }}">
							</div>
							<script type="text/javascript">
								
							</script>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address :</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password :</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password :</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 
<script type="text/javascript">
	$(document).ready(function(){
				                		$('#lno').hide();	
				                	});
</script>
 -->
@endsection