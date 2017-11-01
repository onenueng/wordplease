@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj medicine admission note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/footer_lodyas.png');")

@section('nav_menu')
<li><a href="#admission_data">Admission data</a></li>
<li><a href="#chief_complaint_panel">Chief complaint</a></li>
<li><a href="#comorbid_div">Comorbid</a></li>
<li><a href="#personal_social_history_panel">Personal and Social history</a></li>
@endsection

@section('content')
@include('partials.flash')
@include('errors.invalid')

<div class="col-xs-12"><!-- main_frame -->
    
    @include('medicine.partials.primary-data')
    {{-- 
    <div class="panel panel-primary"><!-- panel 1 -->
        <div class="panel-heading">Admission Data</div>
        <div class="panel-body form-horizontal row">
            <div class="col-sm-6 col-xs-12"><!-- admit data left side -->
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Patient</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="" name="" value="HN+NAME+GENDER" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Dob</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="" name="" value="DOB+AGE@admit" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Admit</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="" name="" value="AN+Ward" />
                        </div>
                    </div>
                </div>
            </div>end of left side

            <div class="col-sm-6 col-xs-12"><!-- admit data right side -->
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Attending</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="" name="" value="Attending Name" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Fellow</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="" name="" value="Fellow Name" />
                        </div>
                    </div>
                </div>
            </div><!-- end of right side -->
            
            <div class="col-xs-12"><hr/></div>

            <div class="col-sm-6 col-xs-12"><!-- reason admit -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-xs-12">Reason for admission :</label>
                    </div>
                </div>
            </div><!-- end of reason admit -->

            <div class="col-sm-6 col-xs-12"><!-- pre admit data -->
            </div><!-- end of pre admit data -->
        </div>
    </div><!-- end of panel 1 -->
     --}}

    <style type="text/css">
        div.form-group {
            margin-top: 2px!important;
            margin-bottom: 2px!important;
            padding-top: 2px!important;
            padding-bottom: 2px!important;
        }
    </style>

    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6"><!-- patient and admit -->
                    <div class="form-horizontal">
                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-2">Patient : </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="" placeholder="HN + Name + Gender" />
                            </div>
                        </div>
                        
                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-2">Age : </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" />
                            </div>
                            <label class="control-label col-sm-2">DOB : </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" />
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-2">AN : </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" />
                            </div>
                            <label class="control-label col-sm-2">Ward : </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"><!-- attending fellow -->
                    <div class="form-horizontal">
                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Attending staff : </label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="" />
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-sm-4">Fellow : </label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12"><hr style="margin-top: 5px; margin-bottom: 5px;" /></div>
                <div class="col-sm-6"><!-- reason admit -->
                    <div class="col-sm-12">
                        <label class="input-sm">Reason for admission :</label>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Intervention</label>
                        </div>
                        <div class="col-sm-10">
                            <label class="input-sm"><span class="fa fa-arrow-circle-right"></span> </label>
                            <label class="radio-inline input-sm"><input type="radio" name="interventino" /> <i>Elective schedule</i></label>
                            <label class="radio-inline input-sm"><input type="radio" name="interventino" /> <i>Urgent</i></label>
                            <label class="radio-inline input-sm"><input type="radio" name="interventino" /> <i>Emergency</i></label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Intensive cardiovascular management</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Investigation</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Other</label>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control input-sm" type="text" name="reason_admit_other" placeholder="other reason" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"><!-- patient from -->
                    <div class="col-sm-4"><!-- admit_via -->
                        <div class="col-sm-12">
                            <label class="input-sm">From:</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> Siriraj OPD</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> ศูนย์โรคหัวใจ 4</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> IPD medicine</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> IPD surgery</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> IPD CVT</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> IPD pediatric</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <label class="radio-inline input-sm"><input type="radio" name="admit_via"> คลินิกนอกเวลา</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8"><!-- is_refer -->
                        <div class="col-sm-12">
                            <label class="input-sm">Refer : </label>
                            <label class="radio-inline input-sm"><input type="radio" name="refer"> No</label>
                            <label class="radio-inline input-sm"><input type="radio" name="refer"> Government</label>
                            <label class="radio-inline input-sm"><input type="radio" name="refer"> Private hospital</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <label class="input-sm">Reimbursment : </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="radio-inline input-sm"><input type="radio" name="reimbursment"> NHC</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-offset-6 col-sm-6">
                                <label class="radio-inline input-sm"><input type="radio" name="reimbursment"> CS</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-offset-6 col-sm-6">
                                <label class="radio-inline input-sm"><input type="radio" name="reimbursment"> SSF</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-offset-6 col-sm-6">
                                <label class="radio-inline input-sm"><input type="radio" name="reimbursment"> Cash</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12"><hr style="margin-top: 5px; margin-bottom: 5px;" /></div>
            </div>
            <div class="form-horizontal row"><!-- chief_complaint -->
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="chief_complant">Chief complaint :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control input-sm text_area_feedback" name="chief_complant" id="chief_complant" rows="1" maxlength="255" placeholder="255 characters max.">{{ $note->chief_complant or '' }}</textarea>
                            <div id="chief_complant_feedback" style="color:#b3b3b3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="row">
                <div class="col-sm-6"><!-- history -->
                    <label class="input-sm">History of present illness :</label>
                    <textarea class="form-control input-sm text_area_feedback" name="history_present_illness" id="history_present_illness" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->history_present_illness or '' }}</textarea>
                    <div id="history_present_illness_feedback" style="color:#b3b3b3"></div>
                    <div class="form-group">
                        <label class="input-sm">Angina:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="angina"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="angina"> CCS I</label>
                        <label class="radio-inline input-sm"><input type="radio" name="angina"> CCS II</label>
                        <label class="radio-inline input-sm"><input type="radio" name="angina"> CCS III</label>
                        <label class="radio-inline input-sm"><input type="radio" name="angina"> CCS IV</label>
                    </div>
                    <div class="form-group">
                        <label class="input-sm">Dysnea:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="dysnea"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="dysnea"> Yes</label>
                    </div>
                    <div class="form-group">
                        <label class="input-sm">Cardiogenic shock:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="cardiogenic_shock"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="cardiogenic_shock"> Yes</label>
                    </div>
                    <div class="form-group">
                        <label class="input-sm">Postcardiac arrest:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="precardiac_arrest"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="precardiac_arrest"> Yes</label>
                    </div>
                    <input class="form-control input-sm" type="text" name="" placeholder="others..." />
                    <div class="col-xs-12"><hr style="margin-top: 5px; margin-bottom: 5px;" /></div>

                    <label class="input-sm">Past history :</label>
                    <textarea class="form-control input-sm text_area_feedback" name="past_history" id="past_history" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->past_history or '' }}</textarea>
                    <div id="past_history_feedback" style="color:#b3b3b3"></div>


                    <div class="col-sm-3">
                        <label class="input-sm">Previous MI:-</label>
                    </div>
                    <div class="col-sm-9">
                        <label class="radio-inline input-sm"><input type="radio" name="pre_mi" /> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="pre_mi" /> Unknown</label>
                    </div>

                    <div class="col-sm-3"> </div>
                    <div class="col-sm-9">
                        <div class="form-inline">
                            <label class="radio-inline input-sm"><input type="radio" name="pre_mi" /> Yes</label>
                            <input class="form-control input-sm" size="40" type="text" name="" placeholder="... mo/yr ago Date DD/MM/YYYY" />
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label class="input-sm">Previous intervention:-</label>
                    </div>
                    <div class="col-sm-8">
                        <label class="radio-inline input-sm"><input type="radio" name="pre_intervention" /> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="pre_intervention" /> Unknown</label>
                    </div>
                    <div class="col-sm-4"> </div>
                    <div class="col-sm-8">
                        <div class="form-inline">
                            <label class="radio-inline input-sm"><input type="radio" name="pre_intervention" /> PCI</label>
                            <label class="radio-inline input-sm"><input type="radio" name="pre_intervention" /> CABG</label>
                        </div>
                    </div>
                    <div class="col-sm-5"> </div>
                    <div class="col-sm-7">
                        <div class="form-inline">
                            <input class="form-control input-sm" size="40" type="text" name="" placeholder="Lastest ... mo/yr ago" />
                        </div>
                    </div>
                    <div class="col-sm-5"> </div>
                    <div class="col-sm-7">
                        <div class="form-inline">
                            <input class="form-control input-sm" size="40" type="text" name="" placeholder="Date DD/MM/YYYY" />
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="input-sm">Major bleeding:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="major_bleeding"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="major_bleeding"> Yes</label>
                    </div>

                    <div class="col-sm-12">
                        <label class="input-sm">Drug / drug allergy:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="allergy"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="allergy"> Yes</label>
                    </div>

                    <div class="col-sm-12">
                        <label class="input-sm">Smoking:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="smoking"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="smoking"> Yes</label>
                    </div>

                    <div class="col-sm-12">
                        <label class="input-sm">Family history CAD:-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="family_CAD"> No</label>
                        <label class="radio-inline input-sm"><input type="radio" name="family_CAD"> Yes</label>
                    </div>

                    <input class="form-control input-sm" type="text" name="" placeholder="others..." />
                </div>

                <div class="col-sm-6"><!-- comobid meds -->
                    <div class="form-group">
                        <label class="input-sm">Co-morbid disease :</label>
                    </div>
                    <div class="col-sm-6"><!-- comorbid left -->
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Diabetes mellitus</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Hypertension</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Coronary artery disease</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Valvular heart disease</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Stroke</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> COPD/asthma</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Pneumonia</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Chronic kidney disease</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Dyslipidemia</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Cirrhosis</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> HIV/AIDS</label>
                        </div>
                    </div>
                    <div class="col-sm-6"><!-- comorbid right -->
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Epilepsy</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Coagulopathy</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> AF Chronic hepatitis B/C</label>
                        </div>
                        <div class="form-inline">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Cancer</label>
                            <input class="form-control input-sm" type="text" name=""  placeholder="organ" />
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Leukemia/lymphoma</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Pacemaker implantation</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> AICD</label>
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> CRT</label>
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> CRT-D</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Chronic arthritis</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> SLE/autoimmune disease</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> TB or other active communicable disease</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Dementia</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Psychiatric illness</label>
                        </div>
                    </div>
                    <div class="col-xs-12"><hr style="margin-top: 5px; margin-bottom: 5px;" /></div>

                    <div class="form-group">
                        <label class="input-sm">Current medications : </label>
                        <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> No current medications</label>
                    </div>
                    <div class="col-sm-12"><!-- current medications -->
                        <div class="form-inline">
                            <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> ASA</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="text" name="">
                                <span class="input-group-addon">mg/d</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> Clopidogrel 75 mg/d</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> Ticagrelor 180 mg/d</label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> Prasugrel 10 mg/d</label>
                        </div>
                        <div class="form-inline">
                            <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> Anticoagulant</label>
                            <input class="form-control input-sm" type="text" name="" placeholder="details" />
                        </div>
                        <div class="form-inline">
                            <label class="checkbox-inline input-sm"> <input type="checkbox" name=""> Statin</label>
                            <input class="form-control input-sm" type="text" name="" placeholder="details" />
                        </div>
                        <textarea class="form-control input-sm text_area_feedback" name="current_medications_others" id="current_medications_others" rows="1" maxlength="1000" placeholder="others current medication, 1000 characters max.">{{ $note->current_medications_others or '' }}</textarea>
                        <div id="current_medications_others_feedback" style="color:#b3b3b3"></div>
                    </div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="row"><!-- indications -->
                <div class="form-group"><label class="input-sm">Indication for cardiac catheterization :</label></div>
                <div class="col-sm-6"><!-- indications left -->
                    <div class="form-group">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> STEMI (Primary PCI) :- </label>
                        <label class="radio-inline input-sm"><input type="radio" name="PCI">Rescue PCI</label>
                        <label class="radio-inline input-sm"><input type="radio" name="PCI">Facilitaed PCI</label>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> STEMI (Pharmacoinvasive strategy)</label>
                    </div>

                    <div class="form-inline">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> NSTE-ACS</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">GRACE risk score</span>
                            <input class="form-control" size="5" type="text" name="">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">TIMI risk score</span>
                            <input class="form-control" size="5" type="text" name="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Risk stratification for cardiac surgery</label>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Risk stratification for noncardiac surgery</label>
                    </div>
                </div>

                <div class="col-sm-6"><!-- indications right -->
                    <div class="form-inline">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Chronic IHD :-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="chronic_IHD">positive noninvasive test</label>
                        <label class="radio-inline input-sm"><input type="radio" name="chronic_IHD">CCSC – III or IV</label>
                        <input class="form-control input-sm" type="text" name="chronic_IHD_other" placeholder="other Chronic IHD" />
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> Controlled angiography :-</label>
                        <label class="radio-inline input-sm"><input type="radio" name="controlled_angiography">Stage PCI</label>
                        <label class="radio-inline input-sm"><input type="radio" name="controlled_angiography">Target heart failure</label>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline input-sm"><input type="checkbox" name=""> To estabish the diagnosis of non-ischemic cardiac disease</label>
                    </div>

                    <div class="form-group">
                        <input class="form-control input-sm" type="text" name="" placeholder="other indications" />
                    </div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="form-inline"><!-- Physical examination -->
                <label class="input-sm">Physical examination : </label><br>
                <label class="input-sm">Vital signs :-</label>
                <div class="input-group">
                    <span class="input-group-addon input-sm">T</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">&#8451;</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">P</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">/min</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">R</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">/min</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">BP</span>
                    <input class="form-control input-sm" size="5" type="text" name="" placeholder="SBP">
                </div>
                <label> / </label>
                <div class="input-group">
                    <input class="form-control input-sm" size="5" type="text" name="" placeholder="DBP">
                    <span class="input-group-addon input-sm">mmHg.</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">Height</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">cm.</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">BW</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">kg.</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">BMI</span>
                    <input class="form-control input-sm" size="5" type="text" name="" placeholder="auto" />
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">O<sub>2</sub>sat</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">%(optional)</span>
                </div>
                <label class="input-sm" style="font-weight: normal !important;"><input type="radio" name="breathing"> Room air</label>
                <label class="input-sm" style="font-weight: normal !important;"><input type="radio" name="breathing"> O<sub>2</sub></label>
                <div class="input-group">
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">L/min</span>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />

            <div class="form-inline">
                <div class="form-group">
                <label class="input-sm">Level of conciousness : </label>
                <label class="input-sm radio-inline"><input type="radio" name="conciousness"> Awake</label>
                <label class="input-sm radio-inline"><input type="radio" name="conciousness"> Drowsy</label>
                <label class="input-sm radio-inline"><input type="radio" name="conciousness"> Stuporous</label>
                <label class="input-sm radio-inline"><input type="radio" name="conciousness"> Unconscious</label>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Glasgow Coma Score</span>
                    <input class="form-control" type="text" name="gcs" placeholder="optional" size="10">
                </div>
            </div>

            <div class="form-inline">
                <div class="form-group">
                    <label class="input-sm">Mental evaluation : </label>
                    <label class="input-sm radio-inline"><input type="radio" name="mental_evaluation"> Appropriate</label>
                    <label class="input-sm radio-inline"><input type="radio" name="mental_evaluation"> Retardation</label>
                    <label class="input-sm radio-inline"><input type="radio" name="mental_evaluation"> Depressed</label>
                    <label class="input-sm radio-inline"><input type="radio" name="mental_evaluation"> Psychotic</label>
                </div>
                <div class="form-group">
                    <label class="input-sm">Orientation to : </label>
                    <label class="input-sm checkbox-inline"><input type="checkbox" name="mental_evaluation"> Appropriate</label>
                    <label class="input-sm checkbox-inline"><input type="checkbox" name="mental_evaluation"> Retardation</label>
                    <label class="input-sm checkbox-inline"><input type="checkbox" name="mental_evaluation"> Depressed</label>
                    <label class="input-sm checkbox-inline"><input type="checkbox" name="mental_evaluation"> Psychotic</label>
                </div>
            </div>
            
            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="row"><!-- Systemic Examination review -->
                <div class="col-sm-4">
                    <div class="text-center"><label class="input-sm">Systemic Examination</label></div>
                    <div class="form-group input-sm">
                        <label for="skin">Skin :</label>
                        <label class="radio-inline"><input type="radio" name="skin"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="skin"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="head_face">Head/Face :</label>
                        <label class="radio-inline"><input type="radio" name="head_face"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="head_face"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="eye_ent">Eye/ENT :</label>
                        <label class="radio-inline"><input type="radio" name="eye_ent"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="eye_ent"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="neck">Neck :</label>
                        <label class="radio-inline"><input type="radio" name="neck"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="neck"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="lungs">Lungs :</label>
                        <label class="radio-inline"><input type="radio" name="lungs"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="lungs"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="abdomen">Abdomen :</label>
                        <label class="radio-inline"><input type="radio" name="abdomen"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="abdomen"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="extremities">Extremities :</label>
                        <label class="radio-inline"><input type="radio" name="extremities"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="extremities"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="neurology">Nervous syst. :</label>
                        <label class="radio-inline"><input type="radio" name="neurology"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="neurology"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="neurology">Lymph nodes :</label>
                        <label class="radio-inline"><input type="radio" name="lymph_nodes"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="lymph_nodes"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="breasts">Breasts :</label>
                        <label class="radio-inline"><input type="radio" name="breasts"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="breasts"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="genitalia">Genitalia :</label>
                        <label class="radio-inline"><input type="radio" name="genitalia"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="genitalia"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="rectal_exam">Rectal Exam :</label>
                        <label class="radio-inline"><input type="radio" name="rectal_exam"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="rectal_exam"> Abnormal</label>
                    </div>
                </div>
                <div class="col-sm-8 text-center">
                    <label class="input-sm">Detail of important findinds (whether normal or abnormal)</label>
                    <textarea class="form-control input-sm text_area_feedback" name="abnormal_systemic_examination" id="abnormal_systemic_examination" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->abnormal_systemic_examination or '' }}</textarea>
                    <div id="abnormal_systemic_examination_feedback" style="color:#b3b3b3"></div>
                </div>
            </div>
            
            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="text-center"><label class="input-sm">Cardiovascular system</label></div>
            
            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="row"><!-- cardiovascular system -->
                <div class="col-sm-6"><!-- left cardiovascular -->
                    <div class="col-sm-12">
                        {{-- <div class="form-group"> --}}
                            <label class="col-sm-4 input-sm">Neck vein :</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6">
                                    <label class="input-sm radio-inline"><input type="radio" name="neck_vein"> normal</label>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-sm radio-inline"><input type="radio" name="neck_vein"> abnormal</label>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">Carotid pulse :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="carotid_pulse"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="carotid_pulse"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">PMI :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="PMI"> not displaced</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="PMI"> displaced</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">Heaving :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4">
                                <label class="input-sm radio-inline"><input type="radio" name="heaving"> no</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="input-sm radio-inline"><input type="radio" name="heaving"> LV heave</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="input-sm radio-inline"><input type="radio" name="heaving"> RV heave</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">S1 :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S1"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S1"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">S2 :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S2"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S2"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">S3 :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S3"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S3"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">S4 :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S4"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="S4"> abnormal</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6"><!-- right cardiovascular -->
                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">Femoral pulse :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="femoral_pulse"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="femoral_pulse"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">Popliteal pulse :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="popliteal_pulse"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="popliteal_pulse"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">PTB pulse :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="PTB_pulse"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="PTB_pulse"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">DP pulse :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="DP_pulse"> normal</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="DP_pulse"> abnormal</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="col-sm-4 input-sm">Murmur :</label>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="murmur"> no</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-offset-4 col-sm-8">
                            <div class="col-sm-2">
                                <label class="input-sm radio-inline"><input type="radio" name="murmur"> yes;</label>
                            </div>
                            <div class="col-sm-10">
                                <input class="form-control input-sm" type="text" name="" placeholder="murmur detail">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <label class="input-sm">Pertinent investigations :</label>
            <div class="form-horizontal"><!-- Pertinent investigations 1 -->
                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="ekg">EKG : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="ekg">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">Chest X-ray : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="cxr">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">Echocardiography : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="echocardiography"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="echocardiography"> done</label>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">LVEF</span>
                            <input class="form-control" type="text" name="">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-6">
                        <input class="form-control" type="text" name="" placeholder="other inportant findings">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">EST : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="EST"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="EST"> done</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="" placeholder="result">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">CMRI : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="CMRI"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="CMRI"> done</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="" placeholder="result">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">Nuclear scan : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="nuclear_scan"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="nuclear_scan"> done</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="" placeholder="result">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label">Cardiac markers : </label>
                    <div class="col-sm-5">
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 input-sm control-label" for="ctnt">CTnT </label>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="ctnt"> not done</label>
                                <label class="input-sm radio-inline"><input type="radio" name="ctnt"> done</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name="" placeholder="CTnT">
                                    <span class="input-group-addon">ng/l</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 input-sm control-label" for="ck_mb">CK-MB </label>
                            <div class="col-sm-6">
                                <label class="input-sm radio-inline"><input type="radio" name="ck_mb"> not done</label>
                                <label class="input-sm radio-inline"><input type="radio" name="ck_mb"> done</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name="" placeholder="CK-MB">
                                    <span class="input-group-addon">mg/l</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-inline"><!-- lab 1-->
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">BUN</span>
                    <input class="form-control" type="text" name="" size="10">
                    <span class="input-group-addon">mg/dl</span>
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Cr</span>
                    <input class="form-control" type="text" name="" size="10">
                    <span class="input-group-addon">mg/dl</span>
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">eGFR</span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Na<sup>+</sup></span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">K<sup>+</sup></span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">HCO<sup>3-</sup></span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Cl<sup>-</sup></span>
                    <input class="form-control" type="text" name="" size="10">
                </div>
            </div>
            <div class="form-inline" style="margin-top: 5px;"><!-- lab 2-->
                <label class="input-sm">CBC : </label>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Hct</span>
                    <input class="form-control" type="text" name="" size="10">
                    <span class="input-group-addon">%</span>
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Hb</span>
                    <input class="form-control" type="text" name="" size="10">
                    <span class="input-group-addon">gm%</span>
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">MCV</span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">platlet</span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">PT</span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">PTT</span>
                    <input class="form-control" type="text" name="" size="10">
                </div>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">INR</span>
                    <input class="form-control" type="text" name="" size="10">
                </div>
            </div>

            <div class="form-horizontal"><!-- Pertinent investigations 2-->
                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">Anti HIV : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="anti_HIV"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="anti_HIV"> done</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="" placeholder="result">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">HBsAg : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="HBsAg"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="HBsAg"> done</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="" placeholder="result">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="col-sm-2 input-sm control-label" for="cxr">Anti-HCV : </label>
                    <div class="col-sm-2">
                        <label class="input-sm radio-inline"><input type="radio" name="anti-HCV"> not done</label>
                        <label class="input-sm radio-inline"><input type="radio" name="anti-HCV"> done</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="" placeholder="result">
                    </div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="form-group form-group-sm">
                <label class="input-sm">Problems list :</label>
                <textarea class="form-control input-sm text_area_feedback" name="problems_list" id="problems_list" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->problems_list or '' }}</textarea>
                <div id="problems_list_feedback" style="color:#b3b3b3"></div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="form-group form-group-sm">
                <label class="input-sm">Plan of investigation :</label>
                <textarea class="form-control input-sm text_area_feedback" name="plan_of_investigation" id="plan_of_investigation" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->plan_of_investigation or '' }}</textarea>
                <div id="plan_of_investigation_feedback" style="color:#b3b3b3"></div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="form-group form-group-sm">
                <label class="input-sm">Plan of management :</label>
                <textarea class="form-control input-sm text_area_feedback" name="plan_of_management" id="plan_of_management" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->plan_of_management or '' }}</textarea>
                <div id="plan_of_management_feedback" style="color:#b3b3b3"></div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;" />
            <div class="form-horizontal">
                <div class="form-group form-group-sm">
                    <label class="col-sm-4 control-label">Estimated duration hospitalization :</label>
                    <div class="col-sm-8">
                        <div class="form-inline">
                        <label class="radio-inline input-sm"><input type="radio" name="estimated_admit_duration"> Approximated lenght of stay</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="text" name="" size="5">
                                <span class="input-group-addon">days</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                <div class="col-sm-offset-4 col-sm-8">
                    <label class="radio-inline input-sm"><input type="radio" name="estimated_admit_duration"> Cannot be presently determined</label>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of main_frame -->

@endsection

@section('form_script')
@include('medicine.notes.admission.script')
@endsection