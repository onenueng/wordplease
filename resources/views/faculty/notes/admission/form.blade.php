@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj faculty general note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/gplaypattern.png');")

@section('nav_menu')
<li><a href="#preliminary_data">Preliminary data</a></li>
<li><a href="#principle_diagnosis">Diagnosis</a></li>
<li><a href="#complications">Complications</a></li>
<li><a href="#operations_procedures">Operation</a></li>
<li><a href="#discharge_status">Result of Treatment</a></li>
<li><a href="#history">History</a></li>
<li><a href="#prognosis">Prognosis</a></li>
<li><a href="#date_appointment">Appointment</a></li>
<li><a href="#home_medications_suggest">Home medications</a></li>
<li><a href="#note_panel">Note</a></li>
@endsection

@section('content')
@include('partials.flash')

<div class="col-xs-12"><!-- main_frame -->
    @include('faculty.partials.admission')

    <div class="panel panel-primary">
        <div class="panel-heahing"></div>
        <div class="panel-body">
            <div class="form-horizontal row">
                <div class="col-sm-12"><!-- chief_complaint -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="chief_complant">Chief complaint :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control text_area_feedback" name="chief_complant" id="chief_complant" rows="1" maxlength="255" placeholder="255 characters max.">{{ $note->chief_complant or '' }}</textarea>
                            <div id="chief_complant_feedback" style="color:#b3b3b3"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- reason_admit -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="reason_admit">Reason for admission :</label>
                        <div class="col-sm-7">
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Preventive</label>
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Curative</label>
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Palliative</label>
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Rehabilitation</label>
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Investigation</label>
                            <label class="radio-inline input-sm"><input type="radio" name="reason_admit"> Other</label>
                        </div>
                        <div class="col-sm-3">
                            <div class="collapse in">
                            <input class="form-control" type="text" name="reason_admit_other" placeholder="type other reason">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- present_illness -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="present_illness">Present Illness :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control text_area_feedback" name="present_illness" id="present_illness" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->present_illness or '' }}</textarea>
                            <div id="present_illness_feedback" style="color:#b3b3b3"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- for women -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="pregnancy">Pregnancy :</label>
                        <div class="col-sm-4">
                            <label class="radio-inline input-sm"><input type="radio" name="pregnancy"> Not Pregnant</label>
                            <label class="radio-inline input-sm"><input type="radio" name="pregnancy"> Uncertain</label>
                            <label class="radio-inline input-sm"><input type="radio" name="pregnancy"> Pregnant</label>
                        </div>
                        <div class="collapse in">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name="pregnancy_weeks" />
                                    <span class="input-group-addon">Weeks</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">LPM</span>
                                    <input class="form-control" type="text" name="pregnancy_other" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- allergy -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="allergy">Allergy <span class="fa fa-info-circle"></span> :</label>
                        <div class="col-sm-2">
                            <label class="radio-inline input-sm"><input type="radio" name="allergy"> No</label>
                            <label class="radio-inline input-sm"><input type="radio" name="allergy"> Yes</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="allergy_detail" placeholder="allergy detail" />
                        </div>
                    </div>
                </div>
            </div>

                {{-- <div class="col-sm-12"> --}}
            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
                {{-- </div> --}}
            
            <div class="form-inline"><!-- underlying disease -->
                <label class="input-sm">Pertinent underlying disease : </label>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Diabetes mellitus (DM)</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Hypertension (HT)</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Coronary heart disease</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Valvular heart disease</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Subacute bacterial endocaritis risk</label
                ></div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Pacemaker implant</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> COPD</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Asthma</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Coagulopathy</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Cirrhosis</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Chronic hepatitis B or C</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Chronic Kidney Disease (CKD)</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Epilepsy</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Immuno suppressed patient</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Cancer</label>
                </div>
                <div class="form-group"><input class="form-control input-sm" type="text" name="" placeholder="organ"></div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> AntiHIV+ve/AIDS</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Active communicable disease</label>
                </div>
            </div>
            

            <div class="form-inline" style="margin-top: 5px;"><!-- none of above underlying disease -->
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> None of above</label>
                </div>
                <div class="form-group">
                    <input class="form-control input-sm" size="70" type="text" name="" placeholder="other underlying disease">
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>

            <div class="form-horizontal row"><!-- past_history to drug_abuse -->
                <div class="col-sm-12"><!-- past_history -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="past_history">Present Illness :</label>
                        <div class="col-sm-10">
                            <textarea class="form-control text_area_feedback" name="past_history" id="past_history" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->past_history or '' }}</textarea>
                            <div id="past_history_feedback" style="color:#b3b3b3"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- alcohol -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="alcohol">Alcohol <span class="fa fa-info-circle"></span> :</label>
                        <div class="col-sm-2">
                            <label class="radio-inline input-sm"><input type="radio" name="alcohol"> No</label>
                            <label class="radio-inline input-sm"><input type="radio" name="alcohol"> Yes</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="alcohol_detail" placeholder="alcohol detail" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- smoking -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="smoking">Smoking <span class="fa fa-info-circle"></span> :</label>
                        <div class="col-sm-2">
                            <label class="radio-inline input-sm"><input type="radio" name="smoking"> No</label>
                            <label class="radio-inline input-sm"><input type="radio" name="smoking"> Yes</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="smoking_detail" placeholder="smoking detail" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- drug_abuse -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="drug_abuse">Drug abuse <span class="fa fa-info-circle"></span> :</label>
                        <div class="col-sm-2">
                            <label class="radio-inline input-sm"><input type="radio" name="drug_abuse"> No</label>
                            <label class="radio-inline input-sm"><input type="radio" name="drug_abuse"> Yes</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="drug_abuse_detail" placeholder="drug_abuse detail" />
                        </div>
                    </div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            
            <div class="form-horizontal row">
                <div class="col-sm-12"><!-- current medications -->
                    <label class="input-sm">Current medications : </label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> No current medications</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Insulin</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Oral hypoglycemic drug</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Anticoagulant</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Anti platelet</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> ASA group</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Anti arrhythmia</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Anti HT</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Lipid lowering drug</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Anti convulsant</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Steriod</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Herbs</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Drugs (over the counter)</label>
                    <label class="checkbox-inline input-sm"><input type="checkbox" name="" /> Insulin</label>
                </div>
            </div>

            <div class="form-inline" style="margin-top: 5px;"><!-- none of above current medications -->
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> None of above</label>
                </div>
            </div>

            <div class="form-group"><!-- current_medications_detail -->
                <textarea class="form-control input-sm text_area_feedback" name="current_medications_detail" id="current_medications_detail" rows="1" maxlength="1000" placeholder="current medications detail, 1000 characters max.">{{ $note->current_medications_detail or '' }}</textarea>
                <div id="current_medications_detail_feedback" style="color:#b3b3b3"></div>
            </div>

            <div class="form-inline" style="margin-top: 5px;"><!-- family history -->
                <label class="input-sm">Family history : </label>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> DM</label>
                </div>
                <div class="form-group">
                    <input class="form-control input-sm" type="text" name="" placeholder="DM details">
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> HT</label>
                </div>
                <div class="form-group">
                    <input class="form-control input-sm" type="text" name="" placeholder="HT details">
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Cancer</label>
                </div>
                <div class="form-group">
                    <input class="form-control input-sm" type="text" name="" placeholder="Cancer details">
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> None of the above</label>
                </div>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Other</label>
                </div>
                <div class="form-group">
                    <input class="form-control input-sm" type="text" name="" placeholder="other details">
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>

            <div class="form-horizontal row"><!-- Psychological status -->
                <div class="col-sm-12">
                    <label class="input-sm">Psychological status</label>
                </div>

                <div class="col-sm-12"><!-- level_of_consciousness -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="level_of_consciousness">Level of consciousness :</label>
                        <div class="col-sm-6">
                            <label class="radio-inline input-sm"><input type="radio" name="level_of_consciousness"> Alert</label>
                            <label class="radio-inline input-sm"><input type="radio" name="level_of_consciousness"> Confused</label>
                            <label class="radio-inline input-sm"><input type="radio" name="level_of_consciousness"> Lethargic</label>
                            <label class="radio-inline input-sm"><input type="radio" name="level_of_consciousness"> Drowsy</label>
                            <label class="radio-inline input-sm"><input type="radio" name="level_of_consciousness"> Stuporous</label>
                            <label class="radio-inline input-sm"><input type="radio" name="level_of_consciousness"> Unconscious</label>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon input-sm">Glassgow Coma Score</span>
                                <input class="form-control" type="text" name="reason_admit_other" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12"><!-- mental_health -->
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-2" for="mental_health">Mental Health :</label>
                        <div class="col-sm-4">
                            <label class="radio-inline input-sm"><input type="radio" name="mental_health"> Appropriate</label>
                            <label class="radio-inline input-sm"><input type="radio" name="mental_health"> Retardation</label>
                            <label class="radio-inline input-sm"><input type="radio" name="mental_health"> Psychiatric disease</label>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="reason_admit_other" placeholder="detail psychiatric disease" />
                        </div>
                    </div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>

            <div class="form-inline"><!-- Vital signs/General appearance -->
                <label class="input-sm">Vital signs/General appearance : </label>
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
                    <span class="input-group-addon input-sm">T</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">&#8451;</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">Height</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">cm.</span>
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
                <div class="input-group">
                    <span class="input-group-addon input-sm">BW</span>
                    <input class="form-control input-sm" size="5" type="text" name="">
                    <span class="input-group-addon input-sm">kg.</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon input-sm">BMI</span>
                    <input class="form-control input-sm" size="5" type="text" name="" placeholder="auto" />
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>

            <label class="input-sm">Pertinant physical findings :</label>

            <textarea class="form-control input-sm text_area_feedback" name="pertinant_physical_findings" id="pertinant_physical_findings" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->pertinant_physical_findings or '' }}</textarea>
            <div id="pertinant_physical_findings_feedback" style="color:#b3b3b3"></div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            <div class="row"><!-- Systemic Examination review -->
                <div class="col-sm-4">
                    <label class="input-sm">Systemic Examination review</label>
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
                        <label for="breast">Breast :</label>
                        <label class="radio-inline"><input type="radio" name="breast"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="breast"> Abnormal</label>
                    </div>
                    <div class="form-group input-sm">
                        <label for="heart">Heart :</label>
                        <label class="radio-inline"><input type="radio" name="heart"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="heart"> Abnormal</label>
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
                        <label for="neurology">Neurology :</label>
                        <label class="radio-inline"><input type="radio" name="neurology"> Normal</label>
                        <label class="radio-inline"><input type="radio" name="neurology"> Abnormal</label>
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
                <div class="col-sm-8">
                    <label class="input-sm">Abnormal systemic examination</label>
                    <textarea class="form-control input-sm text_area_feedback" name="abnormal_systemic_examination" id="abnormal_systemic_examination" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->abnormal_systemic_examination or '' }}</textarea>
                    <div id="abnormal_systemic_examination_feedback" style="color:#b3b3b3"></div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            <label class="input-sm">Pertinent invesigations: (Please see more details in laboratory sheet, X-ray report, etc.)</label>

            <textarea class="form-control input-sm text_area_feedback" name="pertinant_investigations" id="pertinant_investigations" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->pertinant_investigations or '' }}</textarea>
            <div id="pertinant_investigations_feedback" style="color:#b3b3b3"></div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            <div class="form-horizontal row">
                <label class="col-sm-2 input-sm">Admission disgnosis : </label>
                <div class="col-sm-10">
                    <textarea class="form-control input-sm text_area_feedback" name="pertinant_investigations" id="pertinant_investigations" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->pertinant_investigations or '' }}</textarea>
                    <div id="pertinant_investigations_feedback" style="color:#b3b3b3"></div>
                </div>
            </div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            <div class="form-inline">
                <label class="input-sm">Plan of management : </label>
                <div class="checkbox">
                    <label class="input-sm"><input type="checkbox" name="" /> Special group (according to CPG)</label>
                </div>
                <div class="form-group">
                    <input class="form-control input-sm" type="text" name="" placeholder="CPG ...">
                </div>
            </div>
            <textarea class="form-control input-sm text_area_feedback" name="plan_of_management" id="plan_of_management" rows="1" maxlength="1000" placeholder="Plan ..., 1000 characters max.">{{ $note->plan_of_management or '' }}</textarea>
            <div id="plan_of_management_feedback" style="color:#b3b3b3"></div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            <label class="input-sm">Plan of consultation : </label>
            <textarea class="form-control input-sm text_area_feedback" name="plan_of_consultation" id="plan_of_consultation" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->plan_of_consultation or '' }}</textarea>
            <div id="plan_of_consultation_feedback" style="color:#b3b3b3"></div>

            <hr style="margin-top: 5px; margin-bottom: 5px;"/>
            
            <label class="input-sm">Estimated duration of hospitalization :</label><br>
            <div style="margin-left: 10px;">
                <div class="form-inline">
                    <label class="input-sm radio-inline"><input type="radio" name="hospitalization"> Approximate duration of hospitalization</label>
                    <div class="input-group input-group-sm">
                        <input class="form-control" type="text" name="">
                        <span class="input-group-addon">Days</span>
                    </div>
                </div>
                <label class="input-sm radio-inline"><input type="radio" name="hospitalization"> Tentative discharge plan</label><br>
                <label class="input-sm radio-inline"><input type="radio" name="hospitalization"> Can not evaluate at the moment, will be informed as soon as possible</label>
            </div>

        </div>
    </div>
</div>
@endsection