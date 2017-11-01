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
@endsection

@section('content')
{!! Form::open(['url' => '/', 'id' => 'admission_note']) !!}
<!-- main panel group -->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<!-- preliminary panel -->
	<div class="panel panel-default	">
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
					<!-- blid HN -->
					<div class='col-md-6 form-group'>
						{!! Form::label('HN','HN :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-4'> {!! Form::number('HN',null,['class' => 'form-control']) !!} </div>
					</div>

					<!-- blind patient_name -->
					<div class='col-md-6 form-group'>
						{!! Form::label('patient_name','Patient :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'> {!! Form::text('patient_name',null,['class' => 'form-control', 'value' => 'สมหญิง จริงนะ']) !!} </div>
					</div><!-- end of row 1 -->

					<!-- row 2 gender age -->
					<!-- blind gender -->
					<div class='col-md-6 form-group'>
						{!! Form::label('gender','Gender :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-4'> {!! Form::text('gender',null,['class' => 'form-control']) !!} </div>
					</div>
					<!-- blind age-->
					<div class='col-md-6 form-group'>
						{!! Form::label('age','Age :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-4'> {!! Form::number('age',null,['class' => 'form-control','required']) !!} </div>
					</div><!-- end of row 2 -->

					<!-- row 3 AN date_admit -->
					<!-- blind AN -->
					<div class='col-md-6 form-group'>
						{!! Form::label('AN','AN :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-4'> {!! Form::number('AN',null,['class' => 'form-control', 'value' => '58352436']) !!} </div>
					</div>
					<!-- input datetimepicker date_admit -->
					<div class='form-group col-md-6'>
						{!! Form::label('date_admit','Date admit :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'>
							<div class="input-group date" id='datetimepicker_date_admit'>
			                    <input type='text' class="form-control" name="date_admit"/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
			                    <script type="text/javascript">
						            $(function () {
						                $('#datetimepicker_date_admit').datetimepicker({
						                    locale: 'th',
						                    format: 'YYYY-MM-DD',
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
						<div class='col-md-9'> {!! Form::text('ward',null,['class' => 'form-control','placeholder' => 'type to auto-complete']) !!} </div>
					</div>
					<!-- autocomplete attending -->
					<div class='col-md-6 form-group'>
						{!! Form::label('attending','Attending staff :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'> {!! Form::text('attending',null,['class' => 'form-control ui-widget', 'placeholder' => 'type to auto-complete']) !!} </div>
						<script type="text/javascript">
							$(function() {
							    var staffs = [
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
	<div class="panel panel-default	">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				History
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			<div class="panel-body">
				<!-- <div class="form"> -->
				<!-- textarea chief_complant -->
				<div class="form-group col-md-12"><h3>Chief complant</h3></div>
				<div class='form-group'>
					<!-- {!! Form::label('chief_complant','Chief complant :',['class' => 'control-label']) !!} -->
					{!! Form::textarea('chief_complant',null,['class' => 'form-control', 'rows' => '1']) !!}
					
				</div>
				<hr/>


				<!-- <h3>Co-morbid</h3> -->
				<!-- radio comorbid_check -->
				<div class="form-group col-md-12"><h3>Co-morbid</h3><hr/></div>
				<!-- <p>{!! Form::label('comorbid_check','Co-morbid :',['class' => 'control-label']) !!}</p> -->
				<div class="form-group col-md-2">
					<label class="radio-inline">
				    	<input type="radio" name="comorbid_check" class="comorbidCheck" value="-1" onclick="toggleComorbid('comorbid_check','#comorbidList')">No data all
				    </label>
			    </div>
			    <div class="form-group col-md-2">
				    <label class="radio-inline">
				    	<input type="radio" name="comorbid_check" class="comorbidCheck" value="0" onclick="toggleComorbid('comorbid_check','#comorbidList')">No co-morbid disease
				    </label>
			    </div>
			    <div class="form-group col-md-2">
				    <label class="radio-inline">
				    	<input type="radio" name="comorbid_check" class="comorbidCheck" value="1" onclick="toggleComorbid('comorbid_check','#comorbidList')">Show co-morbid list
				    </label>
			    </div>
			    <div class="form-group col-md-6">
				    <label class="radio-inline">
				    	<input type="radio" name="comorbid_check" class="comorbidCheck" value="-2" onclick="toggleComorbid('comorbid_check','#comorbidList')">Hide co-morbid list
				    </label>
			    </div>
				<script type="text/javascript">
	                function toggleComorbid(radioName,toggleName){
	                    if ($('input[name=' +  radioName + ']:checked', '#admission_note').val() < 1){
	                    	$(toggleName).collapse('hide');
	                    } else {
	                    	$(toggleName).collapse('show');
	                    }
	                }
	            </script>
	            <!-- </div> -->
	            <div class="col-md-12"><hr></div>
	            <!-- Comorbid list -->
	            <div class="form-horizontal row collapse in" id="comorbidList">
					<!-- input radio DM -->
					<div class='form-group col-md-6'>
						{!! Form::label('DM','DM :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="DM" onclick="toggleComorbid('DM','#dmCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="DM" onclick="toggleComorbid('DM','#dmCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="DM" onclick="toggleComorbid('DM','#dmCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class='row col-md-offset-6'></div>

					<div class="collapse" id="dmCollapse">
						<!-- DM_type -->
						<div class='form-group col-md-6'>
							{!! Form::label('DM_type','DM Type :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<label class="radio-inline">
							    	<input type="radio"Te="DM_type" value="1">Type I
							    </label>
							    <label class="radio-inline">
							    	<input type="radio" name="DM_type" value="2">Type II
							    </label>
							</div>
						</div>
						<div class="col-md-12"></div>

						<!-- aids_previouse_infection -->
						<div class='form-group col-md-6'>
							{!! Form::label('DM_complication','DM Complication :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<!-- DM_DR -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='DM_DR'>DR
							        </label>
							    </div>
							    <!-- DM_nephropathy -->
								<div class="checkbox col-md-4">
							        <label>
							          <input type="checkbox" name='DM_nephropathy'>Nephropathy
							        </label>
							    </div>
							    <!-- DM_neuropathy -->
								<div class="checkbox col-md-4">
							        <label>
							          <input type="checkbox" name='DM_neuropathy'>Neuropathy
							        </label>
							    </div>
						    </div>
						</div>
						<div class="col-md-12"></div>

						<!-- DM_on -->
						<div class='form-group col-md-6'>
							{!! Form::label('DM_complication','On :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<!-- DM_on_diet -->
								<div class="checkbox col-md-5">
							        <label>
							          <input type="checkbox" name='DM_on_diet'>Diet control
							        </label>
							    </div>
							    <!-- DM_on_oral_med -->
								<div class="checkbox col-md-5">
							        <label>
							          <input type="checkbox" name='DM_on_oral_med'>Oral medication
							        </label>
							    </div>
							    <!-- DM_on_insulin -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='DM_on_insulin'>Insulin
							        </label>
							    </div>
						    </div>
						</div>
					</div><!-- end of DM -->

					<div class="col-md-12"><hr></div>
					<!-- radio HT -->
					<div class='form-group col-md-6'>
						{!! Form::label('HT','HT :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="HT" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HT" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HT" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio HT -->

					<div class="col-md-12"><hr></div>
					
					<!-- radio CAD -->
					<div class='form-group col-md-6'>
						<label class="control-label col-md-4">CAD[<a title="Coronary artery disease">*</a>] :</label>
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('CAD',-1) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('CAD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('CAD',1) !!}Yes</label>
						</div>

						<script type="text/javascript">
							$("input[name='CAD'][value='-1']").attr('onclick',"$('#cadCollapse').collapse('hide')");
							$("input[name='CAD'][value='0']").attr('onclick',"$('#cadCollapse').collapse('hide')");
							$("input[name='CAD'][value='1']").attr('onclick',"$('#cadCollapse').collapse('show')");
						</script>
					</div>
					

					<div class="collapse col-md-12" id="cadCollapse" >
						{!! Form::label('cad_type','CAD Type :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-5'>
							<label class="radio-inline">{!! Form::radio('CAD_type',1) !!}Old MI</label>
							<label class="radio-inline">{!! Form::radio('CAD_type',2) !!}unstable angina</label>
							<label class="radio-inline">{!! Form::radio('CAD_type',3) !!}stable angina</label>
							<label class="radio-inline">{!! Form::radio('CAD_type',0) !!}others</label>
						</div>
						<div class='col-md-4'> {!! Form::text('CAD_other',null,['class' => 'form-control', 'readonly']) !!} </div>
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
					</div>
					<!-- end radio CAD -->

					<div class="col-md-12"><hr></div>
					<!-- radio VHD -->
					<div class='form-group col-md-6'>
						{!! Form::label('VHD','Valvular heart disease :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="VHD" onclick="toggleComorbid('VHD','#vhdCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="VHD" onclick="toggleComorbid('VHD','#vhdCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="VHD" onclick="toggleComorbid('VHD','#vhdCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					
					<!-- VHD_collapse -->
					<div class="collapse col-md-12" id="vhdCollapse" >
						<div class='row col-md-5 col-md-offset-1'>
							<!-- VHD_AS -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" name='VHD_AS'>AS
						        </label>
						    </div>
						    <!-- VHD_AR -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" name='VHD_AR'>AR
						        </label>
						    </div>
						    <!-- VHD_MS -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" name='VHD_MS'>MS
						        </label>
						    </div>
						    <!-- VHD_MR -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" name='VHD_MR'>MR
						        </label>
						    </div>
						    <!-- VHD_TR -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" name='VHD_TR'>TR
						        </label>
						    </div>
						    <!-- </div> -->
						</div>
						<!-- text VHD_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('VHD_other','Other :',['class' => 'control-label col-md-2']) !!}
							<div class='col-md-8'> {!! Form::text('VHD_other',null,['class' => 'form-control']) !!} </div>
						</div>
					</div><!-- end radio VHD -->

					<div class="col-md-12"><hr></div>
					<!-- radio stroke -->
					<div class='form-group col-md-6'>
						{!! Form::label('stroke','Stroke :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="stroke" onclick="toggleComorbid('stroke','#strokeCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="stroke" onclick="toggleComorbid('stroke','#strokeCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="stroke" onclick="toggleComorbid('stroke','#strokeCollapse')" value="1">Yes
						    </label>
						</div>
					</div>

					<!-- stroke_collapse -->
					<div class="collapse col-md-12" id="strokeCollapse" >
						<div class='row col-md-5 col-md-offset-1'>
							<!-- stroke_ischemic -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='stroke_ischemic'>ischemic
						        </label>
						    </div>
						    <!-- stroke_embolic -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='stroke_embolic'>embolic
						        </label>
						    </div>
						    <!-- stroke_hemorrhagic -->
							<div class="checkbox col-md-3">
						        <label>
						          <input type="checkbox" name='stroke_hemorrhagic'>hemorrhagic
						        </label>
						    </div>
						</div>
					</div><!-- end radio stroke -->

					<div class="col-md-12"><hr></div>
					<!-- radio COPD -->
					<div class='form-group col-md-6'>
						{!! Form::label('COPD','COPD :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="COPD" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="COPD" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="COPD" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio COPD -->

					<div class="col-md-12"><hr></div>
					<!-- radio asthma -->
					<div class='form-group col-md-6'>
						{!! Form::label('asthma','Asthma :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="asthma" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="asthma" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="asthma" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio asthma -->

					<div class="col-md-12"><hr></div>
					<!-- input radio CKD -->
					<div class='form-group col-md-6'>
						{!! Form::label('CKD','Chronic kidney disease :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="CKD" onclick="toggleComorbid('CKD','#ckdCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD" onclick="toggleComorbid('CKD','#ckdCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD" onclick="toggleComorbid('CKD','#ckdCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<!-- CKD_stage -->
					<div class="col-md-12 form-group collapse" id="ckdCollapse">
						{!! Form::label('CKD_stage','Stage :',['class' => 'col-md-2 control-label']) !!}
						<div class='col-md-1'>
							<label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="1">I
						    </label>
						</div>
						<div class='col-md-1'>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="2">II
						    </label>
						</div>
					    <div class='col-md-1'>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="3">III
						    </label>
						</div>
					    <div class='col-md-1'>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="4">IV
						    </label>
						</div>
					    <div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="5">V no dialysis
						    </label>
						</div>
					    <div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="6">V on HD
						    </label>
						</div>
					    <div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="CKD_stage" value="7">V on PD
						    </label>
						</div>
					</div><!-- input radio CKD -->

					<div class="col-md-12"><hr></div>
					<!-- input radio hyperlipidemia -->
					<div class='form-group col-md-6'>
						{!! Form::label('hyperlipidemia','Hyperlipidemia :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="hyperlipidemia" onclick="toggleComorbid('hyperlipidemia','#hyperlipidemiaCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="hyperlipidemia" onclick="toggleComorbid('hyperlipidemia','#hyperlipidemiaCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="hyperlipidemia" onclick="toggleComorbid('hyperlipidemia','#hyperlipidemiaCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="col-md-12 form-group collapse" id="hyperlipidemiaCollapse">
						<!-- hyperlipidemia_type -->
						{!! Form::label('','Please select one :',['class' => 'col-md-2 control-label']) !!}
						<div class='col-md-2'>
							<label class="radio-inline">
						    	<input type="radio" name="hyperlipidemia_type" value="1">Hypercholesterolemia
						    </label>
						</div>
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="hyperlipidemia_type" value="2">Hypertriglyceridemia
						    </label>
						</div>
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="hyperlipidemia_type" value="3">Mixed-hyperlipidemia
						    </label>
						</div>
					</div><!-- input radio hyperlipidemia -->

					<div class="col-md-12"><hr></div>
					<!-- input radio cirrhosis -->
					<div class='form-group col-md-6'>
						{!! Form::label('cirrhosis','Cirrhosis :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="cirrhosis" onclick="toggleComorbid('cirrhosis','#cirrhosisCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="cirrhosis" onclick="toggleComorbid('cirrhosis','#cirrhosisCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="cirrhosis" onclick="toggleComorbid('cirrhosis','#cirrhosisCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="collapse" id="cirrhosisCollapse">
						<!-- Child-Pugh scrore -->
						<div class="col-md-6 form-group">
						<label for="" class="col-md-4 control-label">Child-Pugh score[<a onclick="toggleCPScoring()">View</a>] :</label>
							<div class='col-md-8'>
								<label class="radio-inline col-md-1">
							    	<input type="radio" name="cirrhosis_cp_score" value="A">A
							    </label>
							    <label class="radio-inline col-md-1">
							    	<input type="radio" name="cirrhosis_cp_score" value="B">B
							    </label>
							    <label class="radio-inline col-md-1">
							    	<input type="radio" name="cirrhosis_cp_score" value="C">C
							    </label>
								<script type="text/javascript">
									function toggleCPScoring(){
										$('#cirrhosisCPScoreCollapse').collapse('toggle');
									}
								</script>
							</div>
						</div>
						<!-- Refferance -->
						<div class="collapse col-md-12" id="cirrhosisCPScoreCollapse">
								@include('cpscore')
						</div>
						<div class="row col-md-offset-6"></div>
						<!-- cirrhosis_etiology -->
						<div class='form-group col-md-6'>
							<!-- cirrhosis_etiology_HBV -->
							{!! Form::label('cirrhosis_cp_score','Etiology :',['class' => 'control-label col-md-4']) !!}
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" class="knownEtiology" onclick="dependencyHB_HC('HBV')" name='cirrhosis_etiology_HBV'>HBV
						        </label>
						    </div>
						    <script type="text/javascript">
						    	function dependencyHB_HC(radioName){
						    		switch (radioName) {
						    			case 'HBV' :
						    				$("input[name='HBV'][value='1']").prop('checked', true);
						    				break;
						    			case 'HCV' :
						    				$("input[name='HCV'][value='1']").prop('checked', true);
						    				break;
						    		}
						    		// $('input[name=' +  radioName + ']', '#admission_note').val('1');
						    		//$("input[name=mygroup][value="1"]").prop('checked', true);

						    	}
						    </script>
						    <!-- cirrhosis_etiology_HCV -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" class="knownEtiology" onclick="dependencyHB_HC('HCV')" name='cirrhosis_etiology_HCV'>HCV
						        </label>
						    </div>
						    <!-- cirrhosis_etiology_NASH -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" class="knownEtiology" name='cirrhosis_etiology_NASH'>NASH
						        </label>
						    </div>
						    <!-- cirrhosis_etiology_cryptogenic -->
							<div class="checkbox col-md-2">
						        <label>
						          <input type="checkbox" name='cirrhosis_etiology_cryptogenic' onclick="unknownEtiology()" id="cirrhosis_etiology_cryptogenic">Cryptogenic
						        </label>
						    </div>
						    <script type="text/javascript">
						    	function unknownEtiology(){
						    		if ($('#cirrhosis_etiology_cryptogenic').prop('checked')) {
						    			$('.knownEtiology').prop('disabled',true);
						    			$('.knownEtiology').prop('checked',false);
						    			$('.knownEtiology').val('');
						    		} else {
						    			$('.knownEtiology').prop('disabled',false);
						    		}
						    	}
						    </script>
						</div>
					    <!-- cirrhosis_etiology_other -->
					    <div class='col-md-6 form-group'>
							{!! Form::label('cirrhosis_etiology_other','Other :',['class' => 'control-label col-md-2']) !!}
							<div class='col-md-10'> {!! Form::text('cirrhosis_etiology_other',null,['class' => 'form-control knownEtiology']) !!} </div>
						</div>
					</div><!-- input radio cirrhosis -->

					<div class="col-md-12"><hr></div>
					<!-- radio coagulopathy -->
					<div class='form-group col-md-6'>
						{!! Form::label('coagulopathy','Coagulopathy :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="coagulopathy" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="coagulopathy" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="coagulopathy" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio coagulopathy -->

					<div class="col-md-12"><hr></div>
					<!-- radio HBV -->
					<div class='form-group col-md-6'>
						{!! Form::label('HBV','HBV infection :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="HBV" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HBV" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HBV" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio HBV -->

					<div class="col-md-12"><hr></div>
					<!-- radio HCV -->
					<div class='form-group col-md-6'>
						{!! Form::label('HCV','HCV infection :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="HCV" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HCV" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HCV" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio HCV -->

					<div class="col-md-12"><hr></div>
					<!-- input radio cancer -->
					<div class='form-group col-md-6'>
						{!! Form::label('HIV','HIV :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="HIV" onclick="toggleHIVCollapse('HIV','#HIVCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HIV" onclick="toggleHIVCollapse('HIV','#HIVCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HIV" onclick="toggleHIVCollapse('HIV','#HIVCollapse')" value="1">HIV infection
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="HIV" onclick="toggleHIVCollapse('HIV','#HIVCollapse')" value="2">AIDS
						    </label>
						</div>
						<script type="text/javascript">
							function toggleHIVCollapse(radioName,toggleName){
	                            if ($('input[name=' +  radioName + ']:checked', '#admission_note').val() != 2){
	                            	$(toggleName).collapse('hide');
	                            } else {
	                            	$(toggleName).collapse('show');
	                            }
	                        }
						</script>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="HIVCollapse">
						<!-- aids_previouse_infection -->
						<div class='form-group col-md-6'>
							{!! Form::label('aids_previouse_infection','Previous opportunistic infection :',['class' => 'control-label col-md-6']) !!}
							<!-- <div class='col-md-6'> -->
								<!-- AIDS_TB -->
								<div class="checkbox col-md-1"><!-- auto check TB -->
							        <label>
							          <input type="checkbox" name='AIDS_TB' onclick=''>TB
							        </label>
							    </div>
							    <!-- AIDS_PCP -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='AIDS_PCP'>PCP
							        </label>
							    </div>
							    <!-- AIDS_candidiasis -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='AIDS_candidiasis'>Candidiasis
							        </label>
							    </div>
							    <!-- AIDS_CMV -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='AIDS_CMV'>CMV
							        </label>
							    </div>
						    <!-- </div> -->
						</div>
						<!-- AIDS_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('AIDS_other','Other :',['class' => 'control-label col-md-2']) !!}
							<div class='col-md-10'> {!! Form::text('AIDS_other',null,['class' => 'form-control']) !!} </div>
						</div>
					</div>

					<div class="col-md-12"><hr></div>
					<!-- input radio epilepsy -->
					<div class='form-group col-md-6'>
						{!! Form::label('epilepsy','Epilepsy :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="epilepsy" onclick="toggleComorbid('epilepsy','#epilepsyCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="epilepsy" onclick="toggleComorbid('epilepsy','#epilepsyCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="epilepsy" onclick="toggleComorbid('epilepsy','#epilepsyCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="col-md-12 form-group collapse" id="epilepsyCollapse">
						<!-- epilepsy_type -->
						{!! Form::label('','Please select one :',['class' => 'col-md-2 control-label']) !!}
						<div class='col-md-1'>
							<label class="radio-inline">
						    	<input type="radio" name="epilepsy_type" value="1">GTC
						    </label>
						</div>
						<div class='col-md-1'>
						    <label class="radio-inline">
						    	<input type="radio" name="epilepsy_type" value="2">Focal
						    </label>
						</div>						
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="epilepsy_type" value="3">Complex partial seizure
						    </label>
						</div>
						<div class='col-md-1'>
						    <label class="radio-inline">
						    	<input type="radio" name="epilepsy_type" value="0">Unknown
						    </label>
						</div>
						<div class='col-md-4'> {!! Form::text('epilepsy_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
					</div><!-- input radio epilepsy -->

					<div class="col-md-12"><hr></div>
					<!-- input radio leukemia -->
					<div class='form-group col-md-6'>
						{!! Form::label('leukemia','Leukemia :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="leukemia" onclick="toggleComorbid('leukemia','#leukemiaCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="leukemia" onclick="toggleComorbid('leukemia','#leukemiaCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="leukemia" onclick="toggleComorbid('leukemia','#leukemiaCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="col-md-6 form-group collapse" id="leukemiaCollapse">
						<!-- leukemia_type -->
						{!! Form::label('','Please select one :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-2'>
							<label class="radio-inline">
						    	<input type="radio" name="leukemia_type" value="1">ALL
						    </label>
						</div>
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="leukemia_type" value="2">AML
						    </label>
						</div>
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="leukemia_type" value="3">CLL
						    </label>
						</div>
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="leukemia_type" value="4">CML
						    </label>
						</div>
					</div><!-- input radio leukemia -->

					<div class="col-md-12"><hr></div>
					<!-- input radio lymphoma -->
					<div class='form-group col-md-6'>
						{!! Form::label('lymphoma','Lymphoma :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="lymphoma" onclick="toggleComorbid('lymphoma','#lymphomaCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="lymphoma" onclick="toggleComorbid('lymphoma','#lymphomaCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="lymphoma" onclick="toggleComorbid('lymphoma','#lymphomaCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="collapse" id="lymphomaCollapse">
						<!-- lymphoma_type -->
						<div class='form-group col-md-6'>
							{!! Form::label('lymphoma_type','Please select one :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
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
						</div>
						<!-- lymphoma_type_other -->
						<div class='form-group col-md-6'>
							{!! Form::label('lymphoma_type_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class="col-md-8">{!! Form::text('lymphoma_type_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div><!-- input radio lymphoma -->

					<div class="col-md-12"><hr></div>
					<!-- input radio pacemaker_implant -->
					<div class='form-group col-md-6'>
						{!! Form::label('pacemaker_implant','Pacemaker implant :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="pacemaker_implant" onclick="toggleComorbid('pacemaker_implant','#pacemaker_implantCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="pacemaker_implant" onclick="toggleComorbid('pacemaker_implant','#pacemaker_implantCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="pacemaker_implant" onclick="toggleComorbid('pacemaker_implant','#pacemaker_implantCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="col-md-12 form-group collapse" id="pacemaker_implantCollapse">
						<!-- pacemaker_implant_type -->
						{!! Form::label('','Please select one :',['class' => 'col-md-2 control-label']) !!}
						<div class='col-md-3'>
							<label class="radio-inline">
						    	<input type="radio" name="pacemaker_implant_type" value="1">DDDR (dual-chamber, rate-modulated)
						    </label>
						</div>
						<div class='col-md-1'>
						    <label class="radio-inline">
						    	<input type="radio" name="pacemaker_implant_type" value="2">VVI
						    </label>
						</div>
						<div class='col-md-2'>
						    <label class="radio-inline">
						    	<input type="radio" name="pacemaker_implant_type" value="0">Other
						    </label>
						</div>
						<div class='col-md-4'> {!! Form::text('pacemaker_implant_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
					</div><!-- input radio pacemaker_implant -->

					<div class="col-md-12"><hr></div>
					<!-- input radio ICD -->
					<div class='form-group col-md-6'>
						<label class="control-label col-md-4">ICD[<a title="Implantable Cardioverter Defibrillator">?</a>] :</label>
						<!-- {!! Form::label('ICD','ICD :',['class' => 'control-label col-md-4']) !!} -->
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="ICD" onclick="toggleComorbid('ICD','#ICDCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="ICD" onclick="toggleComorbid('ICD','#ICDCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="ICD" onclick="toggleComorbid('ICD','#ICDCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>

					<div class="collapse" id="ICDCollapse">
						<!-- ICD_type -->
						<div class='form-group col-md-6'>
							{!! Form::label('ICD_type','ICD Type :',['class' => 'control-label col-md-4']) !!}
							<div class="col-md-8">{!! Form::text('ICD_type',null,['class' => 'form-control', 'placeholder' => 'enter ICD type here']) !!} </div>
						</div>
					</div><!-- input radio ICD -->

					<div class="col-md-12"><hr></div>
					<!-- input radio cancer -->
					<div class='form-group col-md-6'>
						{!! Form::label('cancer','Cancer :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="cancer" onclick="toggleComorbid('cancer','#cancerCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="cancer" onclick="toggleComorbid('cancer','#cancerCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="cancer" onclick="toggleComorbid('cancer','#cancerCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="cancerCollapse">
						<!-- cancer_organ -->
						<div class='form-group col-md-12'>
							{!! Form::label('cancer_organ','Please select organ :',['class' => 'control-label col-md-2']) !!}
							<!-- <div class='col-md-6'> -->
								<!-- cancer_lung -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_lung'>Lung
							        </label>
							    </div>
							    <!-- cancer_liver -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_liver'>Liver
							        </label>
							    </div>
							    <!-- cancer_colon -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_colon'>Colon
							        </label>
							    </div>
							    <!-- cancer_breast -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_breast'>Breast
							        </label>
							    </div>
							    <!-- cancer_prostate -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_prostate'>Prostate
							        </label>
							    </div>
							    <!-- cancer_cervix -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_cervix'>Cervix
							        </label>
							    </div>
							    <!-- cancer_pancreas -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_pancreas'>Pancreas
							        </label>
							    </div>
							    <!-- cancer_brain -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_brain'>Brain
							        </label>
							    </div>
							    <!-- cancer_nasopharynx -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='cancer_nasopharynx'>Nasopharynx
							        </label>
							    </div>

						    <!-- </div> -->
						</div>
						<!-- cancer_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('cancer_other','Other organ :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('cancer_other',null,['class' => 'form-control', 'placeholder' => 'Other organ type here']) !!} </div>
						</div>
					</div><!-- end radio cancer -->

					<div class="col-md-12"><hr></div>
					<!-- input radio chronic_arthritis -->
					<div class='form-group col-md-6'>
						{!! Form::label('chronic_arthritis','Chronic arthritis :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="chronic_arthritis" onclick="toggleComorbid('chronic_arthritis','#chronic_arthritisCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="chronic_arthritis" onclick="toggleComorbid('chronic_arthritis','#chronic_arthritisCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="chronic_arthritis" onclick="toggleComorbid('chronic_arthritis','#chronic_arthritisCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="chronic_arthritisCollapse">
						<!-- chronic_arthritis_organ -->
						<div class='form-group col-md-12'>
							{!! Form::label('chronic_arthritis_organ','Please select :',['class' => 'control-label col-md-2']) !!}
								<!-- chronic_arthritis_gout -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='chronic_arthritis_gout'>Gout
							        </label>
							    </div>
							    <!-- chronic_arthritis_CPPD -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='chronic_arthritis_CPPD'>CPPD[<a title="Calcium pyrophosphate dihydrate">?</a>]
							        </label>
							    </div>
							    <!-- chronic_arthritis_rheumatoid -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='chronic_arthritis_rheumatoid'>Rheumatoid arthritis
							        </label>
							    </div>
							    <!-- chronic_arthritis_OA -->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='chronic_arthritis_OA'>OA[<a title="Osteoarthritis">?</a>]
							        </label>
							    </div>
							    <!-- chronic_arthritis_spondyloarthropathy -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='chronic_arthritis_spondyloarthropathy'>Spondyloarthropathy
							        </label>
							    </div>
						</div>
						<!-- chronic_arthritis_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('chronic_arthritis_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('chronic_arthritis_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div><!-- end radio chronic_arthritis -->

					<div class="col-md-12"><hr></div>
					<!-- radio SLE -->
					<div class='form-group col-md-6'>
						{!! Form::label('SLE','SLE :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="SLE" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="SLE" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="SLE" value="1">Yes
						    </label>
						</div>
					</div><!-- end radio SLE -->

					<div class="col-md-12"><hr></div>
					<!-- input radio other_autoimmune_disease -->
					<div class='form-group col-md-6'>
						{!! Form::label('other_autoimmune_disease','Other autoimmune disease :',['class' => 'control-label col-md-5']) !!}
						<div class='col-md-7'>
							<label class="radio-inline">
						    	<input type="radio" name="other_autoimmune_disease" onclick="toggleComorbid('other_autoimmune_disease','#other_autoimmune_diseaseCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="other_autoimmune_disease" onclick="toggleComorbid('other_autoimmune_disease','#other_autoimmune_diseaseCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="other_autoimmune_disease" onclick="toggleComorbid('other_autoimmune_disease','#other_autoimmune_diseaseCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="other_autoimmune_diseaseCollapse">
						<!-- other_autoimmune_disease_organ -->
						<div class='form-group col-md-12'>
							{!! Form::label('other_autoimmune_disease_organ','Please select :',['class' => 'control-label col-md-2']) !!}
								<!-- other_autoimmune_sjrogren_syndrome -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='other_autoimmune_sjrogren_syndrome'>Sjrögren syndrome
							        </label>
							    </div>
							    <!-- other_autoimmune_UCTD  Undifferentiated Connective Tissue Disease-->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='other_autoimmune_UCTD'>UCTD[<a title="Undifferentiated Connective Tissue Disease">?</a>]
							        </label>
							    </div>
							    <!-- other_autoimmune_MCTD Mixed Connective Tissue Disease-->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='other_autoimmune_MCTD'>MCTD[<a title="Mixed Connective Tissue Disease">?</a>]
							        </label>
							    </div>
							    <!-- other_autoimmune_DMPM DermatoMyositisPolyMyositis-->
								<div class="checkbox col-md-1">
							        <label>
							          <input type="checkbox" name='other_autoimmune_DMPM'>DMPM[<a title="Dermato Myositis Poly Myositis">?</a>]
							        </label>
							    </div>
						</div>
						<!-- other_autoimmune_disease_other -->
						<div class='col-md-12 form-group'>
							{!! Form::label('other_autoimmune_disease_other','Other :',['class' => 'control-label col-md-2']) !!}
							<div class='col-md-4'> {!! Form::text('other_autoimmune_disease_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div><!-- end radio other_autoimmune_disease -->

					<div class="col-md-12"><hr></div>
					<!-- input radio TB -->
					<div class='form-group col-md-6'>
						{!! Form::label('TB','TB :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="TB" onclick="toggleComorbid('TB','#TBCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="TB" onclick="toggleComorbid('TB','#TBCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="TB" onclick="toggleComorbid('TB','#TBCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="TBCollapse">
						<!-- TB_organ -->
						<div class='form-group col-md-6'>
							{!! Form::label('TB_organ','Please select :',['class' => 'control-label col-md-4']) !!}
								<!-- TB_pulmonary -->
								<div class="checkbox col-md-4">
							        <label>
							          <input type="checkbox" name='TB_pulmonary'>Pulmonary
							        </label>
							    </div>
						</div>
						<!-- TB_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('TB_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('TB_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div><!-- end radio TB -->

					<div class="col-md-12"><hr></div>
					<!-- input radio dementia -->
					<div class='form-group col-md-6'>
						{!! Form::label('dementia','Dementia :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="dementia" onclick="toggleComorbid('dementia','#dementiaCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="dementia" onclick="toggleComorbid('dementia','#dementiaCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="dementia" onclick="toggleComorbid('dementia','#dementiaCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="dementiaCollapse">
						<!-- dementia_organ -->
						<div class='form-group col-md-6'>
							{!! Form::label('dementia_organ','Please select :',['class' => 'control-label col-md-4']) !!}
								<!-- dementia_vascular -->
								<div class="checkbox col-md-3">
							        <label>
							          <input type="checkbox" name='dementia_vascular'>Vascular
							        </label>
							    </div>
							    <!-- dementia_alzheimer -->
								<div class="checkbox col-md-3">
							        <label>
							          <input type="checkbox" name='dementia_alzheimer'>Alzheimer
							        </label>
							    </div>
						</div>
						<!-- dementia_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('dementia_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('dementia_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div><!-- end radio dementia -->

					<div class="col-md-12"><hr></div>
					<!-- input radio psychiatric_illness -->
					<div class='form-group col-md-6'>
						{!! Form::label('psychiatric_illness','Psychiatric illness :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">
						    	<input type="radio" name="psychiatric_illness" onclick="toggleComorbid('psychiatric_illness','#psychiatric_illnessCollapse')" value="-1">No data
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="psychiatric_illness" onclick="toggleComorbid('psychiatric_illness','#psychiatric_illnessCollapse')" value="0">No
						    </label>
						    <label class="radio-inline">
						    	<input type="radio" name="psychiatric_illness" onclick="toggleComorbid('psychiatric_illness','#psychiatric_illnessCollapse')" value="1">Yes
						    </label>
						</div>
					</div>
					<div class="row col-md-offset-6"></div>
					<div class="collapse" id="psychiatric_illnessCollapse">
						<!-- psychiatric_illness_organ -->
						<div class='form-group col-md-12'>
							{!! Form::label('psychiatric_illness_organ','Please select :',['class' => 'control-label col-md-2']) !!}
								<!-- psychiatric_illness_schizophrenia -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='psychiatric_illness_schizophrenia'>Schizophrenia
							        </label>
							    </div>
							    <!-- psychiatric_illness_major_depression -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='psychiatric_illness_major_depression'>Major depression
							        </label>
							    </div>
							    <!-- psychiatric_illness_bipolar_disorder -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='psychiatric_illness_bipolar_disorder'>Bipolar disorder
							        </label>
							    </div>
							    <!-- psychiatric_illness_adjustment_disorder -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='psychiatric_illness_adjustment_disorder'>Adjustment disorder
							        </label>
							    </div>
							    <!-- psychiatric_illness_Obcessive_compulsive_disorder -->
								<div class="checkbox col-md-2">
							        <label>
							          <input type="checkbox" name='psychiatric_illness_Obcessive_compulsive_disorder'>OCD[<a title="Obcessive compulsive disorder">?</a>]
							        </label>
							    </div>
						</div>
						<!-- psychiatric_illness_other -->
						<div class='col-md-6 form-group'>
							{!! Form::label('psychiatric_illness_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('psychiatric_illness_other',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
						</div>
					</div><!-- end radio psychiatric_illness -->

					<div class="col-md-12"><hr></div>
					<!-- other_comorbid -->
					<div class='col-md-12 form-group'>
						{!! Form::label('other_comorbid','Other co-morbid :',['class' => 'control-label col-md-2']) !!}
						<div class='col-md-10'> {!! Form::text('other_comorbid',null,['class' => 'form-control', 'placeholder' => 'Other type here']) !!} </div>
					</div>
	            </div><!-- end of Comorbid list -->

	            <div class="col-md-12"><hr></div>
	            <!-- textarea history_illness_present -->
				<div class='form-group'>
					{!! Form::label('history_illness_present','History of present illness :',['class' => 'control-label']) !!}
					{!! Form::textarea('history_illness_present',null,['class' => 'form-control', 'rows' => '1']) !!}
				</div>

				<!-- textarea history_illness_past -->
				<div class='form-group'>
					{!! Form::label('history_illness_past','History of past illness :',['class' => 'control-label']) !!}
					{!! Form::textarea('history_illness_past',null,['class' => 'form-control', 'rows' => '1']) !!}
				</div>

				<!-- Personal and Social history -->
				<div class="form-group col-md-12"><h3>Personal and Social history</h3><hr/></div>
				<div class="form-horizontal row">
					<!-- for women section collapse -->
					<div class="collapse in">
						<!-- pregnant_weeks -->
						<div class="col-md-6 form-group">
							{!! Form::label('','Pregnant :',['class' => 'col-md-4 control-label']) !!}
							<div class='col-md-2'>
								<label class="radio-inline">
							    	<input type="radio" name="pregnant_weeks" value="-1">Uncertain
							    </label>
							</div>
							<div class='col-md-2'>
							    <label class="radio-inline">
							    	<input type="radio" name="pregnant_weeks" value="0">No
							    </label>
							</div>
							<div class='col-md-2'>
							    <label class="radio-inline">
							    	<input type="radio" name="pregnant_weeks" value="1">Yes
							    </label>
							</div>
						</div>
						<!-- pregnant_weeks -->
						<div class="form-group col-md-6">
							{!! Form::label('','Gastation :',['class' => 'col-md-4 control-label']) !!}
							<div class='col-md-4'>
								<div class='input-group'>
									{!! Form::text('pregnant_weeks',null,['class' => 'form-control']) !!}<span class="input-group-addon">Weeks</span>
								</div>
							</div>
						</div>
						<!-- LMP -->
						<div class="form-group col-md-6">
							{!! Form::label('','LMP :',['class' => 'col-md-4 control-label']) !!}
							<div class='col-md-8'>
								<div class='input-group'>
									{!! Form::text('LMP',null,['class' => 'form-control']) !!}<span class="input-group-addon">Date</span>
								</div>
							</div>
						</div>
					</div><!-- input radio prenant -->
					<div class="row col-md-offset-6"></div>

					<!-- alcohol -->
					<div class="col-md-6 form-group">
						{!! Form::label('alcohol','Alcohol :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('alcohol',0) !!}No</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('alcohol',2) !!}Yes</label></div>
						<div class='col-md-3'><label class="radio-inline">{!! Form::radio('alcohol',1) !!}Ex-drinker</label></div>
						<script type="text/javascript">
							function toggleAlcoholTemplate(v) {
								if (v == 0) {
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

					<div class="collapse col-md-12" id="alcoholHelperTemplate">@include('medicine.admission.alcohol')</div>
					
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

					<div class="collapse col-md-12" id="smokingHelperTemplate">@include('medicine.admission.smoking')</div>
					
					<!-- smoking_amount -->
					<div class="form-group col-md-6">
						{!! Form::label('','Smoke amount :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-8'>
							{!! Form::textarea('smoking_amount',null,['class' => 'form-control', 'id' => 'tasmokingAmountReviewDetail', 'rows' => '1', 'readonly']) !!}
						</div>
					</div><!-- end smoking -->
				</div><!-- end Personal and Social history row part-->

				<div class="col-md-12 form-group"><hr/></div>
				<!-- textarea personal_social -->
				<div class='form-group'>
					{!! Form::label('personal_social','Personal and social history :',['class' => 'control-label']) !!}
					{!! Form::textarea('personal_social',null,['class' => 'form-control', 'rows' => '1']) !!}
				</div><!-- end textarea personal_social -->

				<div class="col-md-12 form-group"><hr/></div>
				<!-- special_requirement -->
				<div class='form-group'>
					{!! Form::label('','Special requirement :',['class' => 'control-label']) !!}
				</div>
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

				<div class="col-md-12 form-group"><hr/></div>
				<!-- textarea personal_family_history -->
				<div class='form-group'>
					{!! Form::label('personal_family_history','Family history :',['class' => 'control-label']) !!}
					{!! Form::textarea('personal_family_history',null,['class' => 'form-control','rows' => '1']) !!}
				</div><!-- end textarea personal_family_history -->

				<div class="col-md-12 form-group"><hr/></div>
				<!-- textarea current_medications -->
				<div class='form-group'>
					{!! Form::label('current_medications','Current medications :',['class' => 'control-label']) !!}
					{!! Form::textarea('current_medications','',['class' => 'form-control', 'placeholder' => 'If there is no current medications, leave blank.','rows' => '1']) !!}
				</div><!-- end textarea current_medications -->

				<div class="col-md-12 form-group"><hr/></div>
				<!-- textarea allergy -->
				<div class='form-group'>
					{!! Form::label('allergy','Allergy/Adverse event (Drug, Food, Chemical) :',['class' => 'control-label']) !!}
					{!! Form::textarea('allergy','',['class' => 'form-control', 'placeholder' => 'If there is no allergy, leave blank.','rows' => '1']) !!}
				</div><!-- end textarea allergy -->

				<!-- Review of systems -->
				<div class="form-group col-md-12"><h3>Review of systems</h3><hr/></div>

				<!-- general_symtoms textarea input -->
				<div class='form-group'>
					<label class="control-label" for="general_symtoms">General symtoms : Detail of important findings [<a onclick="toggleTemplate('#gsgCollapse')">Template</a>]</label>
					<!-- 
					<script type="text/javascript" src="{{ url('/assets/script/wordplease-form-0.1.js') }}">
					</script>
					 -->
					 @include('wordplease_js')
					<div class="collapse col-md-12" id="gsgCollapse">@include('medicine.admission.generalSymtomsGenerator')</div>
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
					<div class="collapse col-md-12" id="hairSkinReviewGenCollapse">@include('medicine.admission.hairSkinReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="hrgCollapse">@include('medicine.admission.headReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="eyeENTReviewGenCollapse">@include('medicine.admission.eyeENTReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="breastReviewGenCollapse">@include('medicine.admission.breastReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="cvsReviewGenCollapse">@include('medicine.admission.cvsReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="rsReviewGenCollapse">@include('medicine.admission.rsReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="giReviewGenCollapse">@include('medicine.admission.giReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="guReviewGenCollapse">@include('medicine.admission.guReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="musculoskeletalReviewGenCollapse">@include('medicine.admission.musculoskeletalReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="nervousReviewGenCollapse">@include('medicine.admission.nervousReviewGenerator')</div>
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
					<div class="collapse col-md-12" id="psychologicalReviewGenCollapse">@include('medicine.admission.psychologicalReviewGenerator')</div>
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
	</div><!-- end history panel -->

	<!-- investigation panel -->
	<div class="panel panel-default	">
		<div class="panel-heading" role="tab" id="headingThree">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				Physical examination and investigation
				</a>
			</h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			<div class="panel-body">
				<div class="form-group col-md-12"><h3>Vital signs</h3></div>
				<div class="form-horizontal row"><!-- Preliminary form -->
					<!-- row 1 temperature pulse respiratory_rate -->
					<!-- blid temperature -->
					<div class='col-md-4 form-group'>
						{!! Form::label('temperature','Temperature :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'>
							<div class='input-group'>
								{!! Form::number('temperature',null,['class' => 'form-control']) !!}<span class="input-group-addon">&deg;C</span>
							</div>
						</div>
					</div>
					<!-- pulse -->
					<div class='col-md-4 form-group'>
						{!! Form::label('pulse','Pulse :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'>
							<div class='input-group'>
								{!! Form::number('pulse',null,['class' => 'form-control']) !!}<span class="input-group-addon">/min</span>
							</div>
						</div>
					</div>
					<!-- respiratory_rate -->
					<div class='col-md-4 form-group'>
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
						{!! Form::label('glassglow_score_E','Glassglow comma score:',['class' => 'control-label col-md-2']) !!}
						
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

				<div class="form-group col-md-12"><hr/></div>
				<!-- general_appearance -->
				<div class="form-group col-md-12"><h3>General appearance [<a onclick="toggleTemplate('#gagCollapse')">Template</a>]</h3></div>
				<!-- GAG -->
					<!-- text generator -->
					<div class="collapse col-md-12" id="gagCollapse">@include('medicine.admission.generalAppearanceGenerator')</div>
				<div class='form-group'>
					{!! Form::textarea('general_appearance',null,['class' => 'form-control', 'id' => 'tagag']) !!}
				</div><!-- end of general_appearance -->

				<div class="form-group col-md-12"><hr/></div>
				<!-- sensetion -->
				<div class="form-group col-md-12"><h3>Sensation</h3></div>
				<!-- sensetion -->
				<iframe src="{{ url('/canvas') }}" frameborder="0" scrolling="no" id="iframe" onload='javascript:resizeIframe(this);'></iframe>
				
			</div>

		</div>
	</div><!-- end investigation panel -->

	<!-- template -->
	<div class="panel panel-default	">
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

				<!-- <iframe src="{{ url('/canvas') }}" class="col-md-12" height="100%" style="height:100%"></iframe> -->
				<!-- <iframe src="{{ url('/canvas') }}" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;top:0px;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe> -->


					<iframe src="{{ url('/canvas') }}" frameborder="0" scrolling="no" id="iframe" onload='javascript:resizeIframe(this);'></iframe>
					<!-- <iframe name="Stack" src="http://stackoverflow.com/" frameborder="0" scrolling="no" id="iframe" onload='javascript:resizeIframe(this);' /> -->
				<div class="col-md-12"><hr/></div>

			</div>
		</div>
	</div>
</div><!-- end main panel group -->
<script type="text/javascript">
	$(document).ready(function() {
    	autosize($('textarea'));
    	//$('#CAD').attr('onclick',"alert('hello')");
    });
</script>
{!! Form::close() !!}

@endsection
