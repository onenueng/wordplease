<?php

namespace App\IPDNote\Obgyn;

use Illuminate\Database\Eloquent\Model;
use App\ModelHelper;


class ObgynDeliveryNote extends Model
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
		'datetime_delivery',
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
		'meconium_stain_in_amniotic_fluid',
		'episiotomy',
		'perineal_tear',
		'other_perineal_tear',
		'no_third_stage_labour_complication',
		'third_stage_labour_complication_PPH',
		'third_stage_labour_complication_retained_placenta',
		'other_third_stage_labour_complication',
		'third_stage_labour_complication_EBL_ml',
		'third_stage_labour_complication_procedure',
		'born_single_or_multiple',
		'multiple_born_number',
		'gender_born_no_1',
		'weight_grams_born_no_1',
		'apgar_1min_born_no_1',
		'apgar_5min_born_no_1',
		'birth_status_born_no_1',
		'note_born_no_1',
		'gender_born_no_2',
		'weight_grams_born_no_2',
		'apgar_1min_born_no_2',
		'apgar_5min_born_no_2',
		'birth_status_born_no_2',
		'note_born_no_2',
		'gender_born_no_3',
		'weight_grams_born_no_3',
		'apgar_1min_born_no_3',
		'apgar_5min_born_no_3',
		'birth_status_born_no_3',
		'note_born_no_3',
		'gender_born_no_4',
		'weight_grams_born_no_4',
		'apgar_1min_born_no_4',
		'apgar_5min_born_no_4',
		'birth_status_born_no_4',
		'note_born_no_4',
		'gender_born_no_5',
		'weight_grams_born_no_5',
		'apgar_1min_born_no_5',
		'apgar_5min_born_no_5',
		'birth_status_born_no_5',
		'note_born_no_5',
		'placenta_weight_grams_1',
		'abnormal_placenta_1',
		'placenta_weight_grams_2',
		'abnormal_placenta_2',
		'placenta_weight_grams_3',
		'abnormal_placenta_3',
		'placenta_weight_grams_4',
		'abnormal_placenta_4',
		'placenta_weight_grams_5',
		'abnormal_placenta_5',
		'specificed_postpartum_complications',
		'contraception',
		'other_contraception',
	];
	protected $dates = ['datetime_delivery'];

	public function getRadioInputs() {
		return [
			'pregnancy_complication_DM_type',
			'delivery_mode',
			'meconium_stain_in_amniotic_fluid',
			'episiotomy',
			'perineal_tear',
			'born_single_or_multiple',
			'gender_born_no_1',
			'birth_status_born_no_1',
			'gender_born_no_2',
			'birth_status_born_no_2',
			'gender_born_no_3',
			'birth_status_born_no_3',
			'gender_born_no_4',
			'birth_status_born_no_4',
			'gender_born_no_5',
			'birth_status_born_no_5',
			'contraception',
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
			'no_first_2nd_stage_labour_complication_1_2',
			'first_2nd_stage_labour_complication_placenta_previa_hemorrha',
			'first_2nd_stage_labour_complication_placenta_previa_no_hemorrha',
			'first_2nd_stage_labour_complication_CPD',
			'first_2nd_stage_labour_complication_mild_pelvic_adhesion',
			'first_2nd_stage_labour_complication_moderate_pelvic_adhesion',
			'first_2nd_stage_labour_complication_severe_pelvic_adhesion',
			'first_2nd_stage_labour_complication_fetal_tachycardia',
			'first_2nd_stage_labour_complication_fetal_distress',
			'first_2nd_stage_labour_complication_maternal_acute_febrile',
			'no_third_stage_labour_complication',
			'third_stage_labour_complication_PPH',
			'third_stage_labour_complication_retained_placenta',
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
			'other_first_2nd_stage_labour_complication',
			'other_delivery_mode',
			'other_perineal_tear',
			'other_third_stage_labour_complication',
			'third_stage_labour_complication_procedure',
			'note_born_no_1',
			'note_born_no_2',
			'note_born_no_3',
			'note_born_no_4',
			'note_born_no_5',
			'abnormal_placenta_1',
			'abnormal_placenta_2',
			'abnormal_placenta_3',
			'abnormal_placenta_4',
			'abnormal_placenta_5',
			'specificed_postpartum_complications',
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
			'apgar_1min_born_no_1',
			'apgar_5min_born_no_1',
			'apgar_1min_born_no_2',
			'apgar_5min_born_no_2',
			'apgar_1min_born_no_3',
			'apgar_5min_born_no_3',
			'apgar_1min_born_no_4',
			'apgar_5min_born_no_4',
			'apgar_1min_born_no_5',
			'apgar_5min_born_no_5',
			'third_stage_labour_complication_EBL_ml',
			'multiple_born_number',
			'weight_grams_born_no_1',
			'weight_grams_born_no_2',
			'weight_grams_born_no_3',
			'weight_grams_born_no_4',
			'weight_grams_born_no_5',
			'placenta_weight_grams_1',
			'placenta_weight_grams_2',
			'placenta_weight_grams_3',
			'placenta_weight_grams_4',
			'placenta_weight_grams_5',
		];
	}

	public function lastSeenBornData() {
		for ($i = 5; $i >= 2; $i--) {
			if (
				$this->attributes['gender_born_no_' . $i] || 
				$this->attributes['weight_grams_born_no_' . $i] || 
				$this->attributes['apgar_1min_born_no_' . $i] || 
				$this->attributes['apgar_5min_born_no_' . $i] || 
				$this->attributes['birth_status_born_no_' . $i] || 
				$this->attributes['note_born_no_' . $i]
			) return $i;
		}
		return 1;
	}

	public function lastSeenPlacentaData() {
		for ($i = 5; $i >= 2; $i--) {
			if (
				$this->attributes['placenta_weight_grams_' . $i] || 
				$this->attributes['abnormal_placenta_' . $i]
			) return $i;
		}
		return 1;
	} 

	// datetime_delivery
	public function setDatetimeDeliveryAttribute($value) { $this->attributes['datetime_delivery'] = ModelHelper::parseDateTimeData($value); }

	

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}
}
