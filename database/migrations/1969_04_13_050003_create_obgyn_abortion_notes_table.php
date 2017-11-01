<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObgynAbortionNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('obgyn_abortion_notes', function (Blueprint $table) {
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
			// field date_abortion type date.
			$table->date('date_abortion')->nullable();
			// field abortion_diagnosis_hydatidiform_mole type checkbox.
			$table->boolean('abortion_diagnosis_hydatidiform_mole');
			// field abortion_diagnosis_blighted_ovum type checkbox.
			$table->boolean('abortion_diagnosis_blighted_ovum');
			// field abortion_diagnosis_missed_abortion type checkbox.
			$table->boolean('abortion_diagnosis_missed_abortion');
			// field abortion_diagnosis_dead_fetus_in_utero type checkbox.
			$table->boolean('abortion_diagnosis_dead_fetus_in_utero');
			// field other_abortion_diagnosis type string.
			$table->string('other_abortion_diagnosis')->nullable();
			// field abortion type tinyInteger.
			$table->tinyInteger('abortion')->unsigned()->nullable();
			// field abortion_stage type tinyInteger.
			$table->tinyInteger('abortion_stage')->unsigned()->nullable();
			// field other_abortion_stage type string.
			$table->string('other_abortion_stage')->nullable();
			// field abortion_outcome type tinyInteger.
			$table->tinyInteger('abortion_outcome')->unsigned()->nullable();
			// field gender type tinyInteger.
			$table->tinyInteger('gender')->unsigned()->nullable();
			// field fetus_weight_grams type smallInteger.
			$table->smallInteger('fetus_weight_grams')->unsigned()->nullable();
			// field fetus_EBL_ml type smallInteger.
			$table->smallInteger('fetus_EBL_ml')->unsigned()->nullable();
			// field placenta_weight_grams type smallInteger.
			$table->smallInteger('placenta_weight_grams')->unsigned()->nullable();
			// field placenta_abnormality type string.
			$table->string('placenta_abnormality')->nullable();
			// field quantity_tea_spoon type tinyInteger.
			$table->tinyInteger('quantity_tea_spoon')->unsigned()->nullable();
			// field quantity_table_spoon type tinyInteger.
			$table->tinyInteger('quantity_table_spoon')->unsigned()->nullable();
			// field product_weight_grams type smallInteger.
			$table->smallInteger('product_weight_grams')->unsigned()->nullable();
			// field conception_EBL_ml type smallInteger.
			$table->smallInteger('conception_EBL_ml')->unsigned()->nullable();
			// field rx_genitourinary_instillation type checkbox.
			$table->boolean('rx_genitourinary_instillation');
			// field rx_oxcytocin_infusion type checkbox.
			$table->boolean('rx_oxcytocin_infusion');
			// field rx_dilatation_curettage type checkbox.
			$table->boolean('rx_dilatation_curettage');
			// field rx_evaculation_curettage type checkbox.
			$table->boolean('rx_evaculation_curettage');
			// field rx_aspiration_suction_curettage type checkbox.
			$table->boolean('rx_aspiration_suction_curettage');
			// field rx_hysterotomy type checkbox.
			$table->boolean('rx_hysterotomy');
			// field other_treatment type string.
			$table->string('other_treatment')->nullable();
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
		Schema::drop('obgyn_abortion_notes');
	}
}
