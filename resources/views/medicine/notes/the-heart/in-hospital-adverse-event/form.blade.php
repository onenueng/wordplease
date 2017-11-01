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
                            <label class="control-label col-sm-2">LOS : </label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" />
                            </div>
                        </div>
                        <div class="form-inline">
                            <label class="input-sm">Procedure Date : </label>
                            <input class="form-control input-sm" type="text" name="" size="25">
                        </div>
                        <div class="form-inline">
                            <label class="input-sm">Discharge Date : </label>
                            <input class="form-control input-sm" type="text" name="" size="25">
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

                <div class="col-sm-6"><!-- 1. Post procedure enzymes -->
                    <label class="input-sm">1. Post procedure enzymes</label>
                    <table>
                        <tr><!-- head row -->
                            <th class="text-center" style="width: 15%;"><label class="input-sm">Done</label></th>
                            <th class="text-center" style="width: 15%;"><label class="input-sm">Not done</label></th>
                            <th style="width: 70%;"></th>
                        </tr>
                        <tr><!-- CK-MB -->
                            <td class="text-center"><input type="radio" name="ck_mb"></td>
                            <td class="text-center"><input type="radio" name="ck_mb"></td>
                            <td class="form-inline">
                                <label class="input-sm">CK-MB peak CK-MB</label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name="">
                                    <span class="input-group-addon">ng/ml</span>
                                </div>
                            </td>
                        </tr>
                        <tr><!-- CK-MB options -->
                            <td></td>
                            <td></td>
                            <td>
                                <div class="text-right col-sm-2"><label class="input-sm"><i><b>3x</b></i></label></div>
                                <div class="col-sm-10">
                                    <label class="radio-inline input-sm"><input type="radio" name="ck_mb_3x"> Yes (Q-wave) myocardial infarction</label>
                                </div>
                            </td>
                        </tr>
                        <tr><!-- CK-MB options -->
                            <td></td>
                            <td></td>
                            <td>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label class="radio-inline input-sm"><input type="radio" name="ck_mb_3x"> Yes (Non Q-wave)</label>
                                </div>
                            </td>
                        </tr>
                        <tr><!-- BUN/Cr -->
                            <td class="text-center"><input type="radio" name="bun_cr_peak"></td>
                            <td class="text-center"><input type="radio" name="bun_cr_peak"></td>
                            <td class="form-inline">
                                <label class="input-sm">BUN/Cr peak </label>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name="" size="5">
                                    <span class="input-group-addon">/</span>
                                    <input class="form-control" type="text" name="" size="5">
                                    <span class="input-group-addon">mg/ml</span>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="col-sm-2"><label class="input-sm">Angina</label></div>
                    <div class="col-sm-2"><label class="radio-inline input-sm"><input type="radio" name="angina"> No</label></div>
                    <div class="col-sm-2"><label class="radio-inline input-sm"><input type="radio" name="angina"> Yes;</label></div>
                    <div class="col-sm-6"><label class="radio-inline input-sm"><input type="radio" name="angina_yes"> Yes with dynamic ST change</label></div>
                    <div class="col-sm-offset-6 col-sm-6"><label class="radio-inline input-sm"><input type="radio" name="angina_yes"> Yes with STEMI</label></div>
                    <div class="col-sm-offset-6 col-sm-6"><label class="radio-inline input-sm"><input type="radio" name="angina_yes"> Yes with NSTEMI</label></div>
                    <div class="col-sm-offset-6 col-sm-6"><label class="radio-inline input-sm"><input type="radio" name="angina_yes"> Yes with New Q wave</label></div>

                    <div class="col-sm-3"><label class="input-sm">Procedure action</label></div>
                    <div class="col-sm-9"><label class="radio-inline input-sm"><input type="radio" name="procedu_action"> No</label></div>
                    <div class="col-sm-3"><label class="radio-inline input-sm"><input type="radio" name="procedu_action"> Yes;</label></div>
                    <div class="col-sm-6"><label class="radio-inline input-sm"><input type="radio" name="procedu_action"> Re-cath, In-stent thrombosis</label></div>
                    <div class="col-sm-offset-6 col-sm-6">
                        <div class="col-xs-12">
                            <div class="form-inline">
                                <label class="radio-inline input-sm"><input type="radio" name="procedu_action"> Yes</label>
                                <label class="radio-inline input-sm"><input type="radio" name="procedu_action"> No</label>
                                <input class="form-control input-sm" type="text" name="" size="10" placeholder="date re-cath">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-6 col-sm-6"><label class="radio-inline input-sm"><input type="radio" name="procedu_action"> Re-PCI</label></div>
                    <div class="col-sm-offset-6 col-sm-6">
                        <div class="form-inline">
                            <label class="radio-inline input-sm"><input type="radio" name="procedu_action"> CABG</label>
                            <input class="form-control input-sm" type="text" name="" size="20" placeholder="date CABG">
                        </div>
                    </div>
                    <div class="col-sm-offset-6 col-sm-6">
                        <div class="col-xs-12">
                            <div class="form-inline">
                                <label class="radio-inline" style="font-size: 8px;"><input class="radio" type="radio" name="procedu_action"> Yes elective</label>
                                <label class="radio-inline" style="font-size: 8px;"><input class="radio" type="radio" name="procedu_action"> Yes urgent</label>
                                <label class="radio-inline" style="font-size: 8px;"><input class="radio" type="radio" name="procedu_action"> Yes emergency</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"><!-- 2. Major entry site complication -->
                    <label class="input-sm">2. Major entry site complication</label>
                    <table style="width: 100%;">
                        <tr>
                            <th class="text-center" style="width: 10%;"><label class="input-sm">No</label></th>
                            <th class="text-center" style="width: 10%;"><label class="input-sm">Yes</label></th>
                            <th class="text-center" style="width: 80%;"></th>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="radio" name="bleeding_hematoma"></td>
                            <td class="text-center"><input type="radio" name="bleeding_hematoma"></td>
                            <td><label class="input-sm">Bleeding/Hematoma;</label></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- <div class="col-xs-12"> --}}
                                    <label class="input-sm radio-inline">need</label>
                                    <label class="input-sm radio-inline"><input type="radio" name="need"> Yes</label>
                                    <label class="input-sm radio-inline"><input type="radio" name="need"> Yes</label>
                                {{-- </div> --}}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- <div class="col-xs-12"> --}}
                                    <label class="col-sm-4 input-sm radio-inline">blood transfusion</label>
                                    <div class="col-sm-4"><label class="input-sm radio-inline"><input type="radio" name="blood_transfusion"> No treat</label></div>
                                    <div class="col-sm-4"><label class="input-sm radio-inline"><input type="radio" name="blood_transfusion"> Pressure</label></div>
                                {{-- </div> --}}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- <div class="col-xs-12"> --}}
                                    {{-- <label class="col-sm-5 input-sm radio-inline">blood transfusion</label> --}}
                                    <div class="col-sm-offset-4 col-sm-4"><label class="input-sm radio-inline"><input type="radio" name="blood_transfusion"> Fibrin injection</label></div>
                                    <div class="col-sm-4"><label class="input-sm radio-inline"><input type="radio" name="blood_transfusion"> Surgical repaire</label></div>
                                {{-- </div> --}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="radio" name="psuedo_aneuysm"></td>
                            <td class="text-center"><input type="radio" name="psuedo_aneuysm"></td>
                            <td><label class="input-sm">Psuedo aneuysm</label></td>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="radio" name="thrombotic_occlusion"></td>
                            <td class="text-center"><input type="radio" name="thrombotic_occlusion"></td>
                            <td><label class="input-sm">Thrombotic occlusion</label></td>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="radio" name="vascular_surgery_repaire"></td>
                            <td class="text-center"><input type="radio" name="vascular_surgery_repaire"></td>
                            <td><label class="input-sm">Vascular surgery repaire</label></td>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="radio" name="other"></td>
                            <td class="text-center"><input type="radio" name="other"></td>
                            <td>
                                <label class="col-sm-2 input-sm">Other; </label>
                                <div class="col-sm-5 "><label class="checkbox-inline input-sm"><input type="checkbox" name="">Access site occulsion</label></div>
                                <div class="col-sm-5 "><label class="checkbox-inline input-sm"><input type="checkbox" name="">Dissection </label></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td>
                                {{-- <label class="col-sm-2 input-sm">Other; </label> --}}
                                <div class="col-sm-offset-2 col-sm-5 "><label class="checkbox-inline input-sm"><input type="checkbox" name="">AV fistula</label></div>
                                <div class="col-sm-5 "><input class="form-control input-sm" type="text" name="" placeholder="other"></div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-xs-12"><hr style="margin-top: 5px; margin-bottom: 5px;" /></div>

            </div>
            <label class="input-sm">3. Other in hospital adverse event</label>
            <table style="width: 100%;">
                <tr>
                    <th class="text-center" style="width: 5%;"><label class="input-sm">No</label></th>
                    <th class="text-center" style="width: 5%;"><label class="input-sm">Yes</label></th>
                    <th class="text-center" style="width: 90%;"></th>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="no_entry_site_bleeding"></td>
                    <td class="text-center"><input type="radio" name="no_entry_site_bleeding"></td>
                    <td>
                        <label class="input-sm">Non-entry site bleeding complication; requiring transfusion</label>
                        <label class="input-sm radio-inline"><input type="radio" name="requiring_transfusion">Yes</label>
                        <label class="input-sm radio-inline"><input type="radio" name="requiring_transfusion">No</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="row">
                        <div class="col-xs-12">
                            <div class="col-sm-4">
                                <label class="checkbox-inline input-sm"><input type="checkbox" name="gastrointestinal"> Gastrointestinal</label>
                            </div>
                            <div class="col-sm-8">
                                <label class="checkbox-inline input-sm"><input type="checkbox" name="gastro_retroperititional"> Gastro retroperitional</label>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-sm-4">
                                <label class="checkbox-inline input-sm"><input type="checkbox" name="abdominal_wall"> Abdominal wall</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="checkbox-inline input-sm"><input type="checkbox" name="gentital"> Gentital</label>
                            </div>
                            <div class="col-sm-4">
                                <label class="checkbox-inline input-sm"><input type="checkbox" name="other"> Other</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="nurological_event"></td>
                    <td class="text-center"><input type="radio" name="nurological_event"></td>
                    <td>
                        <label class="input-sm">Nurological event</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="stroke"></td>
                    <td class="text-center"><input type="radio" name="stroke"></td>
                    <td>
                        <label class="input-sm">Storke</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="dysrhythmia"></td>
                    <td class="text-center"><input type="radio" name="dysrhythmia"></td>
                    <td>
                        <label class="input-sm">Dysrhythmia; requiring treatment</label>
                        <label class="input-sm radio-inline"><input type="radio" name="requiring_treatment">Yes</label>
                        <label class="input-sm radio-inline"><input type="radio" name="requiring_treatment">No</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="tamponade"></td>
                    <td class="text-center"><input type="radio" name="tamponade"></td>
                    <td>
                        <label class="input-sm">Tamponade; </label>
                        <label class="input-sm radio-inline"><input type="radio" name="temponade_options">emergrncy pericadial tapping</label>
                        <label class="input-sm radio-inline"><input type="radio" name="temponade_options">emergrncy surgery drainage</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="death"></td>
                    <td class="text-center"><input type="radio" name="death"></td>
                    <td>
                        <div class="form-inline">
                            <label class="input-sm">Death; </label>
                            <label class="input-sm radio-inline"><input type="radio" name="death_options">cardiac death</label>
                            <label class="input-sm radio-inline"><input type="radio" name="death_options">death in cath</label>
                            <input class="form-control input-sm" type="text" name="" placeholder="dead date">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="IABP"></td>
                    <td class="text-center"><input type="radio" name="IABP"></td>
                    <td>
                        <label class="input-sm">IABP; </label>
                        <label class="input-sm radio-inline"><input type="radio" name="IABP_options">before procedure</label>
                        <label class="input-sm radio-inline"><input type="radio" name="IABP_options">during procedure</label>
                        <label class="input-sm radio-inline"><input type="radio" name="IABP_options">after procedure</label>
                    </td>
                </tr>
                <tr>
                    <td class="text-center"><input type="radio" name="other"></td>
                    <td class="text-center"><input type="radio" name="other"></td>
                    <td>
                        <label class="input-sm">Other; </label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Cardiogenic shock</label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Congestive heart</label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Renal failure</label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Fever</label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Hypertension require</label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Thrombocytopenia</label>
                        <label class="input-sm checkbox-inline"><input type="checkbox" name="">Contrast serlin reaction</label>
                    </td>
                </tr>
            </table>
            <input class="form-control input-sm" type="text" name="" placeholder="other event">
        </div>


</div>

@endsection

@section('form_script')
@include('medicine.notes.admission.script')
@endsection