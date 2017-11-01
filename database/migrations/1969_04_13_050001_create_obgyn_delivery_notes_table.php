<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObgynDeliveryNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('obgyn_delivery_notes', function (Blueprint $table) {
			$table->integer('id');
			$table->primary('id'); // relation on notes.
			// field G type tinyInteger.
			$table->tinyInteger('G')->unsigned()->nullable();
			// field P type tinyInteger.
			$table->tinyInteger('P')->unsigned()->nullable();
			// field A type tinyInteger.
			$table->tinyInteger('A')->unsigned()->nullable();
			// field GA_weeks type tinyInteger.
			$table->tinyInteger('GA_weeks')->unsigned()->nullable();
			// field GA_days type tinyInteger.
			$table->tinyInteger('GA_days')->unsigned()->nullable();
			// field no_allergy type checkbox.
			$table->boolean('no_allergy');
			// field allergy_penicilin type checkbox.
			$table->boolean('allergy_penicilin');
			// field allergy_sulfonamide type checkbox.
			$table->boolean('allergy_sulfonamide');
			// field allergy_NSAIDS type checkbox.
			$table->boolean('allergy_NSAIDS');
			// field other_drug_allergy type string.
			$table->string('other_drug_allergy')->nullable();
			// field other_allergy type string.
			$table->string('other_allergy')->nullable();
			// field no_disease type checkbox.
			$table->boolean('no_disease');
			// field spectified_diseases type string.
			$table->string('spectified_diseases')->nullable();
			// field no_treatment type checkbox.
			$table->boolean('no_treatment');
			// field specified_surgery type string.
			$table->string('specified_surgery')->nullable();
			// field specified_treatment type string.
			$table->string('specified_treatment')->nullable();
			// field no_pregnancy_complication type checkbox.
			$table->boolean('no_pregnancy_complication');
			// field pregnancy_complication_Hb_E_trait type checkbox.
			$table->boolean('pregnancy_complication_Hb_E_trait');
			// field pregnancy_complication_no_ANC type checkbox.
			$table->boolean('pregnancy_complication_no_ANC');
			// field pregnancy_complication_cesarean_labour_pain type checkbox.
			$table->boolean('pregnancy_complication_cesarean_labour_pain');
			// field pregnancy_complication_HIV type checkbox.
			$table->boolean('pregnancy_complication_HIV');
			// field pregnancy_complication_HBV type checkbox.
			$table->boolean('pregnancy_complication_HBV');
			// field pregnancy_complication_HCV type checkbox.
			$table->boolean('pregnancy_complication_HCV');
			// field pregnancy_complication_DM type checkbox.
			$table->boolean('pregnancy_complication_DM');
			// field pregnancy_complication_DM_type type tinyInteger.
			$table->tinyInteger('pregnancy_complication_DM_type')->unsigned()->nullable();
			// field pregnancy_complication_DM_DR type checkbox.
			$table->boolean('pregnancy_complication_DM_DR');
			// field pregnancy_complication_DM_nephropathy type checkbox.
			$table->boolean('pregnancy_complication_DM_nephropathy');
			// field pregnancy_complication_DM_neuropathy type checkbox.
			$table->boolean('pregnancy_complication_DM_neuropathy');
			// field pregnancy_complication_DM_on_diet type checkbox.
			$table->boolean('pregnancy_complication_DM_on_diet');
			// field pregnancy_complication_DM_on_oral_meds type checkbox.
			$table->boolean('pregnancy_complication_DM_on_oral_meds');
			// field pregnancy_complication_DM_on_insulin type checkbox.
			$table->boolean('pregnancy_complication_DM_on_insulin');
			// field specificed_pregnancy_complication_DM type string.
			$table->string('specificed_pregnancy_complication_DM')->nullable();
			// field pregnancy_complication_HT type checkbox.
			$table->boolean('pregnancy_complication_HT');
			// field specificed_pregnancy_complication_HT type string.
			$table->string('specificed_pregnancy_complication_HT')->nullable();
			// field other_pregnancy_complication type string.
			$table->string('other_pregnancy_complication')->nullable();
			// field datetime_delivery type datetime.
			$table->datetime('datetime_delivery')->nullable();
			// field no_first_2nd_stage_labour_complication type checkbox.
			$table->boolean('no_first_2nd_stage_labour_complication');
			// field first_2nd_stage_labour_complication_placenta_previa_hemorrha type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_placenta_previa_hemorrha');
			// field first_2nd_stage_labour_complication_placenta_previa_no_hemorrha type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_placenta_previa_no_hemorrha');
			// field first_2nd_stage_labour_complication_CPD type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_CPD');
			// field first_2nd_stage_labour_complication_mild_pelvic_adhesion type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_mild_pelvic_adhesion');
			// field first_2nd_stage_labour_complication_moderate_pelvic_adhesion type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_moderate_pelvic_adhesion');
			// field first_2nd_stage_labour_complication_severe_pelvic_adhesion type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_severe_pelvic_adhesion');
			// field first_2nd_stage_labour_complication_fetal_tachycardia type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_fetal_tachycardia');
			// field first_2nd_stage_labour_complication_fetal_distress type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_fetal_distress');
			// field first_2nd_stage_labour_complication_maternal_acute_febrile type checkbox.
			$table->boolean('first_2nd_stage_labour_complication_maternal_acute_febrile');
			// field other_first_2nd_stage_labour_complication_1_2 type string.
			$table->string('other_first_2nd_stage_labour_complication')->nullable();
			// field delivery_mode type tinyInteger.
			$table->tinyInteger('delivery_mode')->unsigned()->nullable();
			// field other_delivery_mode type string.
			$table->string('other_delivery_mode')->nullable();
			// field meconium_stain_in_amniotic_fluid type tinyInteger.
			$table->tinyInteger('meconium_stain_in_amniotic_fluid')->unsigned()->nullable();
			// field episiotomy type tinyInteger.
			$table->tinyInteger('episiotomy')->unsigned()->nullable();
			// field perineal_tear type tinyInteger.
			$table->tinyInteger('perineal_tear')->unsigned()->nullable();
			// field other_perineal_tear type string.
			$table->string('other_perineal_tear')->nullable();
			// field no_third_stage_labour_complication type checkbox.
			$table->boolean('no_third_stage_labour_complication');
			// field third_stage_labour_complication_PPH type checkbox.
			$table->boolean('third_stage_labour_complication_PPH');
			// field third_stage_labour_complication_retained_placenta type checkbox.
			$table->boolean('third_stage_labour_complication_retained_placenta');
			// field other_third_stage_labour_complication type string.
			$table->string('other_third_stage_labour_complication')->nullable();
			// field third_stage_labour_complication_EBL_ml type smallInteger.
			$table->smallInteger('third_stage_labour_complication_EBL_ml')->unsigned()->nullable();
			// field third_stage_labour_complication_procedure type string.
			$table->string('third_stage_labour_complication_procedure')->nullable();
			// field born_single_or_multiple type tinyInteger.
			$table->tinyInteger('born_single_or_multiple')->unsigned()->nullable();
			// field multiple_born_number type tinyInteger.
			$table->tinyInteger('multiple_born_number')->unsigned()->nullable();
			// field gender_born_no_1 type tynyInteger.
			$table->tinyInteger('gender_born_no_1')->unsigned()->nullable();
			// field weight_grams_born_no_1 type smallInteger.
			$table->smallInteger('weight_grams_born_no_1')->unsigned()->nullable();
			// field apgar_1min_born_no_1 type tinyInteger.
			$table->tinyInteger('apgar_1min_born_no_1')->unsigned()->nullable();
			// field apgar_5min_born_no_1 type tinyInteger.
			$table->tinyInteger('apgar_5min_born_no_1')->unsigned()->nullable();
			// field birth_status_born_no_1 type tinyInteger.
			$table->tinyInteger('birth_status_born_no_1')->unsigned()->nullable();
			// field note_born_no_1 type string.
			$table->string('note_born_no_1')->nullable();
			// field gender_born_no_2 type tynyInteger.
			$table->tinyInteger('gender_born_no_2')->unsigned()->nullable();
			// field weight_grams_born_no_2 type smallInteger.
			$table->smallInteger('weight_grams_born_no_2')->unsigned()->nullable();
			// field apgar_1min_born_no_2 type tinyInteger.
			$table->tinyInteger('apgar_1min_born_no_2')->unsigned()->nullable();
			// field apgar_5min_born_no_2 type tinyInteger.
			$table->tinyInteger('apgar_5min_born_no_2')->unsigned()->nullable();
			// field birth_status_born_no_2 type tinyInteger.
			$table->tinyInteger('birth_status_born_no_2')->unsigned()->nullable();
			// field note_born_no_2 type string.
			$table->string('note_born_no_2')->nullable();
			// field gender_born_no_3 type tynyInteger.
			$table->tinyInteger('gender_born_no_3')->unsigned()->nullable();
			// field weight_grams_born_no_3 type smallInteger.
			$table->smallInteger('weight_grams_born_no_3')->unsigned()->nullable();
			// field apgar_1min_born_no_3 type tinyInteger.
			$table->tinyInteger('apgar_1min_born_no_3')->unsigned()->nullable();
			// field apgar_5min_born_no_3 type tinyInteger.
			$table->tinyInteger('apgar_5min_born_no_3')->unsigned()->nullable();
			// field birth_status_born_no_3 type tinyInteger.
			$table->tinyInteger('birth_status_born_no_3')->unsigned()->nullable();
			// field note_born_no_3 type string.
			$table->string('note_born_no_3')->nullable();
			// field gender_born_no_4 type tynyInteger.
			$table->tinyInteger('gender_born_no_4')->unsigned()->nullable();
			// field weight_grams_born_no_4 type smallInteger.
			$table->smallInteger('weight_grams_born_no_4')->unsigned()->nullable();
			// field apgar_1min_born_no_4 type tinyInteger.
			$table->tinyInteger('apgar_1min_born_no_4')->unsigned()->nullable();
			// field apgar_5min_born_no_4 type tinyInteger.
			$table->tinyInteger('apgar_5min_born_no_4')->unsigned()->nullable();
			// field birth_status_born_no_4 type tinyInteger.
			$table->tinyInteger('birth_status_born_no_4')->unsigned()->nullable();
			// field note_born_no_4 type string.
			$table->string('note_born_no_4')->nullable();
			// field gender_born_no_5 type tynyInteger.
			$table->tinyInteger('gender_born_no_5')->unsigned()->nullable();
			// field weight_grams_born_no_5 type smallInteger.
			$table->smallInteger('weight_grams_born_no_5')->unsigned()->nullable();
			// field apgar_1min_born_no_5 type tinyInteger.
			$table->tinyInteger('apgar_1min_born_no_5')->unsigned()->nullable();
			// field apgar_5min_born_no_5 type tinyInteger.
			$table->tinyInteger('apgar_5min_born_no_5')->unsigned()->nullable();
			// field birth_status_born_no_5 type tinyInteger.
			$table->tinyInteger('birth_status_born_no_5')->unsigned()->nullable();
			// field note_born_no_5 type string.
			$table->string('note_born_no_5')->nullable();
			// field placenta_weight_grams_1 type smallInteger.
			$table->smallInteger('placenta_weight_grams_1')->unsigned()->nullable();
			// field abnormal_placenta_1 type string.
			$table->string('abnormal_placenta_1')->nullable();
			// field placenta_weight_grams_2 type smallInteger.
			$table->smallInteger('placenta_weight_grams_2')->unsigned()->nullable();
			// field abnormal_placenta_2 type string.
			$table->string('abnormal_placenta_2')->nullable();
			// field placenta_weight_grams_3 type smallInteger.
			$table->smallInteger('placenta_weight_grams_3')->unsigned()->nullable();
			// field abnormal_placenta_3 type string.
			$table->string('abnormal_placenta_3')->nullable();
			// field placenta_weight_grams_4 type smallInteger.
			$table->smallInteger('placenta_weight_grams_4')->unsigned()->nullable();
			// field abnormal_placenta_4 type string.
			$table->string('abnormal_placenta_4')->nullable();
			// field placenta_weight_grams_5 type smallInteger.
			$table->smallInteger('placenta_weight_grams_5')->unsigned()->nullable();
			// field abnormal_placenta_5 type string.
			$table->string('abnormal_placenta_5')->nullable();
			// field specificed_postpartum_complications type string.
			$table->string('specificed_postpartum_complications')->nullable();
			// field contraception type tinyInteger.
			$table->tinyInteger('contraception')->unsigned()->nullable();
			// field other_contraception type string.
			$table->string('other_contraception')->nullable();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('obgyn_delivery_notes');
	}
}
