<?php

namespace App\IPDNote\Obgyn;

use Illuminate\Database\Eloquent\Model;
use App\ModelHelper;


class ObgynAbortionNote extends Model
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
		'no_pregnancy_complication',
		'pregnancy_complication_Hb_E_trait',
		'pregnancy_complication_no_ANC',
		'pregnancy_complication_cesarean_labour_pain',
		'pregnancy_complication_HIV',
		'pregnancy_complication_HBV',
		'pregnancy_complication_HCV',
		'pregnancy_complication_DM',
		'pregnancy_complication_DM_type',
		'pregnancy_complication_DM_DR',
		'pregnancy_complication_DM_nephropathy',
		'pregnancy_complication_DM_neuropathy',
		'pregnancy_complication_DM_on_diet',
		'pregnancy_complication_DM_on_oral_meds',
		'pregnancy_complication_DM_on_insulin',
		'specificed_pregnancy_complication_DM',
		'pregnancy_complication_HT',
		'specificed_pregnancy_complication_HT',
		'other_pregnancy_complication',
		'date_abortion',
		'abortion_diagnosis_hydatidiform_mole',
		'abortion_diagnosis_blighted_ovum',
		'abortion_diagnosis_missed_abortion',
		'abortion_diagnosis_dead_fetus_in_utero',
		'other_abortion_diagnosis',
		'abortion',
		'abortion_stage',
		'other_abortion_stage',
		'abortion_outcome',
		'gender',
		'fetus_weight_grams',
		'fetus_EBL_ml',
		'placenta_weight_grams',
		'placenta_abnormality',
		'quantity_tea_spoon',
		'quantity_table_spoon',
		'product_weight_grams',
		'conception_EBL_ml',
		'rx_genitourinary_instillation',
		'rx_oxcytocin_infusion',
		'rx_dilatation_curettage',
		'rx_evaculation_curettage',
		'rx_aspiration_suction_curettage',
		'rx_hysterotomy',
		'other_treatment',
		'contraception',
		'other_contraception',
	];

	protected $dates = ['date_abortion'];

	public function getRadioInputs() {
		return [
			'abortion',
			'abortion_stage',
			'abortion_outcome',
			'gender',
			'contraception',
			'pregnancy_complication_DM_type',
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
			'no_pregnancy_complication',
			'pregnancy_complication_Hb_E_trait',
			'pregnancy_complication_no_ANC',
			'pregnancy_complication_cesarean_labour_pain',
			'pregnancy_complication_HIV',
			'pregnancy_complication_HBV',
			'pregnancy_complication_HCV',
			'pregnancy_complication_DM',
			'pregnancy_complication_DM_DR',
			'pregnancy_complication_DM_nephropathy',
			'pregnancy_complication_DM_neuropathy',
			'pregnancy_complication_DM_on_diet',
			'pregnancy_complication_DM_on_oral_meds',
			'pregnancy_complication_DM_on_insulin',
			'pregnancy_complication_HT',
			'abortion_diagnosis_hydatidiform_mole',
			'abortion_diagnosis_blighted_ovum',
			'abortion_diagnosis_missed_abortion',
			'abortion_diagnosis_dead_fetus_in_utero',
			'rx_genitourinary_instillation',
			'rx_oxcytocin_infusion',
			'rx_dilatation_curettage',
			'rx_evaculation_curettage',
			'rx_aspiration_suction_curettage',
			'rx_hysterotomy',
		];
	}

	public function getTextInputs() {
		return [
			'other_drug_allergy',
			'other_allergy',
			'spectified_diseases',
			'specified_surgery',
			'specified_treatment',
			'specificed_pregnancy_complication_DM',
			'specificed_pregnancy_complication_HT',
			'other_pregnancy_complication',
			'other_abortion_diagnosis',
			'other_abortion_stage',
			'placenta_abnormality',
			'other_treatment',
			'other_contraception',
		];
	}

	public function getNumericInputs() {
		return [
			'G',
			'P',
			'A',
			'GA_weeks',
			'GA_days',
			'quantity_tea_spoon',
			'quantity_table_spoon',
			'fetus_weight_grams',
			'fetus_EBL_ml',
			'placenta_weight_grams',
			'product_weight_grams',
			'conception_EBL_ml',
		];
	}

	public function setDateAbortionAttribute($value) {
		$this->attributes['date_abortion'] = ModelHelper::parseDateData($value);
	}

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}
}
