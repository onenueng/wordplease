<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObgynNewbornNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('obgyn_newborn_notes', function (Blueprint $table) {
			$table->integer('id');
			$table->primary('id'); // relation on notes.
			// field gender type tinyInteger.
			$table->tinyInteger('gender')->unsigned()->nullable();
			// field born_single_or_multiple type tinyInteger.
			$table->tinyInteger('born_single_or_multiple')->unsigned()->nullable();
			// field born_oder type tinyInteger.
			$table->tinyInteger('born_oder')->unsigned()->nullable();
			// field weight_grams type smallInteger.
			$table->smallInteger('weight_grams')->unsigned()->nullable();
			// field apgar_1min type tinyInteger.
			$table->tinyInteger('apgar_1min')->unsigned()->nullable();
			// field apgar_5min type tinyInteger.
			$table->tinyInteger('apgar_5min')->unsigned()->nullable();
			// field born_status type tinyInteger.
			$table->tinyInteger('born_status')->unsigned()->nullable();
			// field skin_color type tinyInteger.
			$table->tinyInteger('skin_color')->unsigned()->nullable();
			// field pulse type tinyInteger.
			$table->tinyInteger('pulse')->unsigned()->nullable();
			// field reflex type tinyInteger.
			$table->tinyInteger('reflex')->unsigned()->nullable();
			// field muscle_tone type tinyInteger.
			$table->tinyInteger('muscle_tone')->unsigned()->nullable();
			// field breathing type tinyInteger.
			$table->tinyInteger('breathing')->unsigned()->nullable();
			// field jaundice_physiological type checkbox.
			$table->boolean('jaundice_physiological');
			// field jaundice_neonatal_preterm_delivery type checkbox.
			$table->boolean('jaundice_neonatal_preterm_delivery');
			// field jaundice_neonatal_breast_milk type checkbox.
			$table->boolean('jaundice_neonatal_breast_milk');
			// field jaundice_ABO_incompatible type checkbox.
			$table->boolean('jaundice_ABO_incompatible');
			// field jaundice_G_6_PD_deficiency type checkbox.
			$table->boolean('jaundice_G_6_PD_deficiency');
			// field jaundice_unspecified type checkbox.
			$table->boolean('jaundice_unspecified');
			// field other_jaundice type string.
			$table->string('other_jaundice')->nullable();
			// field birth_asphyxia type tinyInteger.
			$table->tinyInteger('birth_asphyxia')->unsigned()->nullable();
			// field care_supervision_healthy type checkbox.
			$table->boolean('care_supervision_healthy');
			// field care_phototherapy type checkbox.
			$table->boolean('care_phototherapy');
			// field care_frenulotomy type checkbox.
			$table->boolean('care_frenulotomy');
			// field care_UVA type checkbox.
			$table->boolean('care_UVA');
			// field care_UVC type checkbox.
			$table->boolean('care_UVC');
			// field care_ET_tube_intubation type checkbox.
			$table->boolean('care_ET_tube_intubation');
			// field other_care type string.
			$table->string('other_care')->nullable();
			// field G type tinyInteger.
			$table->tinyInteger('G')->unsigned()->nullable();
			// field P type tinyInteger.
			$table->tinyInteger('P')->unsigned()->nullable();
			// field GA_weeks type tinyInteger.
			$table->tinyInteger('GA_weeks')->unsigned()->nullable();
			// field GA_days type tinyInteger.
			$table->tinyInteger('GA_days')->unsigned()->nullable();
			// field no_pregnancy_complication type checkbox.
			$table->boolean('no_pregnancy_complication');
			// field pregnancy_complication_PROM type checkbox.
			$table->boolean('pregnancy_complication_PROM');
			// field pregnancy_complication_fail_labour_meds_induce type checkbox.
			$table->boolean('pregnancy_complication_fail_labour_meds_induce');
			// field pregnancy_complication_subserous_myoma type checkbox.
			$table->boolean('pregnancy_complication_subserous_myoma');
			// field pregnancy_complication_gestational_HT type checkbox.
			$table->boolean('pregnancy_complication_gestational_HT');
			// field pregnancy_complication_adenomyosis type checkbox.
			$table->boolean('pregnancy_complication_adenomyosis');
			// field pregnancy_complication_advanced_maternal_age type checkbox.
			$table->boolean('pregnancy_complication_advanced_maternal_age');
			// field pregnancy_complication_alpha_thal_trait type checkbox.
			$table->boolean('pregnancy_complication_alpha_thal_trait');
			// field pregnancy_complication_Hb_E_trait type checkbox.
			$table->boolean('pregnancy_complication_Hb_E_trait');
			// field pregnancy_complication_pre_C_S_labour_pain type checkbox.
			$table->boolean('pregnancy_complication_pre_C_S_labour_pain');
			// field pregnancy_complication_pre_C_S_labour_no_pain type checkbox.
			$table->boolean('pregnancy_complication_pre_C_S_labour_no_pain');
			// field pregnancy_complication_Hx_clear_cell_adeno_CA_ovary type checkbox.
			$table->boolean('pregnancy_complication_Hx_clear_cell_adeno_CA_ovary');
			// field other_pregnancy_complication type string.
			$table->string('other_pregnancy_complication')->nullable();
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
			// field other_first_2nd_stage_labour_complication type string.
			$table->string('other_first_2nd_stage_labour_complication')->nullable();
			// field delivery_mode type tinyInteger.
			$table->tinyInteger('delivery_mode')->unsigned()->nullable();
			// field other_delivery_mode type string.
			$table->string('other_delivery_mode')->nullable();
			// field other_3rd_stage_labour_complication type string.
			$table->string('other_3rd_stage_labour_complication')->nullable();
			// field no_postpartum_complication type checkbox.
			$table->boolean('no_postpartum_complication');
			// field postpartum_complication_endometritis type checkbox.
			$table->boolean('postpartum_complication_endometritis');
			// field postpartum_complication_PPH type checkbox.
			$table->boolean('postpartum_complication_PPH');
			// field other_postpartum_complication type string.
			$table->string('other_postpartum_complication')->nullable();
			// field placenta_weight_grams type smallInteger.
			$table->smallInteger('placenta_weight_grams')->unsigned()->nullable();
			// field specificed_placenta_abnomality type string.
			$table->string('specificed_placenta_abnomality')->nullable();
			// field home_nursing type string.
			$table->string('home_nursing')->nullable();
			// field date_appointment_1 type date.
			$table->date('date_appointment_1')->nullable();
			// field detail_appointment_1 type string.
			$table->string('detail_appointment_1')->nullable();
			// field date_appointment_2 type date.
			$table->date('date_appointment_2')->nullable();
			// field detail_appointment_2 type string.
			$table->string('detail_appointment_2')->nullable();
			// field date_appointment_3 type date.
			$table->date('date_appointment_3')->nullable();
			// field detail_appointment_3 type string.
			$table->string('detail_appointment_3')->nullable();
			// field date_appointment_4 type date.
			$table->date('date_appointment_4')->nullable();
			// field detail_appointment_4 type string.
			$table->string('detail_appointment_4')->nullable();
			// field date_appointment_5 type date.
			$table->date('date_appointment_5')->nullable();
			// field detail_appointment_5 type string.
			$table->string('detail_appointment_5')->nullable();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('obgyn_newborn_notes');
	}
}
