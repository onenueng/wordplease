<?php

namespace App\IPDNote\Obgyn;

use Illuminate\Database\Eloquent\Model;
use App\ModelHelper;

class ObgynNewbornNote extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'gender',
		'born_single_or_multiple',
		'born_oder',
		'weight_grams',
		'apgar_1min',
		'apgar_5min',
		'born_status',
		'skin_color',
		'pulse',
		'reflex',
		'muscle_tone',
		'breathing',
		'jaundice_physiological',
		'jaundice_neonatal_preterm_delivery',
		'jaundice_neonatal_breast_milk',
		'jaundice_ABO_incompatible',
		'jaundice_G_6_PD_deficiency',
		'jaundice_unspecified',
		'other_jaundice',
		'birth_asphyxia',
		'care_supervision_healthy',
		'care_phototherapy',
		'care_frenulotomy',
		'care_UVA',
		'care_UVC',
		'care_ET_tube_intubation',
		'other_care',
		'G',
		'P',
		'GA_weeks',
		'GA_weeks',
		'no_pregnancy_complication',
		'pregnancy_complication_PROM',
		'pregnancy_complication_fail_labour_meds_induce',
		'pregnancy_complication_subserous_myoma',
		'pregnancy_complication_gestational_HT',
		'pregnancy_complication_adenomyosis',
		'pregnancy_complication_advanced_maternal_age',
		'pregnancy_complication_alpha_thal_trait',
		'pregnancy_complication_Hb_E_trait',
		'pregnancy_complication_pre_C_S_labour_pain',
		'pregnancy_complication_pre_C_S_labour_no_pain',
		'pregnancy_complication_Hx_clear_cell_adeno_CA_ovary',
		'other_pregnancy_complication',
		'no_first_2nd_stage_labour_complication',
		'first_2nd_stage_labour_complication_placenta_previa_hemorrha',
		'first_2nd_stage_labour_complication_placenta_previa_no_hemorrha',
		'first_2nd_stage_labour_complication_CPD',
		'first_2nd_stage_labour_complication_mild_pelvic_adhesion',
		'first_2nd_stage_labour_complication_moderate_pelvic_adhesion',
		'first_2nd_stage_labour_complication_severe_pelvic_adhesion',
		'first_2nd_stage_labour_complication_fetal_tachycardia',
		'first_2nd_stage_labour_complication_fetal_distress',
		'first_2nd_stage_labour_complication_maternal_acute_febrile',
		'other_first_2nd_stage_labour_complication',
		'delivery_mode',
		'other_delivery_mode',
		'other_3rd_stage_labour_complication',
		'no_postpartum_complication',
		'postpartum_complication_endometritis',
		'postpartum_complication_PPH',
		'other_postpartum_complication',
		'placenta_weight_grams',
		'specificed_placenta_abnomality',
		'home_nursing',
		'date_appointment_1',
		'detail_appointment_1',
		'date_appointment_2',
		'detail_appointment_2',
		'date_appointment_3',
		'detail_appointment_3',
		'date_appointment_4',
		'detail_appointment_4',
		'date_appointment_5',
		'detail_appointment_5',
	];

	protected $dates = [
		'date_appointment_1',
		'date_appointment_2',
		'date_appointment_3',
		'date_appointment_4',
		'date_appointment_5',
	];

	public function getRadioInputs() {
		return [
			'gender',
			'born_single_or_multiple',
			'born_status',
			'skin_color',
			'pulse',
			'reflex',
			'muscle_tone',
			'breathing',
			'birth_asphyxia',
			'delivery_mode',
		];
	}

	public function getCheckInputs() {
		return [	
			'jaundice_physiological',
			'jaundice_neonatal_preterm_delivery',
			'jaundice_neonatal_breast_milk',
			'jaundice_ABO_incompatible',
			'jaundice_G_6_PD_deficiency',
			'jaundice_unspecified',
			'care_supervision_healthy',
			'care_phototherapy',
			'care_frenulotomy',
			'care_UVA',
			'care_UVC',
			'care_ET_tube_intubation',
			'no_pregnancy_complication',
			'pregnancy_complication_PROM',
			'pregnancy_complication_fail_labour_meds_induce',
			'pregnancy_complication_subserous_myoma',
			'pregnancy_complication_gestational_HT',
			'pregnancy_complication_adenomyosis',
			'pregnancy_complication_advanced_maternal_age',
			'pregnancy_complication_alpha_thal_trait',
			'pregnancy_complication_Hb_E_trait',
			'pregnancy_complication_pre_C_S_labour_pain',
			'pregnancy_complication_pre_C_S_labour_no_pain',
			'pregnancy_complication_Hx_clear_cell_adeno_CA_ovary',
			'no_first_2nd_stage_labour_complication',
			'first_2nd_stage_labour_complication_placenta_previa_hemorrha',
			'first_2nd_stage_labour_complication_placenta_previa_no_hemorrha',
			'first_2nd_stage_labour_complication_CPD',
			'first_2nd_stage_labour_complication_mild_pelvic_adhesion',
			'first_2nd_stage_labour_complication_moderate_pelvic_adhesion',
			'first_2nd_stage_labour_complication_severe_pelvic_adhesion',
			'first_2nd_stage_labour_complication_fetal_tachycardia',
			'first_2nd_stage_labour_complication_fetal_distress',
			'first_2nd_stage_labour_complication_maternal_acute_febrile',
			'no_postpartum_complication',
			'postpartum_complication_endometritis',
			'postpartum_complication_PPH',
		];
	}

	public function getTextInputs() {
		return [
			'other_jaundice',
			'other_care',
			'other_pregnancy_complication',
			'other_first_2nd_stage_labour_complication',
			'other_delivery_mode',
			'specificed_placenta_abnomality',
			'other_3rd_stage_labour_complication',
			'other_postpartum_complication',
			'home_nursing',
			'detail_appointment_1',
			'detail_appointment_2',
			'detail_appointment_3',
			'detail_appointment_4',
			'detail_appointment_5',
		];
	}

	public function getNumericInputs() {
		return [
			'born_oder',
			'apgar_1min',
			'apgar_5min',
			'G',
			'P',
			'GA_weeks',
			'GA_days',
			'weight_grams',
			'placenta_weight_grams',
		];
	}

	public function setDateAppointment1Attribute($value) { 
		$this->attributes['date_appointment_1'] = ModelHelper::parseDateData($value);
	}
	public function setDateAppointment2Attribute($value) { 
		$this->attributes['date_appointment_2'] = ModelHelper::parseDateData($value);
	}
	public function setDateAppointment3Attribute($value) { 
		$this->attributes['date_appointment_3'] = ModelHelper::parseDateData($value);
	}
	public function setDateAppointment4Attribute($value) { 
		$this->attributes['date_appointment_4'] = ModelHelper::parseDateData($value);
	}
	public function setDateAppointment5Attribute($value) { 
		$this->attributes['date_appointment_5'] = ModelHelper::parseDateData($value);
	}

	public function lastSeenAppointmentData() {
		for ($i = 5; $i >= 2; $i--) {
			if (
				$this->attributes['date_appointment_' . $i] || 
				$this->attributes['detail_appointment_' . $i]
			) return $i;
		}
		return 1;
	}

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}
	
}
