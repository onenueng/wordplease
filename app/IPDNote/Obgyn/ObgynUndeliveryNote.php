<?php

namespace App\IPDNote\Obgyn;

use Illuminate\Database\Eloquent\Model;

class ObgynUndeliveryNote extends Model
{

	public $timestamps = false;

	protected $fillable = [
		'G',
		'P',
		'A',
		'GA_weeks',
		'GA_days',
		'no_allergy',
		'allergy_penicilin',
		'allergy_sulfonamide',
		'allergy_NSAIDS',
		'other_drug_allergy',
		'other_allergy',
		'no_disease',
		'spectified_diseases',
		'no_treatment',
		'specified_surgery',
		'specified_treatment',
		'obstetrics_complication_hyperemesis_gravidarum',
		'obstetrics_complication_false_labour_before_37_wks',
		'obstetrics_complication_false_labour_after_37_wks',
		'obstetrics_complication_treatened_preterm_labour',
		'obstetrics_complication_preterm_labour_without_delivery',
		'other_obstetrics_complication',
		'medical_complication_thalassemia',
		'medical_complication_DM',
		'medical_complication_DM_type',
		'medical_complication_DM_DR',
		'medical_complication_DM_nephropathy',
		'medical_complication_DM_neuropathy',
		'medical_complication_DM_on_diet',
		'medical_complication_DM_on_oral_meds',
		'medical_complication_DM_on_insulin',
		'specificed_medical_complication_DM',
		'medical_complication_HT',
		'other_medical_complication',
		'other_complication',
		'RX_medication_inhibit_labour',
		'RX_medication_inhibit_labour_bricanyl',
		'RX_medication_inhibit_labour_MgSO4',
		'RX_medication_inhibit_labour_other',
		'RX_blood_transfusions',
		'PCR',
		'RX_other_blood_transfusions',
		'RX_control_BP',
		'RX_specificed_control_BP',
		'RX_control_blood_sugar',
		'RX_control_blood_sugar_diet',
		'RX_control_blood_sugar_insulin',
		'RX_other_control_blood_sugar',
		'RX_antibiotics',
		'RX_specificed_antibiotics',
		'RX_electolytes',
		'RX_specificed_electolytes',
		'RX_steriod',
		'RX_specificed_steriod',
		'other_treatments',
	];

	public function getRadioInputs() {
		return [
			'medical_complication_thalassemia',
			'medical_complication_DM_type',
			'RX_medication_inhibit_labour',
			'RX_blood_transfusions',
			'RX_control_BP',
			'RX_control_blood_sugar',
			'RX_antibiotics',
			'RX_electolytes',
			'RX_steriod',
		];
	}

	public function getCheckInputs() {
		return [
			'no_allergy',
			'allergy_penicilin',
			'allergy_sulfonamide',
			'allergy_NSAIDS',
			'no_disease',
			'no_treatment',
			'obstetrics_complication_hyperemesis_gravidarum',
			'obstetrics_complication_false_labour_before_37_wks',
			'obstetrics_complication_false_labour_after_37_wks',
			'obstetrics_complication_treatened_preterm_labour',
			'obstetrics_complication_preterm_labour_without_delivery',
			'medical_complication_DM',
			'medical_complication_DM_DR',
			'medical_complication_DM_nephropathy',
			'medical_complication_DM_neuropathy',
			'medical_complication_DM_on_diet',
			'medical_complication_DM_on_oral_meds',
			'medical_complication_DM_on_insulin',
			'medical_complication_HT',
			'RX_medication_inhibit_labour_bricanyl',
			'RX_medication_inhibit_labour_MgSO4',
			'RX_control_blood_sugar_diet',
			'RX_control_blood_sugar_insulin',
		];
	}

	public function getTextInputs() {
		return [
			'other_drug_allergy',
			'other_allergy',
			'spectified_diseases',
			'specified_surgery',
			'specified_treatment',
			'other_obstetrics_complication',
			'specificed_medical_complication_DM',
			'specificed_medical_complication_HT',
			'other_medical_complication',
			'other_complication',
			'RX_medication_inhibit_labour_other',
			'RX_other_blood_transfusions',
			'RX_specificed_control_BP',
			'RX_other_control_blood_sugar',
			'RX_specificed_antibiotics',
			'RX_specificed_electolytes',
			'RX_specificed_steriod',
			'other_treatments',
		];
	}

	public function getNumericInputs() {
		return [
			'G',
			'P',
			'A',
			'GA_weeks',
			'GA_days',
			'PCR',
		];
	}

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}

}
