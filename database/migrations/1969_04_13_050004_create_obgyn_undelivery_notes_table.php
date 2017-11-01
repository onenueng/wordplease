<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObgynUndeliveryNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('obgyn_undelivery_notes', function (Blueprint $table) {
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
			// field obstetrics_complication_hyperemesis_gravidarum type checkbox.
			$table->boolean('obstetrics_complication_hyperemesis_gravidarum');
			// field obstetrics_complication_false_labour_before_37_wks type checkbox.
			$table->boolean('obstetrics_complication_false_labour_before_37_wks');
			// field obstetrics_complication_false_labour_after_37_wks type checkbox.
			$table->boolean('obstetrics_complication_false_labour_after_37_wks');
			// field obstetrics_complication_treatened_preterm_labour type checkbox.
			$table->boolean('obstetrics_complication_treatened_preterm_labour');
			// field obstetrics_complication_preterm_labour_without_delivery type checkbox.
			$table->boolean('obstetrics_complication_preterm_labour_without_delivery');
			// field other_obstetrics_complication type string.
			$table->string('other_obstetrics_complication')->nullable();
			// field medical_complication_thalassemia type tinyInteger.
			$table->tinyInteger('medical_complication_thalassemia')->unsigned()->nullable();
			// field medical_complication_DM type checkbox.
			$table->boolean('medical_complication_DM');
			// field medical_complication_DM_type type tinyInteger.
			$table->tinyInteger('medical_complication_DM_type')->unsigned()->nullable();
			// field medical_complication_DM_DR type checkbox.
			$table->boolean('medical_complication_DM_DR');
			// field medical_complication_DM_nephropathy type checkbox.
			$table->boolean('medical_complication_DM_nephropathy');
			// field medical_complication_DM_neuropathy type checkbox.
			$table->boolean('medical_complication_DM_neuropathy');
			// field medical_complication_DM_on_diet type checkbox.
			$table->boolean('medical_complication_DM_on_diet');
			// field medical_complication_DM_on_oral_meds type checkbox.
			$table->boolean('medical_complication_DM_on_oral_meds');
			// field medical_complication_DM_on_insulin type checkbox.
			$table->boolean('medical_complication_DM_on_insulin');
			// field specificed_medical_complication_DM type string.
			$table->string('specificed_medical_complication_DM')->nullable();
			// field medical_complication_HT type checkbox.
			$table->boolean('medical_complication_HT');
			// field specificed_medical_complication_HT type string.
			$table->string('specificed_medical_complication_HT')->nullable();
			// field other_medical_complication type string.
			$table->string('other_medical_complication')->nullable();
			// field other_complication type string.
			$table->string('other_complication')->nullable();
			// field RX_medication_inhibit_labour type tinyInteger.
			$table->tinyInteger('RX_medication_inhibit_labour')->unsigned()->nullable();
			// field RX_medication_inhibit_labour_bricanyl type checkbox.
			$table->boolean('RX_medication_inhibit_labour_bricanyl');
			// field RX_medication_inhibit_labour_MgSO4 type checkbox.
			$table->boolean('RX_medication_inhibit_labour_MgSO4');
			// field RX_medication_inhibit_labour_other type string.
			$table->string('RX_medication_inhibit_labour_other')->nullable();
			// field RX_blood_transfusions type tinyInteger.
			$table->tinyInteger('RX_blood_transfusions')->unsigned()->nullable();
			// field PCR type tinyInteger.
			$table->tinyInteger('PCR')->unsigned()->nullable();
			// field RX_other_blood_transfusions type string.
			$table->string('RX_other_blood_transfusions')->nullable();
			// field RX_control_BP type tinyInteger.
			$table->tinyInteger('RX_control_BP')->unsigned()->nullable();
			// field RX_specificed_control_BP type string.
			$table->string('RX_specificed_control_BP')->nullable();
			// field RX_control_blood_sugar type tinyInteger.
			$table->tinyInteger('RX_control_blood_sugar')->unsigned()->nullable();
			// field RX_control_blood_sugar_diet type checkbox.
			$table->boolean('RX_control_blood_sugar_diet');
			// field RX_control_blood_sugar_insulin type checkbox.
			$table->boolean('RX_control_blood_sugar_insulin');
			// field RX_other_control_blood_sugar type string.
			$table->string('RX_other_control_blood_sugar')->nullable();
			// field RX_antibiotics type tinyInteger.
			$table->tinyInteger('RX_antibiotics')->unsigned()->nullable();
			// field RX_specificed_antibiotics type string.
			$table->string('RX_specificed_antibiotics')->nullable();
			// field RX_electolytes type tinyInteger.
			$table->tinyInteger('RX_electolytes')->unsigned()->nullable();
			// field RX_specificed_electolytes type string.
			$table->string('RX_specificed_electolytes')->nullable();
			// field RX_steriod type tinyInteger.
			$table->tinyInteger('RX_steriod')->unsigned()->nullable();
			// field RX_specificed_steriod type string.
			$table->string('RX_specificed_steriod')->nullable();
			// field other_treatments type string.
			$table->string('other_treatments')->nullable();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('obgyn_undelivery_notes');
	}
}
