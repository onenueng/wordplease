<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineAdmissionNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('medicine_admission_notes', function (Blueprint $table) {
			$table->integer('id');
			$table->primary('id'); // relation on notes.

// $table->increments('id');
// $table->integer('note_id')->unsigned()->unique();
// // $table->integer('id')->unsigned();
// // $table->primary('id');

// // field HN type integer
// // $table->integer('HN')->unsigned();
// $table->string('HN'); // encrypt.
// // field patient_name type string
// // $table->string('patient_name', 120); // encrypt name @ created.
// // field gender type boolean
// // $table->boolean('gender');
// // field age type tinyInteger
// // $table->tinyInteger('age')->nullable();
// // field AN type integer
// // $table->integer('AN')->unsigned()->unique();
// $table->string('AN'); // encrypt.
// // field date_admit type date
// $table->datetime('date_admit')->nullable();
// // field ward_id smallInteger
// $table->smallInteger('ward_id')->unsigned();
// // field ward_name
// // $table->string('ward_name')->nuallable();
// // field attending_id type smallInteger
// $table->smallInteger('attending_id')->nullable();
// // field reason_admit type tinyInteger
// $table->tinyInteger('reason_admit')->nullable();
// // field reason_admit_other type string
// $table->string('reason_admit_other');

// // field chief_complaint type string
// $table->string('chief_complaint', 1000);

// // fields comorbid_DM type TinyInteger
// $table->tinyInteger('comorbid_DM')->unsigned()->nullable();
// // fields DM_type TinyInteger
// $table->tinyInteger('DM_type')->unsigned()->nullable();
// // field DM_DR type boolean
// $table->boolean('DM_DR');
// // field DM_nephropathy type boolean
// $table->boolean('DM_nephropathy');
// // field DM_neuropathy type boolean
// $table->boolean('DM_neuropathy');
// // field DM_on_diet type boolean
// $table->boolean('DM_on_diet');
// // field DM_on_oral_med type boolean
// $table->boolean('DM_on_oral_med');
// // field DM_on_insulin type boolean
// $table->boolean('DM_on_insulin');

// // field comorbid_HT type tinyInteger
// $table->tinyInteger('comorbid_HT')->unsigned()->nullable();
// // field comorbid_CAD type tinyInteger
// $table->tinyInteger('comorbid_CAD')->unsigned()->nullable();
// // field CAD_dx type tinyInteger
// $table->tinyInteger('CAD_dx')->unsigned()->nullable();
// // field CAD_dx_other type string
// $table->string('CAD_dx_other');
// // field comorbid_VHD type tinyInteger
// $table->tinyInteger('comorbid_VHD')->unsigned()->nullable();
// // field VHD_dx_AS type boolean
// $table->boolean('VHD_dx_AS');
// // field VHD_dx_AR type boolean
// $table->boolean('VHD_dx_AR');
// // field VHD_dx_MS type boolean
// $table->boolean('VHD_dx_MS');
// // field VHD_dx_MR type boolean
// $table->boolean('VHD_dx_MR');
// // field VHD_dx_TR type boolean
// $table->boolean('VHD_dx_TR');
// // field VHD_dx_other string
// $table->string('VHD_dx_other');


// // field comorbid_stroke type tinyInteger
// $table->tinyInteger('comorbid_stroke')->unsigned()->nullable();
// // field stroke_ischemic type boolean
// $table->boolean('stroke_ischemic');
// // field stroke_ischemic_result type boolean
// $table->boolean('stroke_ischemic_result');
// // field stroke_ischemic_result_on type boolean
// $table->boolean('stroke_ischemic_result_on');
// // field stroke_hemorrhagic type boolean
// $table->boolean('stroke_hemorrhagic');
// // field stroke_hemorrhagic_result type boolean
// $table->boolean('stroke_hemorrhagic_result');
// // field stroke_hemorrhagic_result_on type boolean
// $table->boolean('stroke_hemorrhagic_result_on');
// // field stroke_iembolic type boolean
// $table->boolean('stroke_iembolic');
// // field stroke_iembolic_result type boolean
// $table->boolean('stroke_iembolic_result');
// // field stroke_iembolic_result_on type boolean
// $table->boolean('stroke_iembolic_result_on');
// // field comorbid_COPD type tinyInteger
// $table->tinyInteger('comorbid_COPD')->unsigned()->nullable();
// // field comorbid_asthma type tinyInteger
// $table->tinyInteger('comorbid_asthma')->unsigned()->nullable();
// // field comorbid_CKD type tinyInteger
// $table->tinyInteger('comorbid_CKD')->unsigned()->nullable();
// // field CKD_stage type tinyInteger
// $table->tinyInteger('CKD_stage')->unsigned()->nullable();
// // field comorbid_hyperlipidemia tinyInteger
// $table->tinyInteger('comorbid_hyperlipidemia')->unsigned()->nullable();
// // field hyperlipidemia_type type tinyInteger
// $table->tinyInteger('hyperlipidemia_type')->unsigned()->nullable();


// // field comorbid_cirrhosis type tinyInteger
// $table->tinyInteger('comorbid_cirrhosis')->unsigned()->nullable();
// // field cirrhosis_cp_score type tinyInteger
// $table->tinyInteger('cirrhosis_cp_score')->unsigned()->nullable();
// // field cirrhosis_etiology_HBV type boolean
// $table->boolean('cirrhosis_etiology_HBV');
// // field cirrhosis_etiology_HCV type boolean
// $table->boolean('cirrhosis_etiology_HCV');
// // field cirrhosis_etiology_NASH type boolean
// $table->boolean('cirrhosis_etiology_NASH');
// // field cirrhosis_etiology_cryptogenic type boolean
// $table->boolean('cirrhosis_etiology_cryptogenic');
// // field cirrhosis_etiology_other type string
// $table->string('cirrhosis_etiology_other');
// // field comorbid_coagulopathy type tinyInteger
// $table->tinyInteger('comorbid_coagulopathy')->unsigned()->nullable();
// // field comorbid_HBV type tinyInteger
// $table->tinyInteger('comorbid_HBV')->unsigned()->nullable();
// // field comorbid_HCV type tinyInteger
// $table->tinyInteger('comorbid_HCV')->unsigned()->nullable();
// // field comorbid_HIV type tinyInteger
// $table->tinyInteger('comorbid_HIV')->unsigned()->nullable();
// // field HIV_pre_infect_TB type boolean
// $table->boolean('HIV_pre_infect_TB');
// // field HIV_pre_infect_PCP type boolean
// $table->boolean('HIV_pre_infect_PCP');
// // field HIV_pre_infect_candidiasis type boolean
// $table->boolean('HIV_pre_infect_candidiasis');
// // field HIV_pre_infect_CMV type boolean
// $table->boolean('HIV_pre_infect_CMV');
// // field HIV_pre_infect_other type string
// $table->string('HIV_pre_infect_other');


// // field comorbid_epilepsy type tinyInteger
// $table->tinyInteger('comorbid_epilepsy')->unsigned()->nullable();
// // field epilepsy_dx type tinyInteger
// $table->tinyInteger('epilepsy_dx')->unsigned()->nullable();
// // field epilepsy_dx_other type string
// $table->string('epilepsy_dx_other');
// // field comorbid_leukemia type tinyInteger
// $table->tinyInteger('comorbid_leukemia')->unsigned()->nullable();
// // field leukemia_dx type tinyInteger
// $table->tinyInteger('leukemia_dx')->unsigned()->nullable();
// // field comorbid_lymphoma type tinyInteger
// $table->tinyInteger('comorbid_lymphoma')->unsigned()->nullable();
// // field lymphoma_dx type tinyInteger
// $table->tinyInteger('lymphoma_dx')->unsigned()->nullable();
// // field lymphoma_dx_other type string
// $table->string('lymphoma_dx_other');
// // field comorbid_pacemaker_implant type tinyInteger
// $table->tinyInteger('comorbid_pacemaker_implant')->unsigned()->nullable();
// // field pacemaker_implant_type type tinyInteger
// $table->tinyInteger('pacemaker_implant_type')->unsigned()->nullable();
// // field pacemaker_implant_type_other type string
// $table->string('pacemaker_implant_type_other');
// // field comorbid_ICD type tinyInteger
// $table->tinyInteger('comorbid_ICD')->unsigned()->nullable();
// // field ICD_type type string
// $table->string('ICD_type');
// // field comorbid_cancer type tinyInteger
// $table->tinyInteger('comorbid_cancer')->unsigned()->nullable();
// // field cancer_at_lung type boolean
// $table->boolean('cancer_at_lung');
// // field cancer_at_liver type boolean
// $table->boolean('cancer_at_liver');
// // field cancer_at_colon type boolean
// $table->boolean('cancer_at_colon');
// // field cancer_at_breast type boolean
// $table->boolean('cancer_at_breast');
// // field cancer_at_prostate type boolean
// $table->boolean('cancer_at_prostate');
// // field cancer_at_cervix type boolean
// $table->boolean('cancer_at_cervix');
// // field cancer_at_pancreas type boolean
// $table->boolean('cancer_at_pancreas');
// // field cancer_at_brain type boolean
// $table->boolean('cancer_at_brain');
// // field cancer_at_other type string
// $table->string('cancer_at_other');
// // field comorbid_chronic_arthritis type tinyInteger
// $table->tinyInteger('comorbid_chronic_arthritis')->unsigned()->nullable();
// // field chronic_arthritis_CPPD type boolean
// $table->boolean('chronic_arthritis_CPPD');
// // field chronic_arthritis_rheumatoid type boolean
// $table->boolean('chronic_arthritis_rheumatoid');
// // field chronic_arthritis_OA type boolean
// $table->boolean('chronic_arthritis_OA');
// // field chronic_arthritis_spondyloarthropathy type boolean
// $table->boolean('chronic_arthritis_spondyloarthropathy');
// // field chronic_arthritis_other type string
// $table->string('chronic_arthritis_other');
// // field comorbid_SLE type tinyInteger
// $table->tinyInteger('comorbid_SLE')->unsigned()->nullable();
// // field comorbid_other_autoimmune_disease type tinyinteger
// $table->tinyInteger('comorbid_other_autoimmune_disease')->unsigned()->nullable();
// // field other_autoimmune_disease_dx_sjrogren_syndrome type boolean
// $table->boolean('other_autoimmune_disease_dx_sjrogren_syndrome');
// // field other_autoimmune_disease_dx_UCTD type boolean
// $table->boolean('other_autoimmune_disease_dx_UCTD');
// // field other_autoimmune_disease_dx_MCTD type boolean
// $table->boolean('other_autoimmune_disease_dx_MCTD');
// // field other_autoimmune_disease_dx_DMPM type boolean
// $table->boolean('other_autoimmune_disease_dx_DMPM');
// // field other_autoimmune_disease_dx_other type string
// $table->string('other_autoimmune_disease_dx_other');
// // field comorbid_TB type tinyInteger
// $table->tinyInteger('comorbid_TB')->unsigned()->nullable();
// // field TB_at_pulmonary type boolean
// $table->boolean('TB_at_pulmonary');
// // field TB_at_other type string
// $table->string('TB_at_other');
// // field comorbid_dementia type tinyInteger
// $table->tinyInteger('comorbid_dementia')->unsigned()->nullable();
// // field dementia_vascular type boolean
// $table->boolean('dementia_vascular');
// // field dementia_alzheimer type boolean
// $table->boolean('dementia_alzheimer');
// // field dementia_other type string
// $table->string('dementia_other');
// // field comorbid_psychiatric_illness type tinyInteger
// $table->tinyInteger('comorbid_psychiatric_illness')->unsigned()->nullable();
// // field psychiatric_illness_dx_schizophrenia type boolean
// $table->boolean('psychiatric_illness_dx_schizophrenia');
// // field psychiatric_illness_dx_major_depression type boolean
// $table->boolean('psychiatric_illness_dx_major_depression');
// // field psychiatric_illness_dx_bipolar_disorder type boolean
// $table->boolean('psychiatric_illness_dx_bipolar_disorder');
// // field psychiatric_illness_dx_adjustment_disorder type boolean
// $table->boolean('psychiatric_illness_dx_adjustment_disorder');
// // field psychiatric_illness_dx_Obcessive_compulsive_disorder type boolean
// $table->boolean('psychiatric_illness_dx_Obcessive_compulsive_disorder');
// // field psychiatric_illness_dx_other type string
// $table->string('psychiatric_illness_dx_other');
// // field comorbid_other type text
// $table->mediumText('comorbid_other');

// // field history_present_illness type text
// $table->text('history_present_illness');
// // field history_past_illness type text
// $table->text('history_past_illness');

// // field pregnant type tinyInteger
// $table->tinyInteger('pregnant')->nullable();
// // field pregnant_weeks type tinyInteger
// $table->tinyInteger('pregnant_weeks')->nullable();
// // field LMP type text
// $table->text('LMP');
// // field alcohol type tinyInteger
// $table->tinyInteger('alcohol')->nullable();
// // field alcohol_amount type text
// $table->text('alcohol_amount');
// // field smoking type tinyInteger
// $table->tinyInteger('smoking')->nullable();
// // field smoking_amount type text
// $table->text('smoking_amount');
// // field personal_social_history type text
// $table->text('personal_social_history');
// // field special_requirement_ng_tube type boolean
// $table->boolean('special_requirement_ng_tube');
// // field special_requirement_ng_suction type boolean
// $table->boolean('special_requirement_ng_suction');
// // field special_requirement_gastrostomy type boolean
// $table->boolean('special_requirement_gastrostomy');
// // field special_requirement_urinary_cath type boolean
// $table->boolean('special_requirement_urinary_cath');
// // field special_requirement_tracheostomy type boolean
// $table->boolean('special_requirement_tracheostomy');
// // field special_requirement_hearing_impairment type boolean
// $table->boolean('special_requirement_hearing_impairment');
// // field special_requirement_isolate_room type boolean
// $table->boolean('special_requirement_isolate_room');
// // field special_requirement_other type string
// $table->string('special_requirement_other');
// // field personal_family_history type text
// $table->text('personal_family_history');
// // field current_medications type text
// $table->text('current_medications');
// // field allergy type text
// $table->text('allergy');
// // field general_symtoms type text
// $table->text('general_symtoms');
// // field hair_skin_review type tinyInteger
// $table->tinyInteger('hair_skin_review')->nullable();
// // field hair_skin_review_detail type text
// $table->text('hair_skin_review_detail');
// // field head_review type tinyInteger
// $table->tinyInteger('head_review')->nullable();
// // field head_review_detail type text
// $table->text('head_review_detail');
// // field eye_ent_review type tinyInteger
// $table->tinyInteger('eye_ent_review')->nullable();
// // field eye_ent_review_detail type text
// $table->text('eye_ent_review_detail');
// // field breast_review type tinyInteger
// $table->tinyInteger('breast_review')->nullable();
// // field breast_review_detail type text
// $table->text('breast_review_detail');
// // field cvs_review type tinyInteger
// $table->tinyInteger('cvs_review')->nullable();
// // field cvs_review_detail type text
// $table->text('cvs_review_detail');
// // field rs_review type tinyInteger
// $table->tinyInteger('rs_review')->nullable();
// // field rs_review_detail type text
// $table->text('rs_review_detail');
// // field gi_review type tinyInteger
// $table->tinyInteger('gi_review')->nullable();
// // field gi_review_detail type text
// $table->text('gi_review_detail');
// // field gu_review type tinyInteger
// $table->tinyInteger('gu_review')->nullable();
// // field gu_review_detail type text
// $table->text('gu_review_detail');
// // field musculoskeletal_review type tinyInteger
// $table->tinyInteger('musculoskeletal_review')->nullable();
// // field musculoskeletal_review_detail type text
// $table->text('musculoskeletal_review_detail');
// // field nervous_review type tinyInteger
// $table->tinyInteger('nervous_review')->nullable();
// // field nervous_review_detail type text
// $table->text('nervous_review_detail');
// // field psychological_review type tinyInteger
// $table->tinyInteger('psychological_review')->nullable();
// // field psychological_review_detail type text
// $table->text('psychological_review_detail');
// // field system_review_other type text
// $table->text('system_review_other');
// // field temperature type decimal
// $table->decimal('temperature', 5, 2);
// // field pulse type decimal
// $table->decimal('pulse', 5, 2);
// // field respiratory_rate type decimal
// $table->decimal('respiratory_rate', 5, 2);
// // field SBP type decimal
// $table->decimal('SBP', 5, 2);
// // field DBP type decimal
// $table->decimal('DBP', 5, 2);
// // field height type decimal
// $table->decimal('height', 5, 2);
// // field estimated_height type boolean
// $table->boolean('estimated_height');
// // field weight type decimal
// $table->decimal('weight', 5, 2);
// // field estimated_weight type boolean
// $table->boolean('estimated_weight');
// // field BMI type decimal
// $table->decimal('BMI', 5, 2);
// // field spo2 type decimal
// $table->decimal('spo2', 5, 2);
// // field breathing type tinyInteger
// $table->tinyInteger('breathing')->nullable();
// // field breathing_on type tinyInteger
// $table->tinyInteger('breathing_on')->nullable();
// // field o2_rate type decimal
// $table->decimal('o2_rate', 5, 2);
// // field conscious_level type tinyInteger
// $table->tinyInteger('conscious_level')->nullable();
// // field GCS_E type tinyInteger
// $table->tinyInteger('GCS_E')->nullable();
// // field GCS_V type tinyInteger
// $table->tinyInteger('GCS_V')->nullable();
// // field GCS_M type tinyInteger
// $table->tinyInteger('GCS_M')->nullable();
// // field GCS_tot type tinyInteger
// $table->tinyInteger('GCS_tot')->nullable();
// // field mental_evaluate type tinyInteger
// $table->tinyInteger('mental_evaluate')->nullable();
// // field orientation_time type boolean
// $table->boolean('orientation_time');
// // field orientation_place type boolean
// $table->boolean('orientation_place');
// // field orientation_person type boolean
// $table->boolean('orientation_person');

// // field general_appearance type text
// $table->text('general_appearance');
// // field skin_exam type tinyInteger
// $table->tinyInteger('skin_exam')->nullable();
// // field skin_exam_detail type text
// $table->text('skin_exam_detail');
// // field head_exam type tinyInteger
// $table->tinyInteger('head_exam')->nullable();
// // field head_exam_detail type text
// $table->text('head_exam_detail');
// // field eyeENT_exam type tinyInteger
// $table->tinyInteger('eyeENT_exam')->nullable();
// // field eyeENT_exam_detail type text
// $table->text('eyeENT_exam_detail');
// // field neck_exam type tinyInteger
// $table->tinyInteger('neck_exam')->nullable();
// // field neck_exam_detail type text
// $table->text('neck_exam_detail');
// // field heart_exam type tinyInteger
// $table->tinyInteger('heart_exam')->nullable();
// // field heart_exam_detail type text
// $table->text('heart_exam_detail');
// // field lung_exam type tinyInteger
// $table->tinyInteger('lung_exam')->nullable();
// // field lung_exam_detail type text
// $table->text('lung_exam_detail');
// // field abdomen_exam type tinyInteger
// $table->tinyInteger('abdomen_exam')->nullable();
// // field abdomen_exam_detail type text
// $table->text('abdomen_exam_detail');
// // field nervous_exam type tinyInteger
// $table->tinyInteger('nervous_exam')->nullable();
// // field nervous_exam_detail type text
// $table->text('nervous_exam_detail');
// // field neuro_exam type tinyInteger
// $table->tinyInteger('neuro_exam')->nullable();
// // field neuro_exam_detail type text
// $table->text('neuro_exam_detail');
// // field extremities_exam type tinyInteger
// $table->tinyInteger('extremities_exam')->nullable();
// // field extremities_exam_detail type text
// $table->text('extremities_exam_detail');
// // field lymphNodes_exam type tinyInteger
// $table->tinyInteger('lymphNodes_exam')->nullable();
// // field lymphNodes_exam_detail type text
// $table->text('lymphNodes_exam_detail');
// // field breasts_exam type tinyInteger
// $table->tinyInteger('breasts_exam')->nullable();
// // field breasts_exam_detail type text
// $table->text('breasts_exam_detail');
// // field genitalia_exam type tinyInteger
// $table->tinyInteger('genitalia_exam')->nullable();
// // field genitalia_exam_detail type text
// $table->text('genitalia_exam_detail');
// // field rectal_exam type tinyInteger
// $table->tinyInteger('rectal_exam')->nullable();
// // field rectal_exam_detail type text
// $table->text('rectal_exam_detail');
// // field pertinent_investigation type text
// $table->text('pertinent_investigation');

// // field problem_list type text
// $table->text('problem_list');
// // field discussion type text
// $table->text('discussion');
// // field provisional_dx type text
// $table->text('provisional_dx');
// // field plan_investigation type text
// $table->text('plan_investigation');
// // field plan_management type text
// $table->text('plan_management');
// // field special_group_CPG type tinyInteger
// $table->tinyInteger('special_group_CPG');
// // field plan_consult type text
// $table->text('plan_consult');
// // field estimated_los type text
// $table->text('estimated_los');

// $table->integer('creator')->unsigned(); //relation on users
// $table->integer('updater')->unsigned(); //relation on users
// $table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('medicine_admission_notes');
	}
}
