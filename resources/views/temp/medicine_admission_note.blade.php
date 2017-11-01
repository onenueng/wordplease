@extends('medicine.form')

@section('doc_title')
Admission note form
@endsection

@section('description')siriraj medicine admission note form @endsection

@section('author')koramit pichana @endsection

@section('script')
<!-- nav-bar and accodien together -->
<style type="text/css">
	body {
		padding-top: 100px;
		/*padding-left: 10px;
		padding-right: 10px;*/
		}
</style>

<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    // obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    obj.style.height = obj.contentWindow.document.body.scrollHeight * 0.75 + 'px';
    obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
  }
</script>
@include('wordplease_js')
@endsection

@section('content')
@include('partials.flash');
<!-- {!! Form::open(['url' => '/', 'id' => 'admission_note']) !!} -->
{!! Form::model($anote,['method' => 'PATCH', 'action' => ['MedicineNotesController@update',$anote->note_id]]) !!}



<!-- main panel group -->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<!-- preliminary panel -->
	<div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				Preliminary data
				</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne"><!--  collapse one -->
			<div class="panel-body"><!--  panel one -->
				<div class="form-horizontal row"><!-- Preliminary form -->
					<!-- row 1 HN patient_name -->
					<!-- field HN type integer -->
					<div class='col-md-6 form-group'>
						{!! Form::label('HN','HN :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-4'> {!! Form::number('HN',null,['class' => 'form-control', 'readonly']) !!} </div>
					</div>

					<!-- field patient_name type string -->
					<div class='col-md-6 form-group'>
						{!! Form::label('patient_name','Patient :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'> 
						<!-- 	{!! Form::text('patient_name',null,['class' => 'form-control', 'value' => 'สมหญิง จริงนะ']) !!}  -->
						<input type='text' class='form-control' value="{{ session('patient_name') }}" name='patient_name' readonly />
						</div>
					</div><!-- end of row 1 -->

					<!-- row 2 gender age -->
					<!-- field gender type boolean -->
					<div class='col-md-6 form-group'>
						{!! Form::label('gender','Gender :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-4'>
							<!--  {!! Form::text('gender',null,['class' => 'form-control']) !!}  -->
							<input type='text' class='form-control' value="{{ session('patient_gender') }}" name='patient_gender' readonly />
						</div>
					</div>
					<!-- field age type tinyInteger -->
					<div class='col-md-6 form-group'>
						{!! Form::label('age','Age :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-4'> 
						<!-- 	{!! Form::number('age',null,['class' => 'form-control','required']) !!}  -->
							<input type='text' class='form-control' value="{{ session('patient_age') }}" name='patient_age' readonly />
						</div>
					</div><!-- end of row 2 -->

					<!-- row 3 AN date_admit -->
					<!-- field AN type integer -->
					<div class='col-md-6 form-group'>
						{!! Form::label('AN','AN :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-4'> {!! Form::number('AN',null,['class' => 'form-control', 'readonly']) !!} </div>
					</div>
					<!-- field date_admit type date -->
					<div class='form-group col-md-6'>
						{!! Form::label('date_admit','Date admit :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-5'>
							<div class="input-group date" id='datetimepicker_date_admit'>
								{!! Form::text('date_admit', null, ['class' => 'form-control', 'readonly']) !!}
			                    <!-- <input type='text' class="form-control" name="date_admit"/> -->
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
			                    <script type="text/javascript">
						            $(function () {
						                $('#datetimepicker_date_admit').datetimepicker({
						                    locale: 'th',
						                    // format: 'YYYY-MM-DD',
						                    format: 'DD-MM-YYYY',
						                    showTodayButton: true,
						                    showClear: true
						                });
						            });
			        			</script>
							</div>
						</div>
					</div><!-- end of row 3 -->

					<!-- row 4 ward attending -->
					<!-- autocomplete ward -->
					<div class='col-md-6 form-group'>
						{!! Form::label('ward','Ward :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-9'> 
						<!-- 	{!! Form::text('ward',null,['class' => 'form-control','placeholder' => 'type to auto-complete']) !!}  -->
							<input type='text' class='form-control' value="{{ session('ward_name') }}" name='ward' readonly />
						</div>
					</div>
					<!-- autocomplete attending -->
					<div class='col-md-6 form-group'>
						{!! Form::label('attending','Attending staff :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'> {!! Form::text('attending',null,['class' => 'form-control ui-widget', 'placeholder' => 'type to auto-complete']) !!} </div>
						<script type="text/javascript">
							var staffs;
							$(function() {
							     staffs = [
									'อ.กนกวรรณ บุญญพิสิฎฐ์ | Neurology',
									'อ.กมล อุดล | Preventive',
									'อ.กฤติยา กอไพศาล | Oncology',
									'อ.กิตติพงศ์  มณีโชติสุวรรณ | Chest',
									'อ.กุสุมา ไชยสูตร | Nutrition',
									'อ.เกรียงศักดิ์ วารีแสงทิพย์ | Nephrology',
									'อ.ไกรวิพร  เกียรติสุนทร | Nephrology',
									'อ.จอมจิตต์ จันทรัศมี | Oncology',
									'อ.จารุวรรณ  เอกวัลลภ | Oncology',
									'อ.จินตนา  ศิรินาวิน | Genetics',
									'อ.จินตนา  อาศนะเสน | Geriatric',
									'อ.จิราภรณ์ จิตประไพกุล | Neurology',
									'อ.จิรายุ  เอื้อวรากุล | Hematology',
									'อ.จุลจักร ลิ้มศิริวิไล | Gastroenterology',
									'พญ. เจน  เจียรธนะกานนท์ | Hematology',
									'อ.เจริญ ฉั่วริยะกุล | Ambulatory ',
									'อ.เจษฎา ทวีโภคสมบูรณ์ | Neurology',
									'อ.แจ่มศักดิ์  ไชยคุนา | Chest',
									'อ.ฉัตรกนก ทุมวิภาต | Cardiology',
									'อ.ฉัตรี หาญทวีพันธุ์ | Hematology',
									'อ.ชนินทร์ ลิ่มวงศ์ | Genetics',
									'อ.ชยวี  เมืองจันทร์ | Rheumatology',
									'อ.ชลธิชา เอื้อสมหวัง | Ambulatory',
									'อ.ชัชวาล  รัตนบรรณกิจ | Neurology',
									'อ.ชัยพล  ธัญญานุวัติ | Nephrology',
									'อ.ชัยรัตน์ ฉายากุล | Nephrology',
									'อ.ชัยวัฒน์ วชิรศักดิ์ศิริ | Ambulatory',
									'อ.ชาญ ศรีรัตนสถาวร | Cardiology',
									'อ.ชุณหเกษม โชตินัยวัตรกุล | Cardiology',
									'อ.เชิดชัย  นพมณีจำรัสเลิศ | Ambulatory',
									'อ.โชค  ลิ้มสุวัฒน์ | Emergency',
									'อ.โชติพัฒน์  ด่านชัยวิจิตร | Neurology',
									'อ.ไชยรัตน์  เพิ่มพิกุล | Critical Care',
									'อ.ฐิติมา ว่องวิริยะกุบ | Geriatic',
									'อ.ณรงค์ภณ ทุมวิภาค | Preventive',
									'อ.ณสิกาญจน์  อังคเศกวินัย | Infectious',
									'อ.ณัฐกานต์  ประพฤติกิจ | Emergency',
									'อ.ณัฐเชษฐ์  เปล่งวิทยา | Endocrinology',
									'อ.ณัฐวุฒิ  วงษ์ประภารัตน์ | Cardiology',
									'อ.ดำรัส  ตรีสุโกศล | Cardiology',
									'อ.เดโช  จักราพานิชกุล | Cardiology',
									'อ.เด่นหล้า  ปาลเดชพงศ์ | Ambulatory',
									'อ.ต่อพงษ์ ทองงาม | Allergy',
									'อ.ถนอมศักดิ์ อเนกธนานนท์ | Preventive',
									'อ.ทวี  ชาญชัยรุจิรา | Nephrology',
									'อ.ทวีศักดิ์  แทนวันดี | Gastroenterology',
									'อ.ทวีศักดิ์ วรรณชาลี | Endocrionology',
									'อ.ทัศน์พรรณ ศรีทองกุล | Nephrology',
									'อ.ทิพา ชาคร | Emergency',
									'อ.ธนัญญา บุณยศิรินันท์ | Cardiology',
									'อ.ธรรมพร เนาว์รุ่งโรจน์ | Critical Care',
									'อ.ธวัชชัย  พีรพัฒน์ดิษฐ์ | Endocrinology',
									'อ.ธัญจิรา จิรนันทกาญจน์ | Preventive',
									'อ.ธัญญารัตน์  ธีรพรเลิศรัฐ | Nephrology',
									'อ.ธาดา คุณาวิศรุต | Endocrinology',
									'อ.ธีระ ฤชุตระกูล | Hematology',
									'อ.ธีระ กลลดาเรืองไกร | Preventive',
									'อ.นนทลี เผ่าสวัสดิ์ | Gastroenterology',
									'อ.นพดล  ศิริธนารัตนกุล | Hematology',
									'อ.นพดล  โสภารัตนาไพศาล | Oncology',
									'อ.นราธิป ชุณหะมณีวัฒน์ | General',
									'อ.นริศ  สมิตาสิน | Neurology',
									'อ.นลินี เปรมัษเฐียร | Nephrology',
									'อ.นัฐพล  ฤทธิ์ทยมัย | Chest',
									'อ.นัฐสิทธิ์  ลาภปริสุทธิ | Nephrology',
									'อ.นันทกร  ทองแตง | Endocrinology',
									'อ.นาราพร  ประยูรวิวัฒน์ | Neurology',
									'อ.นิธิพัฒน์  เจียรกุล | Chest',
									'อ.นิธิมา เชาวลิต | Cardiology',
									'อ.นิพนธ์  พวงวรินทร์ | Neurology',
									'อ.บุณฑริกา  สุวรรณวิบูลย์ | Hematology',
									'อ.เบญจมาศ ช่วยชู | Chest',
									'อ.ปฐมพงษ์  อึ้งประเสริฐ | General Medicine',
									'อ.ปทุมพร สุรอรุณสัมฤทธิ์ | Geriatic',
									'อ.ประดิษฐ์  ปัญจวีณิน | Cardiology',
									'อ.ประเสริฐ อัสสันตะชัย | Preventive',
									'อ.ปรัชญา ศรีวานิชภูมิ | Neurology',
									'อ.ปรีชา ธำรงไพโรจน์ | Critical care',
									'อ.ปรียานุช  แย้มวงษ์ | Nutrition',
									'อ.ปวีณา  เชี่ยวชาญวิศวกิจ | Rheumatology',
									'อ.ปวีณา  ชุณหโรจน์ฤทธิ์ | Endocrinology',
									'อ.ปิติพร รัตนทวีบุญ | Ambulatory ',
									'อ.ปีณิดา สกุลรัตนศักดิ์ | Nephrology',
									'อ.พจมาน พิศาลประภา | Ambulatory',
									'อ.พรพจน์  เปรมโยธิน | General Medicine',
									'อ.พรพรรณ  กู้มานะชัย | Infectious',
									'อ.พลอยเพลิน พิกุลสด | Hematology',
									'อ.พิมล  รัตนาอัมพวัลย์ | Chest',
									'อ.พีระ บูรณะกิจเจริญ | Hypertension',
									'อ.พีระวงศ์ วีรารักษ์ | Treventive',
									'อ.พูนทรัพย์  วงศ์สุรเกียรติ์ | Chest',
									'อ.พูลชัย  จรัสเจริญวิทยา | Gastroenterology',
									'อ.ไพฑูรย์  ขจรวัชรา | Nephrology',
									'อ.ภัณฑิลา วาณิชย์การ | Cardiology',
									'อ.ภาณุวัฒน์ พรหมสิน | Critical care',
									'อ.ภิญโญ  รัตนาอัมพวัลย์ | Infectious',
									'อ.มณฑิรา มณีรัตนะพร | Gastroenterology',
									'อ.มยุรี หอมสนิท | Preventive',
									'อ.มานพ พิทักษ์ภากร | Genetics',
									'อ.เมทินี  กิตติโพวานนท์ | Cardiology',
									'อ.เมธา ผู้เจริญชนะชัย | Hypertension',
									'อ.เมธี  ชยะกุลคีรี | Infectious',
									'อ.ยงค์  รงค์รุ่งเรือง | Infectious',
									'อ.ยงชัย  นิละนนท์ | Neurology',
									'อ.ยงยุทธ  สหัสกุล | Cardiology',
									'อ.ยิ่งยง ชินธรรมมิตร์ | Hematology',
									'อ.ยุพิน  ศุพุทธมงคล | Infectious',
									'อ.รณิษฐา  รัตนะรัต | Critical Care',
									'อ.ระวีวรรณ เลิศวัฒนารักษ์ | Endocrinology',
									'อ.รังสรรค์  ชัยเสวิกุล | Neurology',
									'อ.รัตนา ชวนะสุนทรพจน์ | Nephrology',
									'อ.รุ่งนิรันดร์  ประดิษฐสุวรรณ | Geriatric',
									'อ.รุ่งโรจน์  กฤตยพงษ์ | Cardiology',
									'อ.รุจิภาส สิริจตุภัธร | Infectious',
									'อ.เรวัตร  พันธุ์กิ่งทองคำ | Cardiology',
									'อ.วรการ วิไลชนม์ | Critical Care',
									'อ.วรพรรณ เสนาณรงค์ | Neurology',
									'อ.วรรณี นิธิยานันท์ | Endocrinology',
									'อ.วรางคณา  บุญญพิสิฏฐ์ | Cardiology',
									'อ.วรายุ  ปรัชญกุล | Gastroenterology',
									'อ.วราลักษณ์  ศรีนนท์ประเสริฐ | Geriatric',
									'อ.วัชรศักดิ์  โชติยะปุตตะ | Gastroenterology',
									'อ.วัฒนชัย โชตินัยวัตรกุล | Neurology',
									'อ.วันชัย  เดชสมฤทธิ์ฤทัย | Chest',
									'อ.วันชัย วนะชิวนาวิน | Hematology',
									'อ.วันรัชดา  คัชมาตย์ | Rheumatology',
									'อ.วิชัย เตชะสาธิต | Preventive',
									'อ.วิชัย ฉัตรธนวารี | Preventive',
									'อ.วิเชียร  ศรีมุนินทร์นิมิต | Oncology',
									'อ.วิทยา ไชยธีระพันธ์ | Cardiology',
									'อ.วินัย รัตนสุวรรณ | Preventive',
									'อ.วิวรรณ ทังสุบุตร | Cardiology',
									'อ.วิศิษฎ์ วามวาณิชย์ | Board Manager',
									'อ.วิษณุ  ธรรมลิขิตกุล | Infectious',
									'อ.วีรชัย ศรีวณิชชากร | Ambulatory',
									'อ.วีรนุช  รอบสันติสุข | Hypertension',
									'อ.วีรภัทร โอวัฒนาพานิช | Hematology',
									'อ.วีรศักดิ์ เมืองไพศาล | Preventive',
									'อ.ศรัทธา  ริยาพันธ์ | Emergency',
									'อ.ศรัทธาวุธ วงษ์เวียงจันทร์ | Neurology',
									'อ.ศรีสกุล  จิรกาญจนากร | Cardiology',
									'อ.ศิริโสภา เตชะวัฒนวรรณา | Oncology',
									'อ.ศิวะพร  ไชยนุวัติ | Gastroenterology',
									'อ.ศุทธินี  อิทธิเมฆินทร์ | Oncology',
									'อ.ศุภกาพันธุ์ รัตนมณีฉัตร | Preventive',
									'อ.ศุภชัย รัตนมณีฉัตร | Preventive',
									'อ.ศุภฤกษ์  ดิษยบุตร | Chest',
									'อ.สถาพร มานัสสถิตย์ | Gastroenterlogy',
									'อ.สนั่น  วิสุทธิศักดิ์ชัย | Hematology',
									'อ.สมเกียรติ  วสุวัฏฏกุล | Nephrology',
									'อ.สมชาย  ลีลากุศลวงศ์ | Gastroenterology',
									'อ.สมบูรณ์ อินทลาภาพร | Preventive',
									'อ.สสิธร  ศิริโท | Neurology',
									'อ.สัชชนะ  พุ่มพฤกษ์ | Cardiology',
									'อ.สัมมน โฉมฉาย | Preventive',
									'อ.สาธิต  วรรณแสง | Endocrinology',
									'อ.สาธิต เจนวณิชสถาพร | Cardiology',
									'อ.สิทธิ์  สาธรสุเมธี | Neurology',
									'อ.สิรวัฒน์  ศรีฉัตราภิมุข | General Medicine',
									'อ.สิริสวัสดิ์  วันทอง | Hypertension',
									'อ.สุกิจ รักษาสุข | Nephrology',
									'อ.สุชัย  เจริญรัตนกุล | Chest',
									'อ.สุชาย ศรีทิพยวรรณ | Nephrology',
									'อ.สุทิน ศรีอัษฎาพร | Endocrinology',
									'พญ. สุทิมา  เหลืองดิลก | Oncology',
									'อ.สุพจน์  พงศ์ประสบชัย | Gastroenterology',
									'อ.สุพจน์  นิ่มอนงค์ | Gastroenterology',
									'อ.สุรพล อิสรไกรศีล | Hematology',
									'อ.สุรพล สุวรรณกูล | Preventive',
									'อ.สุรพล กอบวรรธนะ | General Medicine',
									'อ.สุรศักดิ์  นิลกานุวงศ์ | Rheumatology',
									'อ.สุรัตน์  ทองอยู่ | Critical Care',
									'อ.สุรีย์  สมประดีกุล | Chest',
									'อ.สุวัจชัย  พรรัตนรังสี | Cardiology',
									'อ.สุสัณห์  อาศนะเสน | Infectious',
									'พญ. เสาวณีย์ สุขสุริยะโยธิน | Emergency',
									'อ.อดิศักดิ์  มณีไสย | Cardiology',
									'อ.อนุภพ จิตต์เมือง | Infectious',
									'อ.อนุวัฒน์  กีระสุนทรพงษ์ | Infectious',
									'พญ. อภิชญา มั่นสมบูรณ์ | Emergency',
									'อ.อภิชาต  มิคี วัลยะเสวี | Allergy',
									'อ.อภิชาติ พิศาลพงศ์ | Neurology',
									'อ.อภิรดี  ศรีวิจิตรกมล | Endocrinology',
									'อ.อมร  ลีลารัศมี | Infectious',
									'อ.อรนิช นาวานุเคราะห์ | Preventive',
									'อ.อรรถ  นานา | Chest',
									'อ.อรรถพงศ์  วงศ์วิวัฒน์ | Nephrology',
									'อ.อริศรา  สุวรรณกูล | Cardiology',
									'อ.อวยพร ศิริอยู่ยืน | Gastroenterology',
									'อ.อัจฉรา  กุลวิสุทธิ์ | Rheumatology',
									'อ.อาจบดินทร์ วินิจกุล | General',
									'อ.อาจรบ  คูหาภินันทน์ | Hematology',
									'อ.อุดม  คชินทร | Gastroenterology',
									'อ.อุบลวรรณ จงวุฒเวศย์ | Infectious',
									'อ.อุษาพรรณ สุรเบญจวงศ์ | Emergency',
									'อ.เอกพล อัจฉริยะประสิทธิ์ | Hematology',
									'อ.เอกพันธ์ ครุพงศ์ | Hematology',
									'อ.เอกรินทร์  ภูมิพิเชฐ | Critical Care',
									'อ.เอมวลี  อารมย์ดี | Rheumatology'
							    ];
							    $( "#attending" ).autocomplete({
							    	source: staffs,
							    	minLength: 2
							    });
							});
						</script>
					</div><!-- end of row 4 -->

					<!-- row 5 date_admit attending -->
					<!-- radio reason_admit -->
					<div class='form-group col-md-12'>
						{!! Form::label('reason_admit','Reason :',['class' => 'control-label col-md-1']) !!}
						<div class='from-group col-md-1'>
							<label class="radio-inline">
						    	<input type="radio" name="reason_admit" value="1">Curative
						    </label>
						</div>
						<div class='from-group col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="reason_admit" value="2" onclick="toggleOtherReasonCollapse('reason_admit','#otherReasonCollapse')">Curative+Palliative
						    </label>
						</div>
						<div class='from-group col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="reason_admit" value="3" onclick="toggleOtherReasonCollapse('reason_admit','#otherReasonCollapse')">Palliative only
						    </label>
						</div>
						<div class='from-group col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="reason_admit" value="4" onclick="toggleOtherReasonCollapse('reason_admit','#otherReasonCollapse')">Investigation
						    </label>
						</div>
					    <div class='from-group col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="reason_admit" value="5" onclick="toggleOtherReasonCollapse('reason_admit','#otherReasonCollapse')">Rehabilitation
						    </label>
						</div>
					    <div class='from-group col-md-2'>
						    <label class="radio-inline"><!-- implement move focus -->
						    	<input type="radio" name="reason_admit" value="0" onclick="toggleOtherReasonCollapse('reason_admit','#otherReasonCollapse')">Other
						    </label>
						</div>
					</div>
					<!-- row 6 admit_reason_other -->
					<!-- text admit_reason_other-->
					<div class='collapse col-md-6 form-group' id="otherReasonCollapse">
						{!! Form::label('admit_reason_other','Other :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-9'> {!! Form::text('admit_reason_other',null,['class' => 'form-control', 'placeholder' => 'other reason for admission type here']) !!} </div>
					</div>
					<!-- </div> --><!-- end of row 6 -->
				    <script type="text/javascript">
				    	function toggleOtherReasonCollapse(radioName,toggleName){
	                    if ($('input[name=' +  radioName + ']:checked', '#admission_note').val() != 0){
	                    	$(toggleName).collapse('hide');
	                    } else {
	                    	$(toggleName).collapse('show');
	                    }
	                }
				    </script>
				</div><!-- end of Preliminary form -->
			</div><!-- end of panel one -->
		</div><!--  end of collapse one -->
	</div><!-- end preliminary panel -->

	<!-- history panel -->
	<div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				History
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			<div class="panel-body">

				<!-- chief_complant textarea input -->
				<div class="panel panel-info">
					<div class="panel-heading">Chief complant</div>
					<div class="panel-body">
					{!! Form::textarea('chief_complant',null,['class' => 'form-control', 'rows' => '1']) !!}
					</div>
				</div><!-- end chief_complant textarea input -->

				<!-- panel co-morbid -->
				<div class="panel panel-info">
					<div class="panel-heading">Co-morbid and illness history</div>
					<div class="panel-body">
						<!-- co_morbid_check radio input -->
						<div class='from-group col-md-2'><label class="radio-inline">{!! Form::radio('co_morbid_check',-1) !!}No data all</label></div>
						<div class='from-group col-md-2'><label class="radio-inline">{!! Form::radio('co_morbid_check',0) !!}No co-morbid disease</label></div>
						<div class='from-group col-md-2'><label class="radio-inline">{!! Form::radio('co_morbid_check',1) !!}Toggle co-morbid List</label></div>
						<script type="text/javascript">
							$("input[name='co_morbid_check']").click(function(){
								var choice = $("input[name='co_morbid_check']:checked").val();
								if (choice < 0) {
									$("input[name*='comorbid'][value='-1']").prop('checked', true);
									$("input[name*='comorbid'][value='-1']").click();
								}
									else if (choice == 0) {
										$("input[name*='comorbid'][value='0']").prop('checked', true);
										$("input[name*='comorbid'][value='0']").click();
									}
										else {
											$('#comorbidList').collapse('toggle');
										}
							});
			                function toggleComorbid(radioName,toggleName){
			                    if ($('input[name=' +  radioName + ']:checked', '#admission_note').val() < 1){
			                    	$(toggleName).collapse('hide');
			                    } else {
			                    	$(toggleName).collapse('show');
			                    }
			                }
			            </script>
			            <div class="col-md-12"><hr></div>
			            
			            <!-- collapse Comorbid list -->
			            <div class="form-horizontal row collapse in" id="comorbidList_id">
							<!-- comorbid_DM radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('DM','DM :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_DM',-1) !!}No data</label>
								    <label class="radio-inline">{!! Form::radio('comorbid_DM',0) !!}No</label>
								    <label class="radio-inline">{!! Form::radio('comorbid_DM',1) !!}Yes</label>
								</div>
								<script type="text/javascript">
									$("input[name='comorbid_DM']").click(function(){
										($("input[name='comorbid_DM']:checked").val() == 1) ? $('#dmCollapse').collapse('show') : $('#dmCollapse').collapse('hide');
									});
								</script>
							</div>
							<div class='row col-md-offset-6'></div>

							<div class="collapse" id="dmCollapse">
								<!-- DM_type radio input -->
								<div class='form-group col-md-8'>
									{!! Form::label('DM_type','DM Type :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'>
										<label class="radio-inline">{!! Form::radio('DM_type',1) !!}Type I</label>
									    <label class="radio-inline">{!! Form::radio('DM_type',2) !!}Type II</label>
									</div>
								</div>
								<div class="col-md-12"></div>
								<div class='form-group col-md-8'>
									{!! Form::label('DM_complication','DM Complication :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'>
										<!-- DM_DR checkbox input-->
										<div class="checkbox col-md-4"><label>{!! Form::checkbox('DM_DR') !!}DR</label></div>
									    <!-- DM_nephropathy checkbox input-->
										<div class="checkbox col-md-4"><label>{!! Form::checkbox('DM_nephropathy') !!}Nephropathy</label></div>
									    <!-- DM_neuropathy checkbox input-->
										<div class="checkbox col-md-4"><label>{!! Form::checkbox('DM_neuropathy') !!}Neuropathy</label></div>
								    </div>
								</div>
								<div class="col-md-12"></div>

								<!-- DM_on radio input -->
								<div class='form-group col-md-8'>
									{!! Form::label('DM_complication','On :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'>
										<!-- DM_on_diet checkbox input -->
										<div class="checkbox col-md-4"><label>{!! Form::checkbox('DM_on_diet') !!}Diet control</label></div>
									    <!-- DM_on_oral_med checkbox input -->
										<div class="checkbox col-md-4"><label>{!! Form::checkbox('DM_on_oral_med') !!}Oral medication</label></div>
									    <!-- DM_on_insulin checkbox input -->
										<div class="checkbox col-md-4"><label>{!! Form::checkbox('DM_on_insulin') !!}Insulin</label></div>
								    </div>
								</div>
							</div><!-- end of DM collapse -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_HT radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('HT','HT :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_HT',-1) !!}No data</label>
								    <label class="radio-inline">{!! Form::radio('comorbid_HT',0) !!}No</label>
								    <label class="radio-inline">{!! Form::radio('comorbid_HT',1) !!}Yes</label>
								</div>
							</div><!-- comorbid_HT radio input -->
							<div class="col-md-12"><hr></div>
							
							<!-- comorbid_CAD radio input -->
							<div class='form-group col-md-8'>
								<label class="control-label col-md-4">CAD[<a title="Coronary artery disease">*</a>] :</label>
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_CAD',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_CAD',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_CAD',1) !!}Yes</label>
								</div>
								<script type="text/javascript">
									$("input[name='comorbid_CAD']").click(function(){
										($("input[name='comorbid_CAD']:checked").val() == 1) ? $('#cadCollapse').collapse('show') : $('#cadCollapse').collapse('hide');
									});
								</script>
							</div><!-- end comorbid_CAD radio input -->
							<div class='col-md-4'></div>
							<div class="collapse" id="cadCollapse" >
								<div class='form-group col-md-8'>
									{!! Form::label('cad_dx','CAD Type :',['class' => 'control-label col-md-4']) !!}

									<!-- CAD_type radio input -->
									<div class='col-md-8'>
										<div class='col-md-3'><label class="radio-inline">{!! Form::radio('CAD_type',1) !!}Old MI</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('CAD_type',2) !!}unstable angina</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('CAD_type',3) !!}stable angina</label></div>
										<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CAD_type',0) !!}others</label></div>
									</div><!-- end CAD_type radio input -->
								</div>

								<!-- CAD_other text input -->
								<div class='col-md-3 col-md-offset-1'> {!! Form::text('CAD_other',null,['class' => 'form-control', 'readonly']) !!} </div>
								<script type="text/javascript">
									function toggleCADOther(v) {
										if (v == 0) {
											$("input[name='CAD_other']").prop('readonly',false);
											$("input[name='CAD_other']").focus();
										} else {
											$("input[name='CAD_other']").prop('readonly',true);
											$("input[name='CAD_other']").val('');
										}
									}
									$("input[name='CAD_type']").each(function(i, obj) {							
									    $(this).attr('onclick',"toggleCADOther(" + $(this).val() + ")");
									});
								</script>
							</div><!-- end of cad collapse -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_VHD radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('VHD','Valvular heart disease :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_VHD',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_VHD',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_VHD',1) !!}Yes</label>
								</div>
								<script type="text/javascript">
									$("input[name='comorbid_VHD']").click(function(){
										($("input[name='comorbid_VHD']:checked").val() == 1) ? $('#vhdCollapse').collapse('show') : $('#vhdCollapse').collapse('hide');
									});
								</script>
							</div><!-- end comorbid_VHD radio input -->
							
							<!-- VHD_collapse -->
							<div class="collapse col-md-12" id="vhdCollapse" >
								<div class='row col-md-5 col-md-offset-1'>
									<!-- VHD_AS checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_AS') !!}AS</label></div>
								    <!-- VHD_AR checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_AR') !!}AR</label></div>
								    <!-- VHD_MS checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_MS') !!}MS</label></div>
								    <!-- VHD_MR checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_MR') !!}MR</label></div>
								    <!-- VHD_TR checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_TR') !!}TR</label></div>
								    <!-- </div> -->
								</div>

								<!-- text VHD_other -->
								<div class='col-md-6 form-group'>
									{!! Form::label('VHD_other','Other :',['class' => 'control-label col-md-2']) !!}
									<div class='col-md-8'> {!! Form::text('VHD_other',null,['class' => 'form-control']) !!} </div>
								</div>
							</div><!-- end of VHD_collapse -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_stroke radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('stroke','Stroke :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_stroke',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_stroke',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_stroke',1) !!}Yes</label>									
								</div>
								<script type="text/javascript">
									$("input[name='comorbid_stroke']").click(function(){
										($("input[name='comorbid_stroke']:checked").val() == 1) ? $('#strokeCollapse').collapse('show') : $('#strokeCollapse').collapse('hide');
									});
								</script>
							</div><!-- end comorbid_stroke radio input -->

							<!-- stroke_collapse -->
							<div class="collapse col-md-12" id="strokeCollapse" >
								<div class='col-md-12 col-md-offset-1'>
									<!-- stroke_ischemic checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('stroke_ischemic') !!}ischemic</label></div>
									
									<!-- stroke_ischemic_result radio input -->
									<div class='row col-md-5'>
										{!! Form::label('stroke_ischemic_result','Result :',['class' => 'control-label col-md-4']) !!}
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result',1) !!}hemiparesis</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result',2) !!}hemiplegia</label></div>
									</div>
									
									<!-- stroke_ischemic_result_on radio input -->
									<div class='row col-md-3'>
										{!! Form::label('stroke_ischemic_result_on','On :',['class' => 'control-label col-md-4']) !!}
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result_on',1) !!}left</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result_on',2) !!}right</label></div>
									</div>
								</div><!-- end stroke_ischemic -->

								<div class='col-md-12 col-md-offset-1'>
									<!-- stroke_hemorrhagic checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('stroke_hemorrhagic') !!}hemorrhagic</label></div>
									
									<!-- stroke_hemorrhagic_result radio input -->
									<div class='row col-md-5'>
										{!! Form::label('stroke_hemorrhagic_result','Result :',['class' => 'control-label col-md-4']) !!}
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result',1) !!}hemiparesis</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result',2) !!}hemiplegia</label></div>
									</div>
									
									<!-- stroke_hemorrhagic_result_on radio input -->
									<div class='row col-md-3'>
										{!! Form::label('stroke_hemorrhagic_result_on','On :',['class' => 'control-label col-md-4']) !!}
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result_on',1) !!}left</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result_on',2) !!}right</label></div>
									</div>
								</div><!-- end stroke_hemorrhagic -->

								<div class='col-md-12 col-md-offset-1'>
									<!-- stroke_iembolic checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('stroke_iembolic') !!}iembolic</label></div>
									
									<!-- stroke_iembolic_result radio input -->
									<div class='row col-md-5'>
										{!! Form::label('stroke_iembolic_result','Result :',['class' => 'control-label col-md-4']) !!}
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result',1) !!}hemiparesis</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result',2) !!}hemiplegia</label></div>
									</div>
									
									<!-- stroke_iembolic_result_on radio input -->
									<div class='row col-md-3'>
										{!! Form::label('stroke_iembolic_result_on','On :',['class' => 'control-label col-md-4']) !!}
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result_on',1) !!}left</label></div>
										<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result_on',2) !!}right</label></div>
									</div>
								</div><!-- end stroke_iembolic -->
							</div><!-- end radio stroke -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_COPD radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('comorbid_COPD','COPD :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_COPD',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_COPD',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_COPD',1) !!}Yes</label>		
								</div>
							</div><!-- end comorbid_COPD radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_asthma radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('comorbid_asthma','Asthma :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_asthma',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_asthma',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_asthma',1) !!}Yes</label>
								</div>
							</div><!-- end comorbid_asthma radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_CKD radio input -->
							<div class='form-group col-md-8'>
								<label class='control-label col-md-4'>CKD[<a title='Chronic kidney disease'>*</a>] :</label>
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_CKD',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_CKD',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_CKD',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_CKD']").click(function(){
											($("input[name='comorbid_CKD']:checked").val() == 1) ? $('#ckdCollapse').collapse('show') : $('#ckdCollapse').collapse('hide');
										});
									</script>
								</div>
							</div><!-- end comorbid_CKD radio input -->
							
							<div class="col-md-12 form-group collapse" id="ckdCollapse">
								{!! Form::label('CKD_stage','Stage :',['class' => 'col-md-2 control-label']) !!}
								<!-- CKD_stage radio input -->
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',1) !!}I</label></div>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',2) !!}II</label></div>
							    <div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',3) !!}III</label></div>
							    <div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',4) !!}IV</label></div>
							    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',5) !!}V, no dialysis</label></div>
							    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',6) !!}V, on HD</label></div>
							    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',7) !!}V, on PD</label></div>
							</div><!-- input radio CKD -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_hyperlipidemia radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('comorbid_hyperlipidemia','Hyperlipidemia :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_hyperlipidemia']").click(function(){
											($("input[name='comorbid_hyperlipidemia']:checked").val() == 1) ? $('#hyperlipidemiaCollapse').collapse('show') : $('#hyperlipidemiaCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>

							<div class="col-md-12 form-group collapse" id="hyperlipidemiaCollapse">
								<!-- hyperlipidemia_type radio input -->
								{!! Form::label('hyperlipidemia_type','Please select one :',['class' => 'col-md-2 control-label']) !!}
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',1) !!}Hypercholesterolemia</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',2) !!}Hypertriglyceridemia</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',3) !!}Mixed-hyperlipidemia</label></div>
							</div><!-- end hyperlipidemia_type radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_cirrhosis radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('cirrhosis','Cirrhosis :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_cirrhosis']").click(function(){
											($("input[name='comorbid_cirrhosis']:checked").val() == 1) ? $('#cirrhosisCollapse').collapse('show') : $('#cirrhosisCollapse').collapse('hide');
										});
									</script>
								</div>
							</div><!-- end comorbid_cirrhosis radio input -->

							<div class="collapse" id="cirrhosisCollapse">
								<div class="col-md-8 form-group">
								<label for="" class="col-md-4 control-label">Child-Pugh score[<a onclick="$('#cirrhosisCPScoreCollapse').collapse('toggle')">*</a>] :</label>
									<div class='col-md-8'>
										<!-- cp_score radio input -->
										<label class="radio-inline col-md-1">{!! Form::radio('cp_score','A') !!}A</label>
									    <label class="radio-inline col-md-1">{!! Form::radio('cp_score','B') !!}B</label>
									    <label class="radio-inline col-md-1">{!! Form::radio('cp_score','C') !!}C</label>
									</div>
								</div>
								<!-- Refferance -->
								<div class="collapse col-md-12" id="cirrhosisCPScoreCollapse">@include('cpscore')</div><div class="row col-md-offset-6"></div>
								
								<!-- cirrhosis_etiology -->
								<div class='form-group col-md-8'>
									<!-- cirrhosis_etiology_HBV -->
									{!! Form::label('cirrhosis_cp_score','Etiology :',['class' => 'control-label col-md-4']) !!}
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_HBV') !!}HBV</label></div>
									<!-- cirrhosis_etiology_HCV -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_HCV') !!}HCV</label></div>
								    <!-- cirrhosis_etiology_NASH -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_NASH') !!}NASH</label></div>
								    <!-- cirrhosis_etiology_cryptogenic -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_cryptogenic') !!}Cryptogenic</label></div>
								</div>
							    <!-- field cirrhosis_etiology_other type string -->
							    <div class='col-md-12 form-group'>
									{!! Form::label('cirrhosis_etiology_other','Other :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'> {!! Form::text('cirrhosis_etiology_other',null,['class' => 'form-control']) !!} </div>
								</div>
							</div><!-- end of cirrhosis collapse -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_coagulopathy radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('coagulopathy','Coagulopathy :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',1) !!}Yes</label>
								</div>
							</div><!-- end comorbid_coagulopathy radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_HBV radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('comorbid_HBV','HBV infection :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_HBV',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HBV',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HBV',1) !!}Yes</label>
								</div>
							</div><!-- end comorbid_HBV radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_HCV radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('comorbid_HCV','HCV infection :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_HCV',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HCV',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HCV',1) !!}Yes</label>
								</div>
							</div><!-- end comorbid_HCV radio input -->
							<div class="col-md-12"><hr></div>

							<!-- input radio comorbid_HIV -->
							<div class='form-group col-md-8'>
								{!! Form::label('HIV','HIV :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_HIV',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HIV',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HIV',1) !!}HIV infection</label>
									<label class="radio-inline">{!! Form::radio('comorbid_HIV',2) !!}AIDS</label>
									<script type="text/javascript">
										$("input[name='comorbid_HIV']").click(function(){
											($("input[name='comorbid_HIV']:checked").val() == 2) ? $('#HIVCollapse').collapse('show') : $('#HIVCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							<div class="row col-md-offset-6"></div>

							<div class="collapse" id="HIVCollapse">
								<!-- AIDS_previouse_infection radio input -->
								<div class='form-group col-md-6'>
									{!! Form::label('AIDS_previouse_infection','Previous opportunistic infection :',['class' => 'control-label col-md-6']) !!}
									<!-- AIDS_TB -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('AIDS_TB') !!}TB</label></div>
								    <!-- AIDS_PCP -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('AIDS_PCP') !!}PCP</label></div>
								    <!-- AIDS_candidiasis -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('AIDS_candidiasis') !!}Candidiasis</label></div>
								    <!-- AIDS_CMV -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('AIDS_CMV') !!}CMV</label></div>
									<script type="text/javascript">
										$("input[name='AIDS_TB']").click(function() {
											$("input[name='AIDS_TB']").prop('checked') ? $("input[name='comorbid_TB'][value='1']").prop('checked', true) : $("input[name='comorbid_TB'][value='1']").prop('checked', false); 
										});
									</script>
								</div>

								<!-- AIDS_other text input-->
								<div class='col-md-6 form-group'>
									{!! Form::label('AIDS_other','Other :',['class' => 'control-label col-md-2']) !!}
									<div class='col-md-10'> {!! Form::text('AIDS_other',null,['class' => 'form-control']) !!} </div>
								</div>
							</div>
							<div class="col-md-12"><hr></div>

							<!-- comorbid_epilepsy radio input  -->
							<div class='form-group col-md-8'>
								{!! Form::label('epilepsy','Epilepsy :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_epilepsy']").click(function(){
											($("input[name='comorbid_epilepsy']:checked").val() == 1) ? $('#epilepsyCollapse').collapse('show') : $('#epilepsyCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							<div class="col-md-12 form-group collapse" id="epilepsyCollapse">
								
								<!-- epilepsy_type radio input -->
								{!! Form::label('','Please select one :',['class' => 'col-md-2 control-label']) !!}
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('epilepsy_type',1) !!}GTC</label></div>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('epilepsy_type',2) !!}Focal</label></div>						
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('epilepsy_type',3) !!}Complex partial seizure</label></div>
								
								<!-- epilepsy_other text input -->
								<div class='col-md-4'> {!! Form::text('epilepsy_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('epilepsy_type',0) !!}Unknown</label></div>
							</div><!-- end comorbid_epilepsy radio input  -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_leukemia radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('leukemia','Leukemia :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_leukemia',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_leukemia',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_leukemia',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_leukemia']").click(function(){
											($("input[name='comorbid_leukemia']:checked").val() == 1) ? $('#leukemiaCollapse').collapse('show') : $('#leukemiaCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							<div class="row col-md-offset-6"></div>

							<div class="col-md-6 form-group collapse" id="leukemiaCollapse">
								<!-- leukemia_type radio input -->
								{!! Form::label('','Please select one :',['class' => 'col-md-4 control-label']) !!}
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('leukemia_type',1) !!}ALL</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('leukemia_type',2) !!}AML</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('leukemia_type',3) !!}CLL</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('leukemia_type',4) !!}CML</label></div>
							</div><!-- end leukemia_type radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_lymphoma radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('lymphoma','Lymphoma :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_lymphoma']").click(function(){
											($("input[name='comorbid_lymphoma']:checked").val() == 1) ? $('#lymphomaCollapse').collapse('show') : $('#lymphomaCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>

							<div class="collapse" id="lymphomaCollapse">
								<!-- lymphoma_type select input -->
								<div class='form-group col-md-8'>
									{!! Form::label('lymphoma_type','Please select one :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8 lymphoma_type_div'>
										<select class="form-control" name='lymphoma_type'>
											<option selected disabled hidden value=''></option>
											<option value="1">Hodgkin</option>
											<option value="2">Non-Hodgkin - Diffuse large B cell</option>
											<option value="3">Non-Hodgkin - Diffuse large T cell</option>
											<option value="4">Non-Hodgkin - Follicular B cell</option>
											<option value="5">Non-Hodgkin - Follicular T cell</option>
											<option value="6">Non-Hodgkin - Burkitt High grade</option>
											<option value="7">Non-Hodgkin - Burkitt Low grade</option>
											<option value="8">Non-Hodgkin - Other High grade</option>
											<option value="9">Non-Hodgkin - Other Low grade</option>
											<option value="10">Intravascular</option>
											<option value="0">Other</option>
										</select>
									</div>
									<script type="text/javascript">
										$(".lymphoma_type_div").change(function(){
											if ($("select[name='lymphoma_type']").val() == 0) {
												$('#lymphoma_type_other').prop('readonly', false);
												$('#lymphoma_type_other').focus();
											} else {
												$('#lymphoma_type_other').val('');
												$('#lymphoma_type_other').prop('readonly', true);
											}
										});
									</script>
								</div>
								<!-- lymphoma_type_other text input -->
								<div class='form-group col-md-8'>
									{!! Form::label('lymphoma_type_other','Other :',['class' => 'control-label col-md-4']) !!}
									<div class="col-md-8">{!! Form::text('lymphoma_type_other',null,['class' => 'form-control', 'placeholder' => 'Other type here' ,'id' => 'lymphoma_type_other']) !!} </div>
								</div>
							</div><!-- end comorbid_lymphoma radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_pacemaker_implant radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('pacemaker_implant','Pacemaker implant :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_pacemaker_implant']").click(function(){
											($("input[name='comorbid_pacemaker_implant']:checked").val() == 1) ? $('#pacemaker_implantCollapse').collapse('show') : $('#pacemaker_implantCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>

							<div class="collapse" id="pacemaker_implantCollapse">
								<div class='form-group col-md-8'>
									<!-- pacemaker_implant_type radio input-->
									{!! Form::label('','Please select one :',['class' => 'col-md-4 control-label']) !!}
									<div class='col-md-5'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',1) !!}DDDR (dual-chamber, rate-modulated)</label></div>
									<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',2) !!}VVI</label></div>
									<div class='col-md-1'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',0) !!}Other</label></div>
									<script type="text/javascript">
										$("input[name='pacemaker_implant_type']").click(function(){
											if ($("input[name='pacemaker_implant_type']:checked").val() == 0) {
												$('#pacemaker_implant_other').prop('readonly', false);
												$('#pacemaker_implant_other').focus();
											} else {
												$('#pacemaker_implant_other').val('');
												$('#pacemaker_implant_other').prop('readonly', true);
											}
										});
									</script>
								</div>
								<div class='form-group col-md-8'>
									{!! Form::label('lymphoma_type_other','Other :',['class' => 'control-label col-md-4']) !!}
									<!-- pacemaker_implant_other text input -->
									<div class="col-md-8">{!! Form::text('pacemaker_implant_other',null,['class' => 'form-control', 'placeholder' => 'Other type here' ,'id' => 'pacemaker_implant_other']) !!} </div>
								</div>
							</div><!-- end comorbid_pacemaker_implant radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_ICD radio input -->
							<div class='form-group col-md-8'>
								<label class="control-label col-md-4">ICD[<a title="Implantable Cardioverter Defibrillator">*</a>] :</label>								
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_ICD',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_ICD',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_ICD',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_ICD']").click(function(){
											($("input[name='comorbid_ICD']:checked").val() == 1) ? $('#ICDCollapse').collapse('show') : $('#ICDCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>

							<div class="collapse" id="ICDCollapse">
								<!-- ICD_type text input -->
								<div class='form-group col-md-8'>
									{!! Form::label('ICD_type','ICD Type :',['class' => 'control-label col-md-4']) !!}
									<div class="col-md-8">{!! Form::text('ICD_type',null,['class' => 'form-control', 'placeholder' => 'enter ICD type here']) !!} </div>
								</div>
							</div><!-- end comorbid_ICD radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_cancer radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('cancer','Cancer :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_cancer',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_cancer',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_cancer',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_cancer']").click(function(){
											($("input[name='comorbid_cancer']:checked").val() == 1) ? $('#cancerCollapse').collapse('show') : $('#cancerCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							
							<div class="collapse" id="cancerCollapse">
								<!-- cancer_organ -->
								<div class='form-group col-md-12'>
									{!! Form::label('cancer_organ','Please select organ :',['class' => 'control-label col-md-4']) !!}
									<!-- cancer_lung checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_lung') !!}Lung</label></div>
								    <!-- cancer_liver checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_liver') !!}Liver</label></div>
								    <!-- cancer_colon checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_colon') !!}Colon</label></div>
								    <!-- cancer_breast checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_breast') !!}Breast</label></div>
								    <!-- cancer_prostate checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_prostate') !!}Prostate</label></div>
								    <!-- cancer_cervix checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_cervix') !!}Cervix</label></div>
								    <!-- cancer_pancreas checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_pancreas') !!}Pancreas</label></div>
								    <!-- cancer_brain checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('cancer_brain') !!}Brain</label></div>
								</div>

								<!-- cancer_organ_other text input -->
								<div class='col-md-12 form-group'>
									{!! Form::label('cancer_organ_other','Other organ :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'> {!! Form::text('cancer_organ_other',null,['class' => 'form-control', 'placeholder' => 'Other organ type here']) !!} </div>
								</div>
							</div><!-- end comorbid_cancer radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_chronic_arthritis radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('comorbid_chronic_arthritis','Chronic arthritis :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_chronic_arthritis']").click(function(){
											($("input[name='comorbid_chronic_arthritis']:checked").val() == 1) ? $('#chronic_arthritisCollapse').collapse('show') : $('#chronic_arthritisCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							
							<div class="collapse" id="chronic_arthritisCollapse">
								<!-- chronic_arthritis_organ -->
								<div class='form-group col-md-12'>
									{!! Form::label('chronic_arthritis_organ','Please select :',['class' => 'control-label col-md-4']) !!}
									<!-- chronic_arthritis_gout -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('chronic_arthritis_gout') !!}Pancreas</label></div>
								    <!-- chronic_arthritis_CPPD -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('chronic_arthritis_CPPD') !!}CPPD[<a title="Calcium pyrophosphate dihydrate">*</a>]</label></div>
								    <!-- chronic_arthritis_rheumatoid -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_rheumatoid') !!}Rheumatoid arthritis</label></div>
								    <!-- chronic_arthritis_OA -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('chronic_arthritis_OA') !!}OA[<a title="Osteoarthritis">*</a>]</label></div>
								    <!-- chronic_arthritis_spondyloarthropathy -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_spondyloarthropathy') !!}Spondyloarthropathy</label></div>
								</div>

								<!-- chronic_arthritis_other text input -->
								<div class='col-md-12 form-group'>
									{!! Form::label('chronic_arthritis_other','Other :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'> {!! Form::text('chronic_arthritis_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
								</div>
							</div><!-- end comorbid_chronic_arthritis radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_SLE radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('SLE','SLE :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_SLE',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_SLE',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_SLE',1) !!}Yes</label>
								</div>
							</div><!-- end comorbid_SLE radio input -->
							<div class="col-md-12"><hr></div>

							<!-- input radio comorbid_other_autoimmune_disease -->
							<div class='form-group col-md-8'>
								{!! Form::label('other_autoimmune_disease','Other autoimmune disease :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_other_autoimmune_disease']").click(function(){
											($("input[name='comorbid_other_autoimmune_disease']:checked").val() == 1) ? $('#other_autoimmune_diseaseCollapse').collapse('show') : $('#other_autoimmune_diseaseCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							
							<div class="collapse" id="other_autoimmune_diseaseCollapse">
								<div class='form-group col-md-12'>
									{!! Form::label('other_autoimmune_disease_organ','Please select :',['class' => 'control-label col-md-4']) !!}
									<!-- other_autoimmune_sjrogren_syndrome -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_sjrogren_syndrome') !!}Sjrögren syndrome</label></div>
								    <!-- other_autoimmune_UCTD  Undifferentiated Connective Tissue Disease-->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_UCTD') !!}UCTD[<a title="Undifferentiated Connective Tissue Disease">*</a>]</label></div>
								    <!-- other_autoimmune_MCTD Mixed Connective Tissue Disease-->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_MCTD') !!}MCTD[<a title="Mixed Connective Tissue Disease">*</a>]</label></div>
								    <!-- other_autoimmune_DMPM DermatoMyositisPolyMyositis-->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_DMPM') !!}DMPM[<a title="Dermato Myositis Poly Myositis">*</a>]</label></div>
								</div>
								<!-- other_autoimmune_disease_other -->
								<div class='col-md-12 form-group'>
									{!! Form::label('other_autoimmune_disease_other','Other :',['class' => 'control-label col-md-4']) !!}
									<div class='col-md-8'> {!! Form::text('other_autoimmune_disease_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
								</div>
							</div><!-- end radio other_autoimmune_disease -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_TB radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('TB','TB :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_TB',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_TB',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_TB',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_TB']").click(function(){
											($("input[name='comorbid_TB']:checked").val() == 1) ? $('#TBCollapse').collapse('show') : $('#TBCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>

							<div class="collapse" id="TBCollapse">
								<div class='form-group col-md-8'>
									{!! Form::label('TB_organ','Please select :',['class' => 'control-label col-md-4']) !!}
									<!-- TB_pulmonary checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('TB_pulmonary') !!}Pulmonary</label></div>
									{!! Form::label('TB_other','Other :',['class' => 'control-label col-md-2']) !!}
									<!-- TB_other text input -->
									<div class='col-md-4'> {!! Form::text('TB_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
								</div>
							</div><!-- end comorbid_TB radio input -->
							<div class="col-md-12"><hr></div>

							<!-- comorbid_dementia radio input -->
							<div class='form-group col-md-8'>
								{!! Form::label('dementia','Dementia :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_dementia',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_dementia',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_dementia',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_dementia']").click(function(){
											($("input[name='comorbid_dementia']:checked").val() == 1) ? $('#dementiaCollapse').collapse('show') : $('#dementiaCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							<div class="collapse" id="dementiaCollapse">
								<!-- dementia_organ -->
								<div class='form-group col-md-12'>
									{!! Form::label('dementia_organ','Please select :',['class' => 'control-label col-md-4']) !!}
									<!-- dementia_vascular checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('dementia_vascular') !!}Vascular</label></div>
								    <!-- dementia_alzheimer checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('dementia_alzheimer') !!}Alzheimer</label></div>
									<!-- dementia_other text input -->								
									{!! Form::label('dementia_other','Other :',['class' => 'control-label col-md-1']) !!}
									<div class='col-md-5'> {!! Form::text('dementia_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
								</div>
							</div><!-- end comorbid_dementia radio input -->
							<div class="col-md-12"><hr></div>

							<!-- input radio comorbid_psychiatric_illness -->
							<div class='form-group col-md-8'>
								{!! Form::label('psychiatric_illness','Psychiatric illness :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',-1) !!}No data</label>
									<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',0) !!}No</label>
									<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',1) !!}Yes</label>
									<script type="text/javascript">
										$("input[name='comorbid_psychiatric_illness']").click(function(){
											($("input[name='comorbid_psychiatric_illness']:checked").val() == 1) ? $('#psychiatric_illnessCollapse').collapse('show') : $('#psychiatric_illnessCollapse').collapse('hide');
										});
									</script>
								</div>
							</div>
							<div class="collapse" id="psychiatric_illnessCollapse">
								<div class='form-group col-md-12'>
									{!! Form::label('psychiatric_illness_organ','Please select :',['class' => 'control-label col-md-2']) !!}
									<!-- psychiatric_illness_schizophrenia checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_schizophrenia') !!}Schizophrenia</label></div>
								    <!-- psychiatric_illness_major_depression checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_major_depression') !!}Major depression</label></div>
								    <!-- psychiatric_illness_bipolar_disorder checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_bipolar_disorder') !!}Bipolar disorder</label></div>
								    <!-- psychiatric_illness_adjustment_disorder checkbox input -->
									<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_adjustment_disorder') !!}Adjustment disorder</label></div>
								    <!-- psychiatric_illness_Obcessive_compulsive_disorder checkbox input -->
									<div class="checkbox col-md-1"><label>{!! Form::checkbox('psychiatric_illness_Obcessive_compulsive_disorder') !!}OCD[<a title="Obcessive compulsive disorder">*</a>]</label></div>
								</div>
								<!-- psychiatric_illness_other text input -->
								<div class='col-md-12 form-group'>
									{!! Form::label('psychiatric_illness_other','Other :',['class' => 'control-label col-md-2']) !!}
									<div class='col-md-8'> {!! Form::text('psychiatric_illness_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
								</div>
							</div><!-- end radio psychiatric_illness -->
							<div class="col-md-12"><hr></div>

							<!-- other_comorbid -->
							<div class='col-md-8 form-group'>
								{!! Form::label('other_comorbid','Other co-morbid :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'> {!! Form::text('other_comorbid',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
							</div>
			            </div><!-- end collapse Comorbid list -->
					

			            <div class="col-md-12"><hr></div>
			            <!-- textarea history_illness_present -->
						<div class='form-group col-md-12'>
							{!! Form::label('history_illness_present','History of present illness :',['class' => 'control-label']) !!}
							{!! Form::textarea('history_illness_present1',null,['class' => 'form-control', 'rows' => '1']) !!}
						</div>

						<!-- textarea history_illness_past -->
						<div class='form-group col-md-12'>
							{!! Form::label('history_illness_past','History of past illness :',['class' => 'control-label']) !!}
							{!! Form::textarea('history_illness_past1',null,['class' => 'form-control', 'rows' => '1']) !!}
						</div>
					</div>
				</div><!-- end panel co-morbid -->

				<!-- panel Personal and Social history -->
				<div class="panel panel-info">
					<div class="panel-heading">Personal and Social history</div>
					<div class="panel-body">
						<div class="form-horizontal row">
							<!-- for women section collapse -->
							<div class="collapse in">
								<!-- pregnant radio input -->
								<div class="col-md-6 form-group">
									{!! Form::label('','Pregnant :',['class' => 'col-md-4 control-label']) !!}
									<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pregnant',-1) !!}Uncertain</label></div>
									<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pregnant',0) !!}No</label></div>
									<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pregnant',1) !!}Yes</label></div>
								</div>

								<!-- pregnant_weeks number input -->
								<div class="form-group col-md-6">
									{!! Form::label('','Gastation :',['class' => 'col-md-4 control-label']) !!}
									<div class='col-md-8'><div class='input-group'>{!! Form::input('number','pregnant_weeks',null,['class' => 'form-control']) !!}<span class="input-group-addon">Weeks</span></div></div>
								</div>

								<!-- LMP text input -->
								<div class="form-group col-md-6">
									{!! Form::label('','LMP :',['class' => 'col-md-4 control-label']) !!}
									<div class='col-md-8'>{!! Form::text('LMP',null,['class' => 'form-control']) !!}</div>
								</div>
							</div>
							<div class="row col-md-offset-6"></div>

							<!-- alcohol -->
							<div class="col-md-6 form-group">
								{!! Form::label('alcohol','Alcohol :',['class' => 'col-md-4 control-label']) !!}
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('alcohol',0) !!}No</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('alcohol',2) !!}Yes</label></div>
								<div class='col-md-3'><label class="radio-inline">{!! Form::radio('alcohol',1) !!}Ex-drinker</label></div>
								<script type="text/javascript">
									function toggleAlcoholTemplate(alcoholOption) {
										if (alcoholOption == 0) {
											$("#taalcoholAmountReviewDetail").val('');
											$("#taalcoholAmountReviewDetail").prop('readonly',true);
											$('#alcoholHelperTemplate').collapse('hide');
										} else {
											$('#alcoholHelperTemplate').collapse('show');
											$("#taalcoholAmountReviewDetail").prop('readonly',false);
										}
									}
									$("input[name='alcohol']").each(function(i, obj) {							
									    $(this).attr('onclick',"toggleAlcoholTemplate(" + $(this).val() + ")");
									});
								</script>						    
							</div>

							<div class="collapse col-md-12" id="alcoholHelperTemplate">@include('medicine.note.admission.template.alcohol')</div>
							
							<!-- alcohol_amount -->
							<div class="form-group col-md-6">
								{!! Form::label('','Drink amount :',['class' => 'col-md-4 control-label']) !!}
								<div class='col-md-8'>
									{!! Form::textarea('alcohol_amount',null,['class' => 'form-control', 'id' => 'taalcoholAmountReviewDetail', 'rows' => '1', 'readonly']) !!}
								</div>
							</div><!-- end alcohol -->

							<!-- smoking -->
							<div class="col-md-6 form-group">
								{!! Form::label('smoking','Cigarette smoking :',['class' => 'col-md-4 control-label']) !!}
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('smoking',0) !!}No</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('smoking',2) !!}Yes</label></div>
								<div class='col-md-3'><label class="radio-inline">{!! Form::radio('smoking',1) !!}Ex-smoker</label></div>
								<script type="text/javascript">
									function togglesmokingTemplate(v) {
										if (v == 0) {
											$("#tasmokingAmountReviewDetail").val('');
											$("#tasmokingAmountReviewDetail").prop('readonly',true);
											$('#smokingHelperTemplate').collapse('hide');
										} else {
											$('#smokingHelperTemplate').collapse('show');
											$("#tasmokingAmountReviewDetail").prop('readonly',false);
										}
									}
									$("input[name='smoking']").each(function(i, obj) {							
									    $(this).attr('onclick',"togglesmokingTemplate(" + $(this).val() + ")");
									});
								</script>						    
							</div>

							<div class="collapse col-md-12" id="smokingHelperTemplate">@include('medicine.note.admission.template.smoking')</div>
							
							<!-- smoking_amount -->
							<div class="form-group col-md-6">
								{!! Form::label('','Smoke amount :',['class' => 'col-md-4 control-label']) !!}
								<div class='col-md-8'>
									{!! Form::textarea('smoking_amount',null,['class' => 'form-control', 'id' => 'tasmokingAmountReviewDetail', 'rows' => '1', 'readonly']) !!}
								</div>
							</div><!-- end smoking -->
						</div><!-- end Personal and Social history row part-->
						<!-- textarea personal_social -->
						<div class='form-group'>
							{!! Form::label('personal_social','Personal and social history :',['class' => 'control-label']) !!}
							{!! Form::textarea('personal_social',null,['class' => 'form-control', 'rows' => '1']) !!}
						</div><!-- end textarea personal_social -->
					</div>
				</div><!-- panel Personal and Social history -->

				<!-- panel special_requirement -->
				<div class="panel panel-info">
					<div class="panel-heading">Special requirement</div>
					<div class="panel-body">
						<div class="form-horizontal row col-md-12">
							<!-- <div class="col-md-12 row"> -->
							<!-- special_requirement_ng_tube -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_ng_tube'>NG tube
						        </label>
						    </div>
						    <!-- special_requirement_ng_suction -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_ng_suction'>NG suction
						        </label>
						    </div>

						    <!-- special_requirement_gastrostomy -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_embolic'>Gastrostomy feeding
						        </label>
						    </div>
						    <!-- special_requirement_urinary_cath -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_hemorrhagic'>Urinary cath. care
						        </label>
						    </div>
						    <!-- special_requirement_tracheostomy -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_hemorrhagic'>Tracheostomy care
						        </label>
						    </div>
						    <!-- special_requirement_hearing -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_hemorrhagic'>Hearing impaiment
						        </label>
						    </div>
						    <!-- special_requirement_isolate_room -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='special_requirement_hemorrhagic'>Isolation room
						        </label>
							</div>
							<!-- </div> -->
						</div><!-- end check special_requirement -->
						<!-- textarea personal_social_other -->
							<div class="col-md-12"><br/></div>
							<div class='form-group'>
								{!! Form::label('personal_social_other','Other special requirement :',['class' => 'control-label']) !!}
								{!! Form::textarea('personal_social_other',null,['class' => 'form-control', 'rows' => '1']) !!}
							</div><!-- end textarea personal_social_other -->
					</div>
				</div><!-- end panel special_requirement -->

				<!-- panel family history -->
				<div class="panel panel-info">
					<div class="panel-heading">Family history</div>
					<div class="panel-body">
						<!-- personal_family_history textarea intpu -->
						{!! Form::textarea('personal_family_history',null,['class' => 'form-control','rows' => '1']) !!}
					</div>
				</div><!-- end panel family history -->

				<!-- panel Current medications  -->
				<div class="panel panel-info">
					<div class="panel-heading">Current medications </div>
					<div class="panel-body">
						<!-- current_medications textarea intpu -->
						<div class='well'>
							<div class='form-group col-md-6'>
								{!! Form::text('current_medications_suggest',null,['class' => 'form-control ui-widget', 'placeholder' => 'type to auto-complete', 'id' => 'current_medications_suggest']) !!}
							</div>
							<button type="button" class="btn btn-primary tools" id="addmed">Add</button>
						</div>
						{!! Form::textarea('current_medications',null,['class' => 'form-control','rows' => '1','id' => 'current_medications']) !!}
						<script type="text/javascript">
							
							// $(function() {
							//     var drugs = ['para','penisolone'];
							//     $( "#current_medications" ).autocomplete({
							//     	source: drugs,
							//     	minLength: 2
							// 	});
							// });

							$(document).ready(function() {
								$.ajax({
									type: "GET",
									url: "{{ url('/assets/csv/drugList.txt') }}",
									dataType: "text",
									success: function(data) {processData(data);}
								});
							});
							var durgs =[];
							function processData(myTxt) {
								//console.log(myTxt);
								//var myLines = myTxt.split(/\r\n|\n/);
								var myLines = myTxt.split('\r');
								//console.log('bf loop');
								for (var i=1; i<myLines.length; i++) {
									durgs.push(myLines[i]);
									//console.log(myLines[i]);
								}

								//console.log(durgs);
								
								// $( "#current_medications_suggest" ).autocomplete({
								// 	minLength: 2,
								// 	source: drugs
								// });
							}
							$( "#current_medications_suggest" ).autocomplete({
						    	source: durgs,
						    	minLength: 2,
						    	select: function(event, ui) {
									event.preventDefault();
									$(this).val(ui.item.label);
									var str1 = $("#current_medications").val();
									if (str1 != '')
										$("#current_medications").val(str1 + '\n' + $(this).val());
									else										
										$("#current_medications").val($(this).val());
									$(this).val('');
									autosize.update($('#current_medications'));
								}
							});
							$('#addmed').click(function() {
								var str1 = $("#current_medications").val();
								if (str1 != '')
									$("#current_medications").val(str1 + '\n' + $('#current_medications_suggest').val());
								else										
									$("#current_medications").val($('#current_medications_suggest').val());
								$('#current_medications_suggest').val('');
								autosize.update($('#current_medications'));
								$('#current_medications_suggest').focus();
							});
						</script>
					</div>

				</div><!-- end panel Current medications  -->

				<!-- panel allergy  -->
				<div class="panel panel-info">
					<div class="panel-heading">Allergy/Adverse event (Drug, Food, Chemical)</div>
					<div class="panel-body">
						<!-- allergy textarea intpu -->
						{!! Form::textarea('allergy',null,['class' => 'form-control','rows' => '1']) !!}
					</div>
				</div><!-- end panel allergy  -->

				<!-- Review of systems -->
				<div class="panel panel-info">
					<div class="panel-heading">Review of systems</div>
					<div class="panel-body">
						<!-- general_symtoms textarea input -->
						<div class='form-group'>
							<label class="control-label" for="general_symtoms">General symtoms : Detail of important findings [<a onclick="toggleTemplate('#gsgCollapse')">Template</a>]</label>
							<!-- 
							<script type="text/javascript" src="{{ url('/assets/script/wordplease-form-0.1.js') }}">
							</script>
							 -->
							 
							<div class="collapse col-md-12" id="gsgCollapse">@include('medicine.note.admission.template.review.generalSymtomsGenerator')</div>
							{!! Form::textarea('general_symtoms',null,['class' => 'form-control', 'id' => 'tagsg','rows' => '1']) !!}
						</div>
						<div><hr></div>

						<!-- hair_skin_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Hair and Skin [<a onclick="$('#hair').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('hair_skin_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('hair_skin_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="hair_skin_review_detail">[<a onclick="toggleTemplate('#hairSkinReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- hair_skin_review_detail textarea input  -->
						<div class='collapse in form-group' id="hair">					
							<div class="collapse col-md-12" id="hairSkinReviewGenCollapse">@include('medicine.note.admission.template.review.hairSkinReviewGenerator')</div>
							{!! Form::textarea('hair_skin_review_detail',null,['class' => 'form-control', 'id' => 'tahairSkinReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div>

						<!-- head_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Head [<a onclick="$('#headReview').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('head_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('head_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="head_review_detail">[<a onclick="toggleTemplate('#hrgCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- head_review_detail textarea input  -->
						<div class='collapse in form-group' id="headReview">					
							<div class="collapse col-md-12" id="hrgCollapse">@include('medicine.note.admission.template.review.headReviewGenerator')</div>
							{!! Form::textarea('head_review_detail',null,['class' => 'form-control', 'id' => 'tahrg','rows' => '1']) !!}
						</div>
						<div><hr></div>

						<!-- eye_ent_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Eye/ENT [<a onclick="$('#eyeENT').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('eye_ent_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('eye_ent_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="eye_ent_review_detail">[<a onclick="toggleTemplate('#eyeENTReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- eye_ent_review_detail textarea input  -->
						<div class='collapse in form-group' id="eyeENT">					
							<div class="collapse col-md-12" id="eyeENTReviewGenCollapse">@include('medicine.note.admission.template.review.eyeENTReviewGenerator')</div>
							{!! Form::textarea('eye_ent_review_detail',null,['class' => 'form-control', 'id' => 'taeyeENTReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div>

						<!-- breast_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Breast [<a onclick="$('#breast').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('breast_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('breast_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="breast_review_detail">[<a onclick="toggleTemplate('#breastReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- breast_review_detail textarea input  -->
						<div class='collapse in form-group' id="breast">					
							<div class="collapse col-md-12" id="breastReviewGenCollapse">@include('medicine.note.admission.template.review.breastReviewGenerator')</div>
							{!! Form::textarea('breast_review_detail',null,['class' => 'form-control', 'id' => 'tabreastReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end breast_review -->

						<!-- cvs_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">CVS [<a onclick="$('#cvs').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('cvs_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('cvs_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="cvs_review_detail">[<a onclick="toggleTemplate('#cvsReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- cvs_review_detail textarea input  -->
						<div class='collapse in form-group' id="cvs">					
							<div class="collapse col-md-12" id="cvsReviewGenCollapse">@include('medicine.note.admission.template.review.cvsReviewGenerator')</div>
							{!! Form::textarea('cvs_review_detail',null,['class' => 'form-control', 'id' => 'tacvsReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end cvs_review -->

						<!-- rs_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">RS [<a onclick="$('#rs').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('rs_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('rs_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="rs_review_detail">[<a onclick="toggleTemplate('#rsReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- rs_review_detail textarea input  -->
						<div class='collapse in form-group' id="rs">					
							<div class="collapse col-md-12" id="rsReviewGenCollapse">@include('medicine.note.admission.template.review.rsReviewGenerator')</div>
							{!! Form::textarea('rs_review_detail',null,['class' => 'form-control', 'id' => 'tarsReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end rs_review -->

						<!-- gi_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">GI [<a onclick="$('#gi').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('gi_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('gi_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="gi_review_detail">[<a onclick="toggleTemplate('#giReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- gi_review_detail textarea input  -->
						<div class='collapse in form-group' id="gi">					
							<div class="collapse col-md-12" id="giReviewGenCollapse">@include('medicine.note.admission.template.review.giReviewGenerator')</div>
							{!! Form::textarea('gi_review_detail',null,['class' => 'form-control', 'id' => 'tagiReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end gi_review -->

						<!-- gu_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">GU [<a onclick="$('#gu').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('gu_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('gu_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="gu_review_detail">[<a onclick="toggleTemplate('#guReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- gu_review_detail textarea input  -->
						<div class='collapse in form-group' id="gu">					
							<div class="collapse col-md-12" id="guReviewGenCollapse">@include('medicine.note.admission.template.review.guReviewGenerator')</div>
							{!! Form::textarea('gu_review_detail',null,['class' => 'form-control', 'id' => 'taguReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end gu_review -->

						<!-- musculoskeletal_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Musculoskeletal system [<a onclick="$('#musculoskeletal').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('musculoskeletal_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('musculoskeletal_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="musculoskeletal_review_detail">[<a onclick="toggleTemplate('#musculoskeletalReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- musculoskeletal_review_detail textarea input  -->
						<div class='collapse in form-group' id="musculoskeletal">					
							<div class="collapse col-md-12" id="musculoskeletalReviewGenCollapse">@include('medicine.note.admission.template.review.musculoskeletalReviewGenerator')</div>
							{!! Form::textarea('musculoskeletal_review_detail',null,['class' => 'form-control', 'id' => 'tamusculoskeletalReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end musculoskeletal_review -->

						<!-- nervous_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Nervous system [<a onclick="$('#nervous').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('nervous_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('nervous_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="nervous_review_detail">[<a onclick="toggleTemplate('#nervousReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- nervous_review_detail textarea input  -->
						<div class='collapse in form-group' id="nervous">					
							<div class="collapse col-md-12" id="nervousReviewGenCollapse">@include('medicine.note.admission.template.review.nervousReviewGenerator')</div>
							{!! Form::textarea('nervous_review_detail',null,['class' => 'form-control', 'id' => 'tanervousReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end nervous_review -->

						<!-- psychological_review raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">psychological symptom [<a onclick="$('#psychological').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('psychological_review',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('psychological_review',0) !!}Abnormal</label></div>
								<label class="control-label" for="psychological_review_detail">[<a onclick="toggleTemplate('#psychologicalReviewGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- psychological_review_detail textarea input  -->
						<div class='collapse in form-group' id="psychological">					
							<div class="collapse col-md-12" id="psychologicalReviewGenCollapse">@include('medicine.note.admission.template.review.psychologicalReviewGenerator')</div>
							{!! Form::textarea('psychological_review_detail',null,['class' => 'form-control', 'id' => 'tapsychologicalReviewDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end psychological_review -->

						<!-- textarea system_review_other -->
						<div class='form-group'>
							{!! Form::label('system_review_other','Other :',['class' => 'control-label']) !!}
							{!! Form::textarea('system_review_other','',['class' => 'form-control','rows' => '1']) !!}
						</div><!-- end textarea system_review_other -->
					</div>
				</div>
			</div>
		</div>
	</div><!-- end history panel -->

	<!-- investigation panel -->
	<div class="panel panel-primary	">
		<div class="panel-heading" role="tab" id="headingThree">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				Physical examination and investigation
				</a>
			</h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			<div class="panel-body">
				<!-- panel vital sign -->
				<div class="panel panel-info">
					<div class="panel-heading">Vital signs</div>
					<div class="panel-body">
						<div class="form-horizontal row"><!-- Preliminary form -->
							<!-- row 1 temperature pulse respiratory_rate -->
							<!-- blid temperature -->
							<div class='col-md-6 form-group'>
								{!! Form::label('temperature','Temperature :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('temperature',null,['class' => 'form-control']) !!}<span class="input-group-addon">&deg;C</span>
									</div>
								</div>
							</div>
							<!-- pulse -->
							<div class='col-md-6 form-group'>
								{!! Form::label('pulse','Pulse :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('pulse',null,['class' => 'form-control']) !!}<span class="input-group-addon">/min</span>
									</div>
								</div>
							</div>
							<!-- respiratory_rate -->
							<div class='col-md-6 form-group'>
								{!! Form::label('respiratory_rate','Respiratory rate :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('respiratory_rate',null,['class' => 'form-control']) !!}<span class="input-group-addon">/min</span>
									</div>
								</div>
							</div><!-- end row 1 temperature pulse respiratory_rate-->

							<!-- row 2 SBP DBP -->
							<!-- SBP -->
							<div class='col-md-4 form-group'>
								{!! Form::label('SBP','SBP :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('SBP',null,['class' => 'form-control']) !!}<span class="input-group-addon">mmHg</span>
									</div>
								</div>
							</div>
							<!-- DBP -->
							<div class='col-md-4 form-group'>
								{!! Form::label('DBP','DBP :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('DBP',null,['class' => 'form-control']) !!}<span class="input-group-addon">mmHg</span>
									</div>
								</div>
							</div>
							<div class="row col-md-offset-4"></div><!-- end of row 2 SBP DBP -->

							<!-- row 1 height weight BMI -->
							<!-- blid height -->
							<div class='col-md-4 form-group'>
								{!! Form::label('height','Height :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('height',null,['class' => 'form-control']) !!}<span class="input-group-addon">cm.</span>
									</div>
								</div>
							</div>
							<!-- weight -->
							<div class='col-md-4 form-group'>
								{!! Form::label('weight','Weight :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('weight',null,['class' => 'form-control']) !!}<span class="input-group-addon">kg.</span>
									</div>
								</div>
							</div>
							<!-- BMI -->
							<div class='col-md-4 form-group'>
								{!! Form::label('BMI','BMI :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('BMI',null,['class' => 'form-control']) !!}<span class="input-group-addon">kg/m<sup>2</sup></span>
									</div>
								</div>
							</div><!-- end of BMI-->

							<!-- spo2 -->
							<div class='col-md-4 form-group'>
								<label class="control-label col-md-6">SpO<sub>2</sub> :</label>
								<!-- {!! Form::label('spo2','SpO :',['class' => 'control-label col-md-6']) !!} -->
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('spo2',null,['class' => 'form-control']) !!}<span class="input-group-addon" title="as indicated">%</span>
									</div>
								</div>
							</div>
							<div class="row col-md-offset-8"></div>

							<!-- breathing -->
							<div class='col-md-4 form-group'>
								{!! Form::label('breathing','Breathing :',['class' => 'control-label col-md-6']) !!}
								<div class='col-md-6'>
									<label class="radio-inline">
								    	<input type="radio" name="HT" value="0">Room
								    </label>
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="1">O<sub>2</sub>
								    </label>

								</div>
							</div>
							<div class="row col-md-offset-8"></div><!-- end breathing-->
							<!-- breathing_on -->
							<div class='col-md-6 form-group'>
								{!! Form::label('breathing_on','Breathing on :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-8'>
									<label class="radio-inline">{!! Form::radio('breathing_on',1) !!}Canula</label>
								    <label class="radio-inline">{!! Form::radio('breathing_on',2) !!}Mask with bag</label>
								    <label class="radio-inline">{!! Form::radio('breathing_on',3) !!}On ventilator</label>
								</div>
								<script type="text/javascript">
									function oxyUnit(v) {
										if (v > 2) {
											$("#o2unit").text('FiO2');
										} else {
											$("#o2unit").text('L/min');
										}
									}
									$("input[name='breathing_on']").each(function(i, obj) {							
									    $(this).attr('onclick',"oxyUnit(" + $(this).val() + ")");
									});
								</script>		
							</div>
							<!-- o2_rate -->
							<div class='col-md-4 form-group'>
								<label class="control-label col-md-3">O<sub>2</sub> rate :</label>
								<!-- {!! Form::label('o2_rate','SpO :',['class' => 'control-label col-md-6']) !!} -->
								<div class='col-md-6'>
									<div class='input-group'>
										{!! Form::number('o2_rate',null,['class' => 'form-control']) !!}<span class="input-group-addon" id='o2unit'></span>
									</div>
								</div>
							</div><!-- end of breathing -->

							<!-- conscious_level -->
							<div class='col-md-12 form-group'>
								{!! Form::label('conscious_level','Level of consciousness :',['class' => 'control-label col-md-2']) !!}
								<!-- <div class='col-md-9'> -->
									<div class="col-md-1">
									<label class="radio-inline">
								    	<input type="radio" name="HT" value="4">Appropriate
								    </label>
								    </div>
								    <div class="col-md-1">
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="3">Retardation
								    </label>
								    </div>
								    <div class="col-md-1">
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="2">Depressed
								    </label>
								    </div>
								    <div class="col-md-1">
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="1">Psychotic
								    </label>
								    </div>
								<!-- </div> -->
							</div><!-- end of conscious_level -->

							<!-- Glassglow comma score -->
							<div class='col-md-12 form-group'>
								<label class='control-label col-md-2'>GCS[<a title='Glassglow comma score'>*</a>] :</label>								
								<div class='col-md-3'>
									{!! Form::label('glassglow_score_E','E:',['class' => 'control-label col-md-2']) !!}
					                <div class='col-md-10'>
					                    <select class="form-control" name='glassglow_score_E' onchange='setGCS();'>
					                        <option selected disabled hidden value=''></option>
					                        <option value="1">No eye opening , ไม่ลืมตา</option>
					                        <option value="2">Eye open to pressure/pain</option>
					                        <option value="3">Eye open to sound</option>
					                        <option value="4">Spontaneous eye opening</option>
					                    </select>
					                </div>
				                </div>

				                <div class='col-md-3'>
									{!! Form::label('glassglow_score_V','V:',['class' => 'control-label col-md-2']) !!}
					                <div class='col-md-10'>
					                    <select class="form-control" name='glassglow_score_V' onchange='setGCS();'>
					                        <option selected disabled hidden value=''></option>
					                        <option value="1">Not response to pain, ไม่ส่งเสียง</option>
					                        <option value="2">Incomprehensible sounds ส่งเสียงไม่เป็นคา</option>
					                        <option value="3">Inappropriate words พูดคาไม่มีความหมาย</option>
					                        <option value="4">Disoriented / confused สับสน</option>
					                        <option value="5">Oriented พูดรู้เรื่อง</option>
					                    </select>
					                </div>
				                </div>

				                <div class='col-md-3'>
									{!! Form::label('glassglow_score_M','M:',['class' => 'control-label col-md-2']) !!}
					                <div class='col-md-10'>
					                    <select class="form-control" name='glassglow_score_M' onchange='setGCS();'>
					                        <option selected disabled hidden value=''></option>
					                        <option value="1">Not response to pain, ไม่เคลื่อนไหว</option>
					                        <option value="2">Decerebrates</option>
					                        <option value="3">Decorticates</option>
					                        <option value="4">Semi-purposeful ตอนสนองต่อ pain ระบุตาแหน่งไม่ได้</option>
					                        <option value="5">Localizes pain ตอบสนองต่อ pain ระบุตาแหน่งได้</option>
					                        <option value="6">Obey ท าตาม สั่งไ ด้</option>
					                    </select>
					                </div>
				                </div>

				                <div class='col-md-1'>
				                	{!! Form::number('glassglow_score_tot',null,['class' => 'form-control', 'readonly', 'id' => 'glassglow_score_tot']) !!}
								</div>

								<script type="text/javascript">
									function setGCS() {
										var E = ($("select[name='glassglow_score_E']").val() != null) ? $("select[name='glassglow_score_E']").val() : 0 ;
										var V = ($("select[name='glassglow_score_V']").val() != null) ? $("select[name='glassglow_score_V']").val() : 0 ;
										var M = ($("select[name='glassglow_score_M']").val() != null) ? $("select[name='glassglow_score_M']").val() : 0 ;
										var gcs = parseInt(E) + parseInt(V) + parseInt(M);
										$('#glassglow_score_tot').val(gcs);
										if (gcs < 9)
											$('#glassglow_score_tot').prop('title','Severe');	
											else
												if (gcs < 13)
													$('#glassglow_score_tot').prop('title','Moderate');
													else
														$('#glassglow_score_tot').prop('title','Minor');
										
									}
								</script>
							</div> <!-- end of Glassglow comma score -->

							<!-- mental_evaluate -->
							<div class='col-md-12 form-group'>
								{!! Form::label('mental_evaluate','Mental evaluation :',['class' => 'control-label col-md-2']) !!}
								<!-- <div class='col-md-9'> -->
									<div class="col-md-1">
									<label class="radio-inline">
								    	<input type="radio" name="HT" value="4">Awake
								    </label>
								    </div>
								    <div class="col-md-1">
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="3">Drowsy
								    </label>
								    </div>
								    <div class="col-md-1">
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="2">Stuporous
								    </label>
								    </div>
								    <div class="col-md-1">
								    <label class="radio-inline">
								    	<input type="radio" name="HT" value="1">Unconscious
								    </label>
								    </div>
								<!-- </div> -->
							</div><!-- end of mental_evaluate -->
						</div>
					</div>
				</div><!-- end panel vital sign -->

				<!-- panel physical exam -->
				<div class="panel panel-info">
					<div class="panel-heading">Physical examination</div>
					<div class="panel-body">

						<!-- general_appearance textarea input -->
						<div class='form-group'>
							<label class="control-label" for="general_appearance">General appearance [<a onclick="toggleTemplate('#gagCollapse')">Template</a>]</label>
							<div class="collapse col-md-12" id="gagCollapse">@include('medicine.note.admission.template.exam.generalAppearanceGenerator')</div>
							{!! Form::textarea('general_appearance',null,['class' => 'form-control', 'id' => 'tagag','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end of general_appearance textarea input -->

						<!-- skin_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Skin [<a onclick="$('#skin_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('skin_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('skin_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="skin_exam_detail">[<a onclick="toggleTemplate('#skinExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- skin_exam_detail textarea input  -->
						<div class='collapse in form-group' id="skin_exam">					
							<div class="collapse col-md-12" id="skinExamGenCollapse">@include('medicine.note.admission.template.exam.skinExamGenerator')</div>
							{!! Form::textarea('skin_exam_detail',null,['class' => 'form-control', 'id' => 'taskinExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end skin_exam -->

						<!-- head_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Head [<a onclick="$('#head_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('head_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('head_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="head_exam_detail">[<a onclick="toggleTemplate('#headExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- head_exam_detail textarea input  -->
						<div class='collapse in form-group' id="head_exam">					
							<div class="collapse col-md-12" id="headExamGenCollapse">@include('medicine.note.admission.template.exam.headExamGenerator')</div>
							{!! Form::textarea('head_exam_detail',null,['class' => 'form-control', 'id' => 'taheadExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end head_exam -->

						<!-- eyeENT_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Eye/ENT [<a onclick="$('#eyeENT_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('eyeENT_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('eyeENT_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="eyeENT_exam_detail">[<a onclick="toggleTemplate('#eyeENTExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- eyeENT_exam_detail textarea input  -->
						<div class='collapse in form-group' id="eyeENT_exam">					
							<div class="collapse col-md-12" id="eyeENTExamGenCollapse">@include('medicine.note.admission.template.exam.eyeENTExamGenerator')</div>
							{!! Form::textarea('eyeENT_exam_detail',null,['class' => 'form-control', 'id' => 'taeyeENTExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end eyeENT_exam -->

						<!-- neck_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Neck [<a onclick="$('#neck_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('neck_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('neck_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="neck_exam_detail">[<a onclick="toggleTemplate('#neckExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- neck_exam_detail textarea input  -->
						<div class='collapse in form-group' id="neck_exam">					
							<div class="collapse col-md-12" id="neckExamGenCollapse">@include('medicine.note.admission.template.exam.neckExamGenerator')</div>
							{!! Form::textarea('neck_exam_detail',null,['class' => 'form-control', 'id' => 'taneckExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end neck_exam -->

						<!-- heart_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Heart [<a onclick="$('#heart_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('heart_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('heart_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="heart_exam_detail">[<a onclick="toggleTemplate('#heartExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- heart_exam_detail textarea input  -->
						<div class='collapse in form-group' id="heart_exam">					
							<div class="collapse col-md-12" id="heartExamGenCollapse">@include('medicine.note.admission.template.exam.heartExamGenerator')</div>
							{!! Form::textarea('heart_exam_detail',null,['class' => 'form-control', 'id' => 'taheartExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end heart_exam -->

						<!-- lung_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Lung [<a onclick="$('#lung_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('lung_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('lung_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="lung_exam_detail">[<a onclick="toggleTemplate('#lungExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- lung_exam_detail textarea input  -->
						<div class='collapse in form-group' id="lung_exam">					
							<div class="collapse col-md-12" id="lungExamGenCollapse">@include('medicine.note.admission.template.exam.lungExamGenerator')</div>
							{!! Form::textarea('lung_exam_detail',null,['class' => 'form-control', 'id' => 'talungExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end lung_exam -->

						<!-- abdomen_exam raido input -->
						<div class="form-horizontal row">
							<div class="col-md-12 form-group">
								<label class="col-md-3 control-label">Abdomen [<a onclick="$('#abdomen_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
								<div class='col-md-1'><label class="radio-inline">{!! Form::radio('abdomen_exam',1) !!}Normal</label></div>
								<div class='col-md-2'><label class="radio-inline">{!! Form::radio('abdomen_exam',0) !!}Abnormal</label></div>
								<label class="control-label" for="abdomen_exam_detail">[<a onclick="toggleTemplate('#abdomenExamGenCollapse')">Template</a>]</label>
							</div>
						</div>

						<!-- abdomen_exam_detail textarea input  -->
						<div class='collapse in form-group' id="abdomen_exam">					
							<div class="collapse col-md-12" id="abdomenExamGenCollapse">@include('medicine.note.admission.template.exam.abdomenExamGenerator')</div>
							{!! Form::textarea('abdomen_exam_detail',null,['class' => 'form-control', 'id' => 'taabdomenExamDetail','rows' => '1']) !!}
						</div>
						<div><hr></div><!-- end abdomen_exam -->

						

					</div>
				</div><!-- end panel physical exam -->

				<div class="form-group col-md-12"><hr/></div>
				<!-- sensetion -->
				<div class="form-group col-md-12"><h3>Sensation</h3></div>
				<!-- sensetion -->
				<iframe src="{{ url('/canvas') }}" frameborder="0" scrolling="no" id="iframe" onload='javascript:resizeIframe(this);'></iframe>
				
			</div>

		</div>
	</div><!-- end investigation panel -->

	<!-- template -->


	<!-- <div class="panel panel-default	">
		<div class="panel-heading" role="tab" id="headingFour">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				Description template example
				</a>
			</h4>
		</div>
		<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
			<div class="panel-body">
				<h3>Under construction</h3>
 -->
				<!-- <iframe src="{{ url('/canvas') }}" class="col-md-12" height="100%" style="height:100%"></iframe> -->
				<!-- <iframe src="{{ url('/canvas') }}" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;top:0px;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe> -->


					<!-- <iframe src="{{ url('/canvas') }}" frameborder="0" scrolling="no" id="iframe" onload='javascript:resizeIframe(this);'></iframe> -->
					<!-- <iframe name="Stack" src="http://stackoverflow.com/" frameborder="0" scrolling="no" id="iframe" onload='javascript:resizeIframe(this);' /> -->
<!-- 	
				<div class="col-md-12"><hr/></div>
			</div>
		</div>
	</div>
 -->

 <!-- Part Note -->
<div class="panel panel-primary">
	<div class="panel-heading">Note</div> 
	<div class="panel-body">
		<!-- textarea note -->
		{!! Form::textarea('general_appearance',null,['class' => 'form-control', 'id' => 'tagag','rows' => '1']) !!}
		{!! Form::textarea('general_appearance',null,['class' => 'form-control', 'rows' => '1', 'title' => 'hello title']) !!}
	</div>
</div>


</div><!-- end main panel group -->

<div class="col-md-offset-1 col-md-10">
<div class="panel panel-primary" id="preliminary_data">
	<div class="panel-heading">Preliminary data</div> 
	<div class="panel-body">
		<div class="form-horizontal row"><!-- Preliminary form -->
			<!-- field HN type integer -->
			<div class='col-md-6 form-group'>
				{!! Form::label('HN','HN :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> {!! Form::number('HN',null,['class' => 'form-control', 'readonly']) !!} </div>
			</div>

			<!-- field patient_name type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('patient_name','Patient :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'> 
				<input type='text' class='form-control' value="{{ session('patient_name') }}" name='patient_name' readonly />
				</div>
			</div>

			<!-- field gender type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('gender','Gender :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'>
					<input type='text' class='form-control' value="{{ session('patient_gender') }}" name='patient_gender' readonly />
				</div>
			</div>

			<!-- field age type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('age','Age :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> 
					<input type='text' class='form-control' value="{{ session('patient_age') }}" name='patient_age' readonly />
				</div>
			</div>

			<!-- field AN type integer -->
			<div class='col-md-6 form-group'>
				{!! Form::label('AN','AN :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> {!! Form::number('AN',null,['class' => 'form-control', 'readonly']) !!} </div>
			</div>

			<!-- field date_admit type date -->
			<div class='form-group col-md-6'>
				{!! Form::label('date_admit','Date admit :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-5'>
					<div class="input-group date" id='datetimepicker_date_admit'>
						{!! Form::text('date_admit', null, ['class' => 'form-control', 'readonly']) !!}
		                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	                    <script type="text/javascript">
				            
	        			</script>
					</div>
				</div>
			</div>

			<!-- field ward type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('ward','Ward :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'>
					<input type='text' class='form-control' value="{{ session('ward_name') }}" name='ward' readonly />
				</div>
			</div>

			<!-- field attending type smallInteger -->
			<div class='col-md-6 form-group'>
				{!! Form::label('attending','Attending staff :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'> {!! Form::text('attending',null,['class' => 'form-control ui-widget', 'placeholder' => 'type to auto-complete']) !!} </div>
				<script type="text/javascript">
					var staffs;
					$(function() {
					     staffs = [
									'อ.กนกวรรณ บุญญพิสิฎฐ์ | Neurology',
									'อ.กมล อุดล | Preventive',
									'อ.กฤติยา กอไพศาล | Oncology',
									'อ.กิตติพงศ์  มณีโชติสุวรรณ | Chest',
									'อ.กุสุมา ไชยสูตร | Nutrition',
									'อ.เกรียงศักดิ์ วารีแสงทิพย์ | Nephrology',
									'อ.ไกรวิพร  เกียรติสุนทร | Nephrology',
									'อ.จอมจิตต์ จันทรัศมี | Oncology',
									'อ.จารุวรรณ  เอกวัลลภ | Oncology',
									'อ.จินตนา  ศิรินาวิน | Genetics',
									'อ.จินตนา  อาศนะเสน | Geriatric',
									'อ.จิราภรณ์ จิตประไพกุล | Neurology',
									'อ.จิรายุ  เอื้อวรากุล | Hematology',
									'อ.จุลจักร ลิ้มศิริวิไล | Gastroenterology',
									'พญ. เจน  เจียรธนะกานนท์ | Hematology',
									'อ.เจริญ ฉั่วริยะกุล | Ambulatory ',
									'อ.เจษฎา ทวีโภคสมบูรณ์ | Neurology',
									'อ.แจ่มศักดิ์  ไชยคุนา | Chest',
									'อ.ฉัตรกนก ทุมวิภาต | Cardiology',
									'อ.ฉัตรี หาญทวีพันธุ์ | Hematology',
									'อ.ชนินทร์ ลิ่มวงศ์ | Genetics',
									'อ.ชยวี  เมืองจันทร์ | Rheumatology',
									'อ.ชลธิชา เอื้อสมหวัง | Ambulatory',
									'อ.ชัชวาล  รัตนบรรณกิจ | Neurology',
									'อ.ชัยพล  ธัญญานุวัติ | Nephrology',
									'อ.ชัยรัตน์ ฉายากุล | Nephrology',
									'อ.ชัยวัฒน์ วชิรศักดิ์ศิริ | Ambulatory',
									'อ.ชาญ ศรีรัตนสถาวร | Cardiology',
									'อ.ชุณหเกษม โชตินัยวัตรกุล | Cardiology',
									'อ.เชิดชัย  นพมณีจำรัสเลิศ | Ambulatory',
									'อ.โชค  ลิ้มสุวัฒน์ | Emergency',
									'อ.โชติพัฒน์  ด่านชัยวิจิตร | Neurology',
									'อ.ไชยรัตน์  เพิ่มพิกุล | Critical Care',
									'อ.ฐิติมา ว่องวิริยะกุบ | Geriatic',
									'อ.ณรงค์ภณ ทุมวิภาค | Preventive',
									'อ.ณสิกาญจน์  อังคเศกวินัย | Infectious',
									'อ.ณัฐกานต์  ประพฤติกิจ | Emergency',
									'อ.ณัฐเชษฐ์  เปล่งวิทยา | Endocrinology',
									'อ.ณัฐวุฒิ  วงษ์ประภารัตน์ | Cardiology',
									'อ.ดำรัส  ตรีสุโกศล | Cardiology',
									'อ.เดโช  จักราพานิชกุล | Cardiology',
									'อ.เด่นหล้า  ปาลเดชพงศ์ | Ambulatory',
									'อ.ต่อพงษ์ ทองงาม | Allergy',
									'อ.ถนอมศักดิ์ อเนกธนานนท์ | Preventive',
									'อ.ทวี  ชาญชัยรุจิรา | Nephrology',
									'อ.ทวีศักดิ์  แทนวันดี | Gastroenterology',
									'อ.ทวีศักดิ์ วรรณชาลี | Endocrionology',
									'อ.ทัศน์พรรณ ศรีทองกุล | Nephrology',
									'อ.ทิพา ชาคร | Emergency',
									'อ.ธนัญญา บุณยศิรินันท์ | Cardiology',
									'อ.ธรรมพร เนาว์รุ่งโรจน์ | Critical Care',
									'อ.ธวัชชัย  พีรพัฒน์ดิษฐ์ | Endocrinology',
									'อ.ธัญจิรา จิรนันทกาญจน์ | Preventive',
									'อ.ธัญญารัตน์  ธีรพรเลิศรัฐ | Nephrology',
									'อ.ธาดา คุณาวิศรุต | Endocrinology',
									'อ.ธีระ ฤชุตระกูล | Hematology',
									'อ.ธีระ กลลดาเรืองไกร | Preventive',
									'อ.นนทลี เผ่าสวัสดิ์ | Gastroenterology',
									'อ.นพดล  ศิริธนารัตนกุล | Hematology',
									'อ.นพดล  โสภารัตนาไพศาล | Oncology',
									'อ.นราธิป ชุณหะมณีวัฒน์ | General',
									'อ.นริศ  สมิตาสิน | Neurology',
									'อ.นลินี เปรมัษเฐียร | Nephrology',
									'อ.นัฐพล  ฤทธิ์ทยมัย | Chest',
									'อ.นัฐสิทธิ์  ลาภปริสุทธิ | Nephrology',
									'อ.นันทกร  ทองแตง | Endocrinology',
									'อ.นาราพร  ประยูรวิวัฒน์ | Neurology',
									'อ.นิธิพัฒน์  เจียรกุล | Chest',
									'อ.นิธิมา เชาวลิต | Cardiology',
									'อ.นิพนธ์  พวงวรินทร์ | Neurology',
									'อ.บุณฑริกา  สุวรรณวิบูลย์ | Hematology',
									'อ.เบญจมาศ ช่วยชู | Chest',
									'อ.ปฐมพงษ์  อึ้งประเสริฐ | General Medicine',
									'อ.ปทุมพร สุรอรุณสัมฤทธิ์ | Geriatic',
									'อ.ประดิษฐ์  ปัญจวีณิน | Cardiology',
									'อ.ประเสริฐ อัสสันตะชัย | Preventive',
									'อ.ปรัชญา ศรีวานิชภูมิ | Neurology',
									'อ.ปรีชา ธำรงไพโรจน์ | Critical care',
									'อ.ปรียานุช  แย้มวงษ์ | Nutrition',
									'อ.ปวีณา  เชี่ยวชาญวิศวกิจ | Rheumatology',
									'อ.ปวีณา  ชุณหโรจน์ฤทธิ์ | Endocrinology',
									'อ.ปิติพร รัตนทวีบุญ | Ambulatory ',
									'อ.ปีณิดา สกุลรัตนศักดิ์ | Nephrology',
									'อ.พจมาน พิศาลประภา | Ambulatory',
									'อ.พรพจน์  เปรมโยธิน | General Medicine',
									'อ.พรพรรณ  กู้มานะชัย | Infectious',
									'อ.พลอยเพลิน พิกุลสด | Hematology',
									'อ.พิมล  รัตนาอัมพวัลย์ | Chest',
									'อ.พีระ บูรณะกิจเจริญ | Hypertension',
									'อ.พีระวงศ์ วีรารักษ์ | Treventive',
									'อ.พูนทรัพย์  วงศ์สุรเกียรติ์ | Chest',
									'อ.พูลชัย  จรัสเจริญวิทยา | Gastroenterology',
									'อ.ไพฑูรย์  ขจรวัชรา | Nephrology',
									'อ.ภัณฑิลา วาณิชย์การ | Cardiology',
									'อ.ภาณุวัฒน์ พรหมสิน | Critical care',
									'อ.ภิญโญ  รัตนาอัมพวัลย์ | Infectious',
									'อ.มณฑิรา มณีรัตนะพร | Gastroenterology',
									'อ.มยุรี หอมสนิท | Preventive',
									'อ.มานพ พิทักษ์ภากร | Genetics',
									'อ.เมทินี  กิตติโพวานนท์ | Cardiology',
									'อ.เมธา ผู้เจริญชนะชัย | Hypertension',
									'อ.เมธี  ชยะกุลคีรี | Infectious',
									'อ.ยงค์  รงค์รุ่งเรือง | Infectious',
									'อ.ยงชัย  นิละนนท์ | Neurology',
									'อ.ยงยุทธ  สหัสกุล | Cardiology',
									'อ.ยิ่งยง ชินธรรมมิตร์ | Hematology',
									'อ.ยุพิน  ศุพุทธมงคล | Infectious',
									'อ.รณิษฐา  รัตนะรัต | Critical Care',
									'อ.ระวีวรรณ เลิศวัฒนารักษ์ | Endocrinology',
									'อ.รังสรรค์  ชัยเสวิกุล | Neurology',
									'อ.รัตนา ชวนะสุนทรพจน์ | Nephrology',
									'อ.รุ่งนิรันดร์  ประดิษฐสุวรรณ | Geriatric',
									'อ.รุ่งโรจน์  กฤตยพงษ์ | Cardiology',
									'อ.รุจิภาส สิริจตุภัธร | Infectious',
									'อ.เรวัตร  พันธุ์กิ่งทองคำ | Cardiology',
									'อ.วรการ วิไลชนม์ | Critical Care',
									'อ.วรพรรณ เสนาณรงค์ | Neurology',
									'อ.วรรณี นิธิยานันท์ | Endocrinology',
									'อ.วรางคณา  บุญญพิสิฏฐ์ | Cardiology',
									'อ.วรายุ  ปรัชญกุล | Gastroenterology',
									'อ.วราลักษณ์  ศรีนนท์ประเสริฐ | Geriatric',
									'อ.วัชรศักดิ์  โชติยะปุตตะ | Gastroenterology',
									'อ.วัฒนชัย โชตินัยวัตรกุล | Neurology',
									'อ.วันชัย  เดชสมฤทธิ์ฤทัย | Chest',
									'อ.วันชัย วนะชิวนาวิน | Hematology',
									'อ.วันรัชดา  คัชมาตย์ | Rheumatology',
									'อ.วิชัย เตชะสาธิต | Preventive',
									'อ.วิชัย ฉัตรธนวารี | Preventive',
									'อ.วิเชียร  ศรีมุนินทร์นิมิต | Oncology',
									'อ.วิทยา ไชยธีระพันธ์ | Cardiology',
									'อ.วินัย รัตนสุวรรณ | Preventive',
									'อ.วิวรรณ ทังสุบุตร | Cardiology',
									'อ.วิศิษฎ์ วามวาณิชย์ | Board Manager',
									'อ.วิษณุ  ธรรมลิขิตกุล | Infectious',
									'อ.วีรชัย ศรีวณิชชากร | Ambulatory',
									'อ.วีรนุช  รอบสันติสุข | Hypertension',
									'อ.วีรภัทร โอวัฒนาพานิช | Hematology',
									'อ.วีรศักดิ์ เมืองไพศาล | Preventive',
									'อ.ศรัทธา  ริยาพันธ์ | Emergency',
									'อ.ศรัทธาวุธ วงษ์เวียงจันทร์ | Neurology',
									'อ.ศรีสกุล  จิรกาญจนากร | Cardiology',
									'อ.ศิริโสภา เตชะวัฒนวรรณา | Oncology',
									'อ.ศิวะพร  ไชยนุวัติ | Gastroenterology',
									'อ.ศุทธินี  อิทธิเมฆินทร์ | Oncology',
									'อ.ศุภกาพันธุ์ รัตนมณีฉัตร | Preventive',
									'อ.ศุภชัย รัตนมณีฉัตร | Preventive',
									'อ.ศุภฤกษ์  ดิษยบุตร | Chest',
									'อ.สถาพร มานัสสถิตย์ | Gastroenterlogy',
									'อ.สนั่น  วิสุทธิศักดิ์ชัย | Hematology',
									'อ.สมเกียรติ  วสุวัฏฏกุล | Nephrology',
									'อ.สมชาย  ลีลากุศลวงศ์ | Gastroenterology',
									'อ.สมบูรณ์ อินทลาภาพร | Preventive',
									'อ.สสิธร  ศิริโท | Neurology',
									'อ.สัชชนะ  พุ่มพฤกษ์ | Cardiology',
									'อ.สัมมน โฉมฉาย | Preventive',
									'อ.สาธิต  วรรณแสง | Endocrinology',
									'อ.สาธิต เจนวณิชสถาพร | Cardiology',
									'อ.สิทธิ์  สาธรสุเมธี | Neurology',
									'อ.สิรวัฒน์  ศรีฉัตราภิมุข | General Medicine',
									'อ.สิริสวัสดิ์  วันทอง | Hypertension',
									'อ.สุกิจ รักษาสุข | Nephrology',
									'อ.สุชัย  เจริญรัตนกุล | Chest',
									'อ.สุชาย ศรีทิพยวรรณ | Nephrology',
									'อ.สุทิน ศรีอัษฎาพร | Endocrinology',
									'พญ. สุทิมา  เหลืองดิลก | Oncology',
									'อ.สุพจน์  พงศ์ประสบชัย | Gastroenterology',
									'อ.สุพจน์  นิ่มอนงค์ | Gastroenterology',
									'อ.สุรพล อิสรไกรศีล | Hematology',
									'อ.สุรพล สุวรรณกูล | Preventive',
									'อ.สุรพล กอบวรรธนะ | General Medicine',
									'อ.สุรศักดิ์  นิลกานุวงศ์ | Rheumatology',
									'อ.สุรัตน์  ทองอยู่ | Critical Care',
									'อ.สุรีย์  สมประดีกุล | Chest',
									'อ.สุวัจชัย  พรรัตนรังสี | Cardiology',
									'อ.สุสัณห์  อาศนะเสน | Infectious',
									'พญ. เสาวณีย์ สุขสุริยะโยธิน | Emergency',
									'อ.อดิศักดิ์  มณีไสย | Cardiology',
									'อ.อนุภพ จิตต์เมือง | Infectious',
									'อ.อนุวัฒน์  กีระสุนทรพงษ์ | Infectious',
									'พญ. อภิชญา มั่นสมบูรณ์ | Emergency',
									'อ.อภิชาต  มิคี วัลยะเสวี | Allergy',
									'อ.อภิชาติ พิศาลพงศ์ | Neurology',
									'อ.อภิรดี  ศรีวิจิตรกมล | Endocrinology',
									'อ.อมร  ลีลารัศมี | Infectious',
									'อ.อรนิช นาวานุเคราะห์ | Preventive',
									'อ.อรรถ  นานา | Chest',
									'อ.อรรถพงศ์  วงศ์วิวัฒน์ | Nephrology',
									'อ.อริศรา  สุวรรณกูล | Cardiology',
									'อ.อวยพร ศิริอยู่ยืน | Gastroenterology',
									'อ.อัจฉรา  กุลวิสุทธิ์ | Rheumatology',
									'อ.อาจบดินทร์ วินิจกุล | General',
									'อ.อาจรบ  คูหาภินันทน์ | Hematology',
									'อ.อุดม  คชินทร | Gastroenterology',
									'อ.อุบลวรรณ จงวุฒเวศย์ | Infectious',
									'อ.อุษาพรรณ สุรเบญจวงศ์ | Emergency',
									'อ.เอกพล อัจฉริยะประสิทธิ์ | Hematology',
									'อ.เอกพันธ์ ครุพงศ์ | Hematology',
									'อ.เอกรินทร์  ภูมิพิเชฐ | Critical Care',
									'อ.เอมวลี  อารมย์ดี | Rheumatology'
					    ];
					    $( "#attending" ).autocomplete({
					    	source: staffs,
					    	minLength: 2
					    });
					});
				</script>
			</div>
		
			<!-- field reason_admit type tinyInteger -->
			<div class='form-group col-md-12' id="chief_complant_id">
				{!! Form::label('reason_admit','Reason :',['class' => 'control-label col-md-2']) !!}
				<div class='from-group col-md-10'>
					<label class="radio-inline">{!! Form::radio('reason_admit',1) !!}Curative</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',2) !!}Curative+Palliative</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',3) !!}Palliative only</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',4) !!}Investigation</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',5) !!}Rehabilitation</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',0) !!}Other</label>
				</div>
			</div>

			<!-- field reason_admit_other type string -->
			<div class='collapse col-md-12 form-group' id="reasonAdmitOther">
				{!! Form::label('reason_admit_other','Other :',['class' => 'control-label col-md-2']) !!}
				<div class='col-md-10'> {!! Form::text('reason_admit_other',null,['class' => 'form-control', 'placeholder' => 'other reason for admission type here', 'id' => 'reason_admit_other']) !!} </div>
			</div>
		</div><!-- end of horizon form -->
	</div><!-- end of preliminary data body -->
</div><!-- end of preliminary data -->
</div><!-- end of div offset -->

<div class="col-md-offset-1 col-md-10">
<div class="panel panel-primary">
	<div class="panel-heading" id="history">History</div> 
	<div class="panel-body">

		<!-- panel Chief complant -->
		<div class="panel panel-info">
			<div class="panel-heading">Chief complant</div>
			<!-- field chief_complant type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('chief_complant',null,['class' => 'form-control', 'rows' => '1', 'id' => 'chief_complant']) !!}
			</div>
		</div>

		<!-- panel co-morbid -->
		<div class="panel panel-info" id="comorbid_id">
			<div class="panel-heading">Co-morbid and illness history</div>
			<div class="panel-body">
				
				<button type="button" onclick="setComorbid(1)" title="Click เพื่อลงข้อมูล Co-morbid เป็น No data ทั้งหมด" class="btn btn-info">No data all</button>
				<button type="button" onclick="setComorbid(2)" title="Click เพื่อลงข้อมูล Co-morbid เป็น No ทั้งหมด" class="btn btn-info">No co-morbid</button>
				<button type="button" onclick="setComorbid(3)" title="แสดง/ซ่อน รายการโรคร่วม" class="btn btn-primary">Show/Hide Co-morbid List</button>

	            <!-- collapse Comorbid list -->
	            <div class="form-horizontal row collapse in" id="comorbidList">
	            	<div class="col-md-12"><hr></div>
					<!-- field comorbid_DM type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('DM','DM :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_DM',99) !!}No data</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_DM',0) !!}No</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_DM',1) !!}Yes</label>
						</div>
					 </div>

					<div class="collapse" id="comorbid_DM_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('DM_type','DM Type :',['class' => 'control-label col-md-4']) !!}
							<!-- field DM type tinyInteger -->
							<div class='col-md-8'>
								<label class="radio-inline">{!! Form::radio('DM_type',1) !!}Type I</label>
							    <label class="radio-inline">{!! Form::radio('DM_type',2) !!}Type II</label>
							</div>
						</div>
						<div class="col-md-12"></div>
						<div class='form-group col-md-12'>
							{!! Form::label('DM_complication','DM Complication :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<!-- field DM_DR type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_DR') !!}DR</label></div>
							    <!-- field DM_nephropathy type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_nephropathy') !!}Nephropathy</label></div>
							    <!-- field DM_neuropathy type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_neuropathy') !!}Neuropathy</label></div>
						    </div>
						</div>
						<div class="col-md-12"></div>

						<div class='form-group col-md-12'>
							{!! Form::label('DM_complication','On :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<!-- field DM_on_diet type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_on_diet') !!}Diet control</label></div>
							    <!-- field DM_on_oral_med type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_on_oral_med') !!}Oral medication</label></div>
							    <!-- field DM_on_insulin type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_on_insulin') !!}Insulin</label></div>
						    </div>
						</div>
					</div><!-- end of DM collapse -->
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('HT','HT :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_HT type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HT',99) !!}No data</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_HT',0) !!}No</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_HT',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>
					
					<div class='form-group col-md-12'>
						<label class="control-label col-md-4">CAD[<a title="Coronary artery disease">*</a>] :</label>
						<!-- field comorbid_CAD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_CAD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CAD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CAD',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_CAD_collapse" >
						<div class='form-group col-md-12'>
							{!! Form::label('cad_dx','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field CAD_dx type tinyInteger -->
							<div class='col-md-8'>
								<label class="radio-inline">{!! Form::radio('CAD_dx',1) !!}Old MI</label>
								<label class="radio-inline">{!! Form::radio('CAD_dx',2) !!}Unstable angina</label>
								<label class="radio-inline">{!! Form::radio('CAD_dx',3) !!}Stable angina</label>
								<label class="radio-inline">{!! Form::radio('CAD_dx',0) !!}Others</label>
							</div><!-- end CAD_dx radio input -->
						</div>

						<div class='form-group col-md-12'>
							{!! Form::label('CAD_dx_other','CAD Type other:',['class' => 'control-label col-md-4']) !!}
							<!-- field CAD_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('CAD_dx_other',null,['class' => 'form-control', 'readonly']) !!}</div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('VHD','Valvular heart disease :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_VHD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_VHD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_VHD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_VHD',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse col-md-12" id="comorbid_VHD_collapse" >
						<div class='form-group col-md-12'>
							{!! Form::label('VHD_dx_AS','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<div class='row col-md-8'>
								<!-- field VHD_dx_AS type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_AS') !!}AS</label></div>
							    <!-- field VHD_dx_AR type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_AR') !!}AR</label></div>
							    <!-- field VHD_dx_MS type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_MS') !!}MS</label></div>
							    <!-- field VHD_dx_MR type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_MR') !!}MR</label></div>
							    <!-- field VHD_dx_TR type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_TR') !!}TR</label></div>
							</div>
						</div>

						<div class='col-md-12 form-group'>
							{!! Form::label('VHD_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field VHD_dx_other string -->
							<div class='col-md-8'> {!! Form::text('VHD_dx_other',null,['class' => 'form-control']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('stroke','Stroke :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_stroke type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_stroke',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_stroke',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_stroke',1) !!}Yes</label>									
						</div>
					</div>

					<div class="collapse col-md-12" id="comorbid_stroke_collapse" >
						<div class='col-md-12 col-md-offset-1'>
							<!-- field stroke_ischemic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('stroke_ischemic') !!}ischemic</label></div>
							
							<!-- field stroke_ischemic_result type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_ischemic_result','Result :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result',1) !!}hemiparesis</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result',2) !!}hemiplegia</label></div>
							</div>
							
							<!-- field stroke_ischemic_result_on type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_ischemic_result_on','On :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result_on',1) !!}left</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result_on',2) !!}right</label></div>
							</div>
						</div>

						<div class='col-md-12 col-md-offset-1'>
							<!-- field stroke_hemorrhagic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('stroke_hemorrhagic') !!}hemorrhagic</label></div>
							
							<!-- field stroke_hemorrhagic_result type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_hemorrhagic_result','Result :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result',1) !!}hemiparesis</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result',2) !!}hemiplegia</label></div>
							</div>
							
							<!-- field stroke_hemorrhagic_result_on type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_hemorrhagic_result_on','On :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result_on',1) !!}left</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result_on',2) !!}right</label></div>
							</div>
						</div>

						<div class='col-md-12 col-md-offset-1'>
							<!-- field stroke_iembolic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('stroke_iembolic') !!}iembolic</label></div>
							
							<!-- field stroke_iembolic_result type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_iembolic_result','Result :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result',1) !!}hemiparesis</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result',2) !!}hemiplegia</label></div>
							</div>
							
							<!-- field stroke_iembolic_result_on type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_iembolic_result_on','On :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result_on',1) !!}left</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result_on',2) !!}right</label></div>
							</div>
						</div>
					</div><!-- end radio stroke -->
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_COPD','COPD :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_COPD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_COPD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_COPD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_COPD',1) !!}Yes</label>		
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_asthma','Asthma :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_asthma type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_asthma',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_asthma',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_asthma',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						<label class='control-label col-md-4'>CKD[<a title='Chronic kidney disease'>*</a>] :</label>
						<!-- field comorbid_CKD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_CKD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CKD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CKD',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="col-md-12 form-group collapse" id="comorbid_CKD_collapse">
						{!! Form::label('CKD_stage','Stage :',['class' => 'col-md-2 control-label']) !!}
						<!-- field CKD_stage type tinyInteger -->
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',1) !!}I</label></div>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',2) !!}II</label></div>
					    <div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',3) !!}III</label></div>
					    <div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',4) !!}IV</label></div>
					    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',5) !!}V, no dialysis</label></div>
					    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',6) !!}V, on HD</label></div>
					    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',7) !!}V, on PD</label></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_hyperlipidemia','Hyperlipidemia :',['class' => 'control-label col-md-4']) !!}
						<!-- field type comorbid_hyperlipidemia tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',1) !!}Yes</label>
						</div>
					</div>

					<div class="col-md-12 form-group collapse" id="comorbid_hyperlipidemia_collapse">
						{!! Form::label('hyperlipidemia_type','Diagnosis :',['class' => 'col-md-4 control-label']) !!}
						<!-- field hyperlipidemia_type type tinyInteger -->
						<div class="from-group col-md-8">
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',1) !!}Hypercholesterolemia</label></div>
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',2) !!}Hypertriglyceridemia</label></div>
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',3) !!}Mixed-hyperlipidemia</label></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_cirrhosis type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('cirrhosis','Cirrhosis :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_cirrhosis_collapse">
						<div class="col-md-12 form-group">
						<label for="" class="col-md-4 control-label">Child-Pugh score[<a onclick="$('#cp_score_refferance_collapse').collapse('toggle')">*</a>] :</label>
							<div class='col-md-8'>
								<!-- field cirrhosis_cp_score type tinyInteger -->
								<label class="radio-inline col-md-1">{!! Form::radio('cirrhosis_cp_score','A') !!}A</label>
							    <label class="radio-inline col-md-1">{!! Form::radio('cirrhosis_cp_score','B') !!}B</label>
							    <label class="radio-inline col-md-1">{!! Form::radio('cirrhosis_cp_score','C') !!}C</label>
							</div>
						</div>

						<!-- Refferance -->
						<div class="collapse col-md-12 form-group" id="cp_score_refferance_collapse">@include('cpscore')</div><!-- <div class="row col-md-offset-6"></div> -->
						
						<div class='form-group col-md-12'>
							{!! Form::label('cirrhosis_cp_score','Etiology :',['class' => 'control-label col-md-4']) !!}
							<!-- field cirrhosis_etiology_HBV type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_HBV') !!}HBV</label></div>
							<!-- field cirrhosis_etiology_HCV type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_HCV') !!}HCV</label></div>
						    <!-- field cirrhosis_etiology_NASH type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_NASH') !!}NASH</label></div>
						    <!-- field cirrhosis_etiology_cryptogenic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_cryptogenic') !!}Cryptogenic</label></div>
						</div>
					    <!-- field cirrhosis_etiology_other type string -->
					    <div class='col-md-12 form-group'>
							{!! Form::label('cirrhosis_etiology_other','Other etiology :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('cirrhosis_etiology_other',null,['class' => 'form-control']) !!} </div>
						</div>
					</div><!-- end of cirrhosis collapse -->
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_coagulopathy type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('coagulopathy','Coagulopathy :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_HBV type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_HBV','HBV infection :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HBV',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HBV',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HBV',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_HCV type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_HCV','HCV infection :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HCV',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HCV',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HCV',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_HIV type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('HIV','HIV :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',2) !!}HIV infection</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',1) !!}AIDS</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_HIV_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('HIV_pre_infect_TB','Previous opportunistic infection :',['class' => 'control-label col-md-4']) !!}
							<!-- field HIV_pre_infect_TB -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_TB') !!}TB</label></div>
						    <!-- field HIV_pre_infect_PCP -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_PCP') !!}PCP</label></div>
						    <!-- field HIV_pre_infect_candidiasis -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_candidiasis') !!}Candidiasis</label></div>
						    <!-- field HIV_pre_infect_CMV -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_CMV') !!}CMV</label></div>
						</div>

						<!-- field HIV_pre_infect_other type string -->
						<div class='col-md-12 form-group'>
							{!! Form::label('HIV_pre_infect_other','Other opportunistic infection :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('HIV_pre_infect_other',null,['class' => 'form-control']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_epilepsy type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('epilepsy','Epilepsy :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',1) !!}Yes</label>
						</div>
					</div>
					<div class="collapse" id="comorbid_epilepsy_collapse">
						<div class='form-group col-md-12'>
							<!-- field epilepsy_dx type tinyInteger -->
							{!! Form::label('epilepsy_dx','Diagnosis :',['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-8">
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',1) !!}GTC</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',2) !!}Focal</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',3) !!}Complex partial seizure</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',4) !!}Unknown</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',0) !!}Others</label>
							</div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('epilepsy_dx_other','Other :',['class' => 'col-md-4 control-label']) !!}
							<!-- field epilepsy_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('epilepsy_dx_other',null,['class' => 'form-control']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_leukemia type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('leukemia','Leukemia :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_leukemia',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_leukemia',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_leukemia',1) !!}Yes</label>
						</div>
					</div>

					<div class="col-md-12 form-group collapse" id="comorbid_leukemia_collapse">
						<!-- field leukemia_dx type tinyInteger -->
						{!! Form::label('','Diagnosis :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',1) !!}ALL</label>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',2) !!}AML</label>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',3) !!}CLL</label>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',4) !!}CML</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_lymphoma type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('lymphoma','Lymphoma :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_lymphoma_collapse">
						<!-- field lymphoma_dx tinyInteger -->
						<div class='form-group col-md-12'>
							{!! Form::label('lymphoma_dx','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8 lymphoma_dx_div'>
								<select class="form-control" name='lymphoma_dx' id='lymphoma_dx_select'>
									<option selected disabled hidden value=''></option>
									<option value="1">Hodgkin</option>
									<option value="2">Non-Hodgkin - Diffuse large B cell</option>
									<option value="3">Non-Hodgkin - Diffuse large T cell</option>
									<option value="4">Non-Hodgkin - Follicular B cell</option>
									<option value="5">Non-Hodgkin - Follicular T cell</option>
									<option value="6">Non-Hodgkin - Burkitt High grade</option>
									<option value="7">Non-Hodgkin - Burkitt Low grade</option>
									<option value="8">Non-Hodgkin - Other High grade</option>
									<option value="9">Non-Hodgkin - Other Low grade</option>
									<option value="10">Intravascular</option>
									<option value="0">Other</option>
								</select>
							</div>
						</div>
						
						<div class='form-group col-md-12'>
							{!! Form::label('lymphoma_dx_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field lymphoma_dx_other type string -->
							<div class="col-md-8">{!! Form::text('lymphoma_dx_other',null,['class' => 'form-control', 'placeholder' => 'Other type here' ,'id' => 'lymphoma_type_other']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('pacemaker_implant','Pacemaker implant :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_pacemaker_implant type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_pacemaker_implant_collapse">
						<div class='form-group col-md-12'>
							<!-- field pacemaker_implant_type type tinyInteger-->
							{!! Form::label('','Pacemaker type :',['class' => 'col-md-4 control-label']) !!}
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',1) !!}DDDR (dual-chamber, rate-modulated)</label></div>
							<div class='col-md-1'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',2) !!}VVI</label></div>
							<div class='col-md-1'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',0) !!}Other</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('lymphoma_type_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field pacemaker_implant_type_other type string -->
							<div class="col-md-8">{!! Form::text('pacemaker_implant_type_other',null,['class' => 'form-control', 'placeholder' => 'Other type here' ,'id' => 'pacemaker_implant_other']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_ICD type tinyInteger -->
					<div class='form-group col-md-12'>
						<label class="control-label col-md-4">ICD[<a title="Implantable Cardioverter Defibrillator">*</a>] :</label>								
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_ICD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_ICD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_ICD',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_ICD_collapse">
						<!-- field ICD_type type string -->
						<div class='form-group col-md-12'>
							{!! Form::label('ICD_type','ICD Type :',['class' => 'control-label col-md-4']) !!}
							<div class="col-md-8">{!! Form::text('ICD_type',null,['class' => 'form-control', 'placeholder' => 'enter ICD type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('cancer','Cancer :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_cancer type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_cancer',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cancer',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cancer',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_cancer_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('cancer_organ','Please select organ :',['class' => 'control-label col-md-4']) !!}
							<!-- fields cancer_at_lung type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_lung') !!}Lung</label></div>
						    <!-- fields cancer_at_liver type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_liver') !!}Liver</label></div>
						    <!-- fields cancer_at_colon type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_colon') !!}Colon</label></div>
						    <!-- fields cancer_at_breast type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_breast') !!}Breast</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('cancer_organ',' ',['class' => 'control-label col-md-4']) !!}
						    <!-- fields cancer_at_prostate type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_prostate') !!}Prostate</label></div>
						    <!-- fields cancer_at_cervix type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_cervix') !!}Cervix</label></div>
						    <!-- fields cancer_at_pancreas type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_pancreas') !!}Pancreas</label></div>
						    <!-- fields cancer_at_brain type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_brain') !!}Brain</label></div>
						</div>

						<div class='col-md-12 form-group'>
							{!! Form::label('cancer_at_other','Other organ :',['class' => 'control-label col-md-4']) !!}
							<!-- fields cancer_at_other type string-->
							<div class='col-md-8'> {!! Form::text('cancer_at_other',null,['class' => 'form-control', 'placeholder' => 'Other organ type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_chronic_arthritis','Chronic arthritis :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_chronic_arthritis type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_chronic_arthritis_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('chronic_arthritis_organ','Please select :',['class' => 'control-label col-md-4']) !!}
							<!-- field chronic_arthritis_gout type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_gout') !!}Pancreas</label></div>
						    <!-- field chronic_arthritis_CPPD type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_CPPD') !!}CPPD[<a title="Calcium pyrophosphate dihydrate">*</a>]</label></div>
						    <!-- field chronic_arthritis_rheumatoid type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('chronic_arthritis_rheumatoid') !!}Rheumatoid arthritis</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('chronic_arthritis_organ',' ',['class' => 'control-label col-md-4']) !!}    
						    <!-- field chronic_arthritis_OA type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_OA') !!}OA[<a title="Osteoarthritis">*</a>]</label></div>
						    <!-- field chronic_arthritis_spondyloarthropathy type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('chronic_arthritis_spondyloarthropathy') !!}Spondyloarthropathy</label></div>
						</div>

						<!-- field chronic_arthritis_other type string -->
						<div class='col-md-12 form-group'>
							{!! Form::label('chronic_arthritis_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('chronic_arthritis_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('SLE','SLE :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_SLE type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_SLE',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_SLE',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_SLE',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_other_autoimmune_disease','Other autoimmune disease :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_other_autoimmune_disease type tinyinteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_other_autoimmune_disease_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('other_autoimmune_disease_dx','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field other_autoimmune_disease_dx_sjrogren_syndrome type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('other_autoimmune_disease_dx_sjrogren_syndrome') !!}Sjrögren syndrome</label></div>
						    <!-- field other_autoimmune_disease_dx_UCTD type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_disease_dx_UCTD') !!}UCTD[<a title="Undifferentiated Connective Tissue Disease">*</a>]</label></div>
						    <!-- field other_autoimmune_disease_dx_MCTD type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_disease_dx_MCTD') !!}MCTD[<a title="Mixed Connective Tissue Disease">*</a>]</label></div>
						    <!-- field other_autoimmune_disease_dx_DMPM type boolean -->
							<div class="checkbox col-md-1"><label>{!! Form::checkbox('other_autoimmune_disease_dx_DMPM') !!}DMPM[<a title="Dermato Myositis Poly Myositis">*</a>]</label></div>
						</div>
						
						<div class='col-md-12 form-group'>
							{!! Form::label('other_autoimmune_disease_dx_other','Other diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field other_autoimmune_disease_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('other_autoimmune_disease_dx_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('TB','TB :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_TB type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_TB',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_TB',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_TB',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_TB_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('TB_organ','Please select :',['class' => 'control-label col-md-4']) !!}
							<!-- field TB_at_pulmonary type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('TB_at_pulmonary') !!}Pulmonary</label></div>
							{!! Form::label('TB_at_other','Other :',['class' => 'control-label col-md-2']) !!}
							<!-- field TB_at_other type string -->
							<div class='col-md-4'> {!! Form::text('TB_at_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('dementia','Dementia :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_dementia radio input -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_dementia',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_dementia',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_dementia',1) !!}Yes</label>
						</div>
					</div>
					<div class="collapse" id="comorbid_dementia_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('dementia_organ','Please select :',['class' => 'control-label col-md-4']) !!}
							<!-- field dementia_vascular type boolean -->
							<div class="checkbox col-md-1"><label>{!! Form::checkbox('dementia_vascular') !!}Vascular</label></div>
						    <!-- field dementia_alzheimer type boolean -->
							<div class="checkbox col-md-1"><label>{!! Form::checkbox('dementia_alzheimer') !!}Alzheimer</label></div>
							<!-- field dementia_other type string -->
							{!! Form::label('dementia_other','Other :',['class' => 'control-label col-md-2']) !!}
							<div class='col-md-4'> {!! Form::text('dementia_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('psychiatric_illness','Psychiatric illness :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_psychiatric_illness type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',1) !!}Yes</label>
						</div>
					</div>
					<div class="collapse" id="comorbid_psychiatric_illness_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('psychiatric_illness_organ','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field psychiatric_illness_dx_schizophrenia type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_dx_schizophrenia') !!}Schizophrenia</label></div>
						    <!-- field psychiatric_illness_dx_major_depression type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_dx_major_depression') !!}Major depression</label></div>
						    <!-- field psychiatric_illness_dx_bipolar_disorder type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_dx_bipolar_disorder') !!}Bipolar disorder</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('psychiatric_illness_organ',' ',['class' => 'control-label col-md-4']) !!}
						    <!-- field psychiatric_illness_dx_adjustment_disorder type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('psychiatric_illness_dx_adjustment_disorder') !!}Adjustment disorder</label></div>
						    <!-- field psychiatric_illness_dx_Obcessive_compulsive_disorder type boolean -->
							<div class="checkbox col-md-4"><label>{!! Form::checkbox('psychiatric_illness_dx_Obcessive_compulsive_disorder') !!}Obcessive compulsive disorder</label></div>
						</div>
						<div class='col-md-12 form-group'>
							{!! Form::label('psychiatric_illness_dx_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field psychiatric_illness_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('psychiatric_illness_dx_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_other type text -->
					<div class='col-md-12 form-group'>
						{!! Form::label('comorbid_other','Other co-morbid :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'> {!! Form::textarea('comorbid_other',null,['class' => 'form-control', 'placeholder' => 'Other type here','rows' => '1']) !!} </div>
					</div>
	            </div><!-- end collapse Comorbid list -->
			

	            <div class="col-md-12"><hr></div>
	            <!-- field history_present_illness type text -->
				<div class='form-group col-md-12'>
					{!! Form::label('history_present_illness','History of present illness :',['class' => 'col-md-4 control-label']) !!}
					{!! Form::textarea('history_present_illness',null,['class' => 'col-md-8 form-control', 'rows' => '1', 'id' => 'history_present_illness']) !!}
				</div>

				<!-- field history_past_illness type text -->
				<div class='form-group col-md-12'>
					{!! Form::label('history_past_illness','History of past illness :',['class' => 'control-label']) !!}
					{!! Form::textarea('history_past_illness',null,['class' => 'form-control', 'rows' => '1', 'id' => 'history_past_illness']) !!}
				</div>
			</div>
		</div><!-- end panel co-morbid -->
	</div>
</div><!-- end of History -->
<div class="panel panel-primary">
	<div class="panel-heading">Physical examination and investigation</div> 
	<div class="panel-body">
		<div class="panel panel-info">
			<div class="panel-heading">Vital signs</div> 
			<div class="panel-body">
			</div>
		</div><!-- end of Vital signs -->
	</div>
</div><!-- end of Physical examination and investigation -->
</div><!-- end of main_frame -->
<script type="text/javascript">

	// reason_admit
	function toggleReasonAdmitOther(){
		var reason = $('input[name=reason_admit]:checked').val();
        if ( reason > 0 || (typeof $('input[name=reason_admit]:checked').val() === 'undefined')) {
        	$('#reasonAdmitOther').collapse('hide');
        	$('#reason_admit_other').val('');
        } else {
        	$('#reasonAdmitOther').collapse('show');
        }
	}

	// admit_date
	$(function () {
        $('#datetimepicker_date_admit').datetimepicker({
            locale: 'th',
            format: 'DD-MM-YYYY',
            showTodayButton: true,
            showClear: true
        });
    });

	// co-morbid buttons event
	function setComorbid(mode) {
		if (mode == 1) {
			$("input[name*='comorbid'][value='99']").prop('checked', true);
			$("input[name*='comorbid'][value='99']").click();	
		} else if (mode == 2) {
			$("input[name*='comorbid'][value='0']").prop('checked', true);
			$("input[name*='comorbid'][value='0']").click();
		} else {
			$('#comorbidList').collapse('toggle');
		}
	}

	// toggle extend detail for all comorbid.
	function toggleComorbidDetailCollapse(ctr){
		var ctrName = ctr.attr('name'); // get element name.
		var value =  $('input[name=' + ctrName + ']:checked').val(); // get ckecked value.
		if ( value == 0 || value == 99 || value == 2 || (typeof $('input[name=' + ctrName + ']:checked').val() === 'undefined')) { // No(0), No data(99) and null for true.
        	$('#' + ctrName + '_collapse').collapse('hide'); // hide detail.
        	$('input[name*=' + ctrName.replace('comorbid_','') + '_]').prop('checked',false); // reset detail all check input.
        	$('input[name*=' + ctrName.replace('comorbid_','') + '_]:text').val(''); // reset detail text input
        	$('input[name*=' + ctrName.replace('comorbid_','') + '_]:text').prop('readonly',true);
        	// $('input[name*=' + ctrName.replace('comorbid_','') + '_]:select').val(''); // reset detail text input
        } else {
        	$('#' + ctrName + '_collapse').collapse('show'); // show detail.
        }
	}

	// select other then focus on text input.
	function getOtherText(ctr,mode) {
		var ctrName = ctr.attr('name'); // get element name.
		if (mode == "radio")
			var value =  $('input[name=' + ctrName + ']:checked').val(); // get ckecked value.
		else if (mode == "select")
			var value =  $('#' + ctr.attr("id")).val(); // get ckecked value.

		if (value == 0) {
			$("input[name=" + ctrName + "_other]").prop('readonly',false);
			$("input[name=" + ctrName + "_other]").focus();
		} else {
			$("input[name=" + ctrName + "_other]").prop('readonly',true);
			$("input[name=" + ctrName + "_other]").val('');
		}
	}

	function toggleCAD() {
		toggleComorbidDetailCollapse($('input[name=comorbid_CAD]'));
		getOtherText($('input[name=CAD_dx]'),"radio");
	}

	function toggleVHD() {
		toggleComorbidDetailCollapse($('input[name=comorbid_VHD]'));
		$('input[name=VHD_dx_other]').prop('readonly', false); // override toggleComorbidDetailCollapse().
	}

	function toggleCirrhosis() {
		toggleComorbidDetailCollapse($('input[name=comorbid_cirrhosis]'));
		$('input[name=cirrhosis_etiology_other]').prop('readonly', false); // override toggleComorbidDetailCollapse().
	}

	// add cirrhosis_etiology event
	$("input[name*='cirrhosis_etiology_']").each(function(i, obj) {		
		var choice = $(this).prop('name');
		switch(choice) {
			case 'cirrhosis_etiology_HBV' :
				$(this).click(function() { 
					$("input[name='comorbid_HBV'][value='1']").prop('checked', true); 
					if ($("input[name='cirrhosis_etiology_cryptogenic']").prop('checked'))
						$("input[name='cirrhosis_etiology_cryptogenic']").click();
					
				});
				break;
			case 'cirrhosis_etiology_HCV' :
				$(this).click(function() { 
					$("input[name='comorbid_HCV'][value='1']").prop('checked', true); 
					if ($("input[name='cirrhosis_etiology_cryptogenic']").prop('checked'))
						$("input[name='cirrhosis_etiology_cryptogenic']").click();
				});
				break;
			case 'cirrhosis_etiology_cryptogenic' :								    				
				$(this).click(function() {
					if ($(this).prop('checked') == true) {
						$("input[name='cirrhosis_etiology_HBV']").prop('checked', false);
						$("input[name='cirrhosis_etiology_HCV']").prop('checked', false);
						$("input[name='cirrhosis_etiology_NASH']").prop('checked', false);
						$('#cirrhosis_etiology_other').val('');
						$('#cirrhosis_etiology_other').prop('readonly', true);
					} else {
						$("input[name='cirrhosis_etiology_HBV']").prop('readonly', false);
						$("input[name='cirrhosis_etiology_HCV']").prop('readonly', false);
						$("input[name='cirrhosis_etiology_NASH']").prop('readonly', false);
						$('#cirrhosis_etiology_other').prop('readonly', false);
					}
				});
				break;
		}
	});

	// triger TB by HIV previous infection.
	$("input[name='HIV_pre_infect_TB']").click(function() {
		$("input[name='HIV_pre_infect_TB']").prop('checked') ? $("input[name='comorbid_TB'][value='1']").prop('checked', true) : $("input[name='comorbid_TB'][value='1']").prop('checked', false); 
	});

	function toggleHIV() {
		toggleComorbidDetailCollapse($('input[name=comorbid_HIV]'));
		$('input[name=HIV_pre_infect_other]').prop('readonly', false); // override toggleComorbidDetailCollapse().
	}

	function toggleEpilepsy() {
		toggleComorbidDetailCollapse($('input[name=comorbid_epilepsy]'));
		getOtherText($('input[name=epilepsy_dx]'),"radio");
	}

	function toggleLymphoma() {
		toggleComorbidDetailCollapse($('input[name=comorbid_lymphoma]'));
		var value =  $('input[name=comorbid_lymphoma]:checked').val(); // get ckecked value.
		if ( value == 0 || value == 99 || value == 2 || (typeof $('input[name=comorbid_lymphoma]:checked').val() === 'undefined')) { // No(0), No data(99) and null for true.
			$('#lymphoma_dx_select').val('');
		}
		getOtherText($('#lymphoma_dx_select'),"select");
	}

	function togglePaceMakerImplant() {
		toggleComorbidDetailCollapse($('input[name=comorbid_pacemaker_implant]'));
		getOtherText($('input[name=pacemaker_implant_type]'),"radio");
	}

	function toggleICD() {
		toggleComorbidDetailCollapse($('input[name=comorbid_ICD]'));
		$('input[name=ICD_type]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleCancer() {
		toggleComorbidDetailCollapse($('input[name=comorbid_cancer]'));
		$('input[name=cancer_at_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleChronicArthritis() {
		toggleComorbidDetailCollapse($('input[name=comorbid_chronic_arthritis]'));
		$('input[name=chronic_arthritis_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleOtherAutoimmuneDisease() {
		toggleComorbidDetailCollapse($('input[name=comorbid_other_autoimmune_disease]'));
		$('input[name=other_autoimmune_disease_dx_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleOtherAutoimmuneDisease() {
		toggleComorbidDetailCollapse($('input[name=comorbid_other_autoimmune_disease]'));
		$('input[name=other_autoimmune_disease_dx_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}
	
	function toggleTB() {
		toggleComorbidDetailCollapse($('input[name=comorbid_TB]'));
		$('input[name=TB_at_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleDementia() {
		toggleComorbidDetailCollapse($('input[name=comorbid_dementia]'));
		$('input[name=dementia_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function togglePsychiatricIllness() {
		toggleComorbidDetailCollapse($('input[name=comorbid_psychiatric_illness]'));
		$('input[name=psychiatric_illness_dx_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	$(document).ready(function(){
		$('input[name=reason_admit]').click(function() {toggleReasonAdmitOther();}); // add event to reason_admit.

		$('input[name=comorbid_DM]').click(function() {toggleComorbidDetailCollapse($(this));});  // DM.

		$('input[name=comorbid_CAD]').click(function() {toggleCAD();}); // CAD.

		$('input[name=CAD_dx]').click(function() {getOtherText($(this),"radio");}); // CAD_dx choice.

		$('input[name=comorbid_VHD]').click(function() {toggleVHD();}); // VHD choice.

		$('input[name=comorbid_stroke]').click(function() {toggleComorbidDetailCollapse($(this));});  // stroke.

		$('input[name=comorbid_CKD]').click(function() {toggleComorbidDetailCollapse($(this));});  // CKD.

		$('input[name=comorbid_hyperlipidemia]').click(function() {toggleComorbidDetailCollapse($(this));});  // hyperlipidemia.

		$('input[name=comorbid_cirrhosis]').click(function() {toggleCirrhosis();});  // cirrhosis.

		$('input[name=comorbid_HIV]').click(function() {toggleHIV();});  // HIV.

		$('input[name=comorbid_epilepsy]').click(function() {toggleEpilepsy();});  // epilepsy.

		$('input[name=epilepsy_dx]').click(function() {getOtherText($(this),"radio");}); // epilepsy_dx choice.

		$('input[name=comorbid_leukemia]').click(function() {toggleComorbidDetailCollapse($(this));});  // leukemia.

		$('input[name=comorbid_lymphoma]').click(function() {toggleLymphoma();});  // lymphoma. 

		$('#lymphoma_dx_select').change(function() {getOtherText($(this),"select");});  // lymphoma_dx select.

		$('input[name=comorbid_pacemaker_implant]').click(function() {togglePaceMakerImplant();});  // pacemaker implant.

		$('input[name=pacemaker_implant_type]').click(function() {getOtherText($(this),"radio");}); // pacemaker_implant_type.

		$('input[name=comorbid_ICD]').click(function() {toggleICD();});  // ICD.

		$('input[name=comorbid_cancer]').click(function() {toggleCancer();});  // cancer.

		$('input[name=comorbid_chronic_arthritis]').click(function() {toggleChronicArthritis();});  // chronic_arthritis_other.

		$('input[name=comorbid_other_autoimmune_disease]').click(function() {toggleOtherAutoimmuneDisease();});  // other autoimmune disease.

		$('input[name=comorbid_TB]').click(function() {toggleTB();});  // TB.

		$('input[name=comorbid_dementia]').click(function() {toggleDementia();});  // comorbid_dementia.

		$('input[name=comorbid_psychiatric_illness]').click(function() {togglePsychiatricIllness();});  // comorbid_psychiatric_illness.

		// triger event on document ready.
		toggleReasonAdmitOther(); // reason_admit.
		toggleComorbidDetailCollapse($('input[name=comorbid_DM]')); // DM choice.
		toggleCAD(); // All CAD procedure.
		toggleVHD(); // All VHD procedure.
		toggleComorbidDetailCollapse($('input[name=comorbid_stroke]')); // stroke choice.
		toggleComorbidDetailCollapse($('input[name=comorbid_CKD]')); // CKD choice.
		toggleComorbidDetailCollapse($('input[name=comorbid_hyperlipidemia]')); // hyperlipidemia choice.
		toggleCirrhosis(); // cirrhosis choice.
		toggleHIV(); // HIV choice.
		toggleEpilepsy(); // epilepsy choice.
		toggleComorbidDetailCollapse($('input[name=comorbid_leukemia]')); // leukemia choice.
		toggleLymphoma(); // lymphoma.
		togglePaceMakerImplant(); // comorbid pacemaker implant.
		toggleICD(); // ICD choice.
		toggleCancer(); // cancer choice.
		toggleChronicArthritis(); // chronic_arthritis_other choice.
		toggleOtherAutoimmuneDisease(); // other autoimmune disease.
		toggleTB(); // TB
		toggleDementia(); // comorbid_dementia.
		togglePsychiatricIllness(); // comorbid_psychiatric_illness
	});
</script>

<!-- Part Note -->
<!-- <div class="panel panel-primary">
	<div class="panel-heading"></div> 
	<div class="panel-body">
	</div>
</div> -->
<input id="save_form" style="display:none;" type="submit" value="Save">
{!! Form::close() !!}

@endsection
