<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineAdmissionNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_admission_notes', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('notes');

            $table->unsignedTinyInteger('admit_reason')->nullable();
            $table->string('chief_complaint')->nullable();

            $table->unsignedTinyInteger('comorbid_DM')->nullable();
            $table->unsignedTinyInteger('comorbid_DM_type')->nullable();
            $table->boolean('comorbid_DM_DR')->default(false);
            $table->boolean('comorbid_DM_nephropathy')->default(false);
            $table->boolean('comorbid_DM_neuropathy')->default(false);
            $table->boolean('comorbid_DM_diet')->default(false);
            $table->boolean('comorbid_DM_oral_meds')->default(false);
            $table->boolean('comorbid_DM_insulin')->default(false);

            $table->unsignedTinyInteger('comorbid_valvular_heart_disease')->nullable();
            $table->boolean('comorbid_valvular_heart_disease_AS')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_AR')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_MS')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_MR')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_TR')->default(false);
            $table->string('comorbid_valvular_heart_disease_other')->nullable();

            $table->unsignedTinyInteger('comorbid_asthma')->nullable();

            $table->unsignedTinyInteger('comorbid_cirrhosis')->nullable();
            $table->string('comorbid_cirrhosis_child_pugh_score')->nullable();
            $table->boolean('comorbid_cirrhosis_HBV')->default(false);
            $table->boolean('comorbid_cirrhosis_HCV')->default(false);
            $table->boolean('comorbid_cirrhosis_NASH')->default(false);
            $table->boolean('comorbid_cirrhosis_cryptogenic')->default(false);
            $table->string('comorbid_cirrhosis_other')->nullable();

            $table->unsignedTinyInteger('comorbid_HCV')->nullable();

            $table->unsignedTinyInteger('comorbid_lukemia')->nullable();
            $table->unsignedTinyInteger('comorbid_lukemia_specific')->nullable();

            $table->unsignedTinyInteger('comorbid_ICD')->nullable();
            $table->string('comorbid_ICD_other')->nullable();

            $table->unsignedTinyInteger('comorbid_SLE')->nullable();

            $table->unsignedTinyInteger('comorbid_dementia')->nullable();
            $table->boolean('comorbid_dementia_vascular')->default(false);
            $table->boolean('comorbid_dementia_alzheimer')->default(false);
            $table->string('comorbid_dementia_other')->nullable();

            $table->unsignedTinyInteger('comorbid_HT')->nullable();

            $table->unsignedTinyInteger('comorbid_stroke')->nullable();
            $table->unsignedTinyInteger('comorbid_stroke_ischemic')->nullable();
            $table->unsignedTinyInteger('comorbid_stroke_hemorrhagic')->nullable();
            $table->unsignedTinyInteger('comorbid_stroke_iembolic')->nullable();

            $table->unsignedTinyInteger('comorbid_CKD')->nullable();
            $table->unsignedTinyInteger('comorbid_CKD_stage')->nullable();

            $table->unsignedTinyInteger('comorbid_coagulopathy')->nullable();

            $table->unsignedTinyInteger('comorbid_HIV')->nullable();
            $table->boolean('comorbid_HIV_TB')->default(false);
            $table->boolean('comorbid_HIV_PCP')->default(false);
            $table->boolean('comorbid_HIV_candidiasis')->default(false);
            $table->boolean('comorbid_HIV_CMV')->default(false);
            $table->string('comorbid_HIV_other')->nullable();

            $table->unsignedTinyInteger('comorbid_lymphoma')->nullable();
            $table->unsignedTinyInteger('comorbid_lymphoma_specific')->nullable();

            $table->unsignedTinyInteger('comorbid_cancer')->nullable();
            $table->boolean('comorbid_cancer_lung')->default(false);
            $table->boolean('comorbid_cancer_liver')->default(false);
            $table->boolean('comorbid_cancer_colon')->default(false);
            $table->boolean('comorbid_cancer_breast')->default(false);
            $table->boolean('comorbid_cancer_prostate')->default(false);
            $table->boolean('comorbid_cancer_cervix')->default(false);
            $table->boolean('comorbid_cancer_pancreas')->default(false);
            $table->boolean('comorbid_cancer_brain')->default(false);
            $table->string('comorbid_cancer_other')->nullable();

            $table->unsignedTinyInteger('comorbid_other_autoimmune_disease')->nullable();
            $table->boolean('comorbid_other_autoimmune_disease_UCTD')->default(false);
            $table->boolean('comorbid_other_autoimmune_disease_sjrogren_syndrome')->default(false);
            $table->boolean('comorbid_other_autoimmune_disease_MCTD')->default(false);
            $table->boolean('comorbid_other_autoimmune_disease_DMPM')->default(false);
            $table->string('comorbid_other_autoimmune_disease_other')->nullable();

            $table->unsignedTinyInteger('comorbid_psychiatric_illness')->nullable();
            $table->boolean('comorbid_psychiatric_illness_schizophrenia')->default(false);
            $table->boolean('comorbid_psychiatric_illness_major_depression')->default(false);
            $table->boolean('comorbid_psychiatric_illness_bipolar_disorder')->default(false);
            $table->boolean('comorbid_psychiatric_illness_adjustment_disorder')->default(false);
            $table->boolean('comorbid_psychiatric_illness_obcessive_compulsive_disorder')->default(false);
            $table->string('comorbid_psychiatric_illness_other')->nullable();

            $table->unsignedTinyInteger('comorbid_CAD')->nullable();
            $table->unsignedTinyInteger('comorbid_CAD_specific')->nullable();

            $table->unsignedTinyInteger('comorbid_COPD')->nullable();

            $table->unsignedTinyInteger('comorbid_hyperlipidemia')->nullable();
            $table->unsignedTinyInteger('comorbid_hyperlipidemia_specific')->nullable();

            $table->unsignedTinyInteger('comorbid_HBV')->nullable();

            $table->unsignedTinyInteger('comorbid_epilepsy')->nullable();
            $table->unsignedTinyInteger('comorbid_epilepsy_specific')->nullable();

            $table->unsignedTinyInteger('comorbid_pacemaker_implant')->nullable();
            $table->unsignedTinyInteger('comorbid_pacemaker_implant_specific')->nullable();

            $table->unsignedTinyInteger('comorbid_chronic_arthritis')->nullable();
            $table->boolean('comorbid_chronic_arthritis_CPPD')->default(false);
            $table->boolean('comorbid_chronic_arthritis_OA')->default(false);
            $table->boolean('comorbid_chronic_arthritis_rheumatoid')->default(false);
            $table->boolean('comorbid_chronic_arthritis_spondyloarthropathy')->default(false);
            $table->string('comorbid_chronic_arthritis_other')->nullable();

            $table->unsignedTinyInteger('comorbid_TB')->nullable();
            $table->boolean('comorbid_TB_pulmonary')->default(false);
            $table->string('comorbid_TB_other')->nullable();

            $table->text('other_comorbid')->nullable();

            $table->text('history_of_present_illness')->nullable();
            $table->text('history_of_past_illness')->nullable();

            $table->unsignedTinyInteger('pregnancy')->nullable();
            $table->unsignedTinyInteger('gestation_weeks')->nullable();
            $table->string('LMP')->nullable();

            $table->unsignedTinyInteger('alcohol')->nullable();
            $table->string('alcohol_description')->nullable();
            $table->unsignedTinyInteger('cigarette_smoking')->nullable();
            $table->string('smoke_description')->nullable();
            $table->text('personal_social_history')->nullable();

            $table->boolean('NG_tube')->default(false);
            $table->boolean('NG_suction')->default(false);
            $table->boolean('gastrostomy_feeding')->default(false);
            $table->boolean('urinary_cath_care')->default(false);
            $table->boolean('tracheostomy_care')->default(false);
            $table->boolean('hearing_impaiment')->default(false);
            $table->boolean('isolation_room')->default(false);
            $table->string('other_special_requirement')->nullable();

            $table->text('family_history')->nullable();

            $table->text('current_medications')->nullable();

            $table->string('allergy')->nullable();

            $table->text('general_symptoms')->nullable();
            $table->unsignedTinyInteger('review_system_hair_and_skin')->nullable();
            $table->text('review_system_hair_and_skin_description')->nullable();
            $table->unsignedTinyInteger('review_system_head')->nullable();
            $table->text('review_system_head_description')->nullable();
            $table->unsignedTinyInteger('review_system_eye_ENT')->nullable();
            $table->text('review_system_eye_ENT_description')->nullable();
            $table->unsignedTinyInteger('review_system_breast')->nullable();
            $table->text('review_system_breast_description')->nullable();
            $table->unsignedTinyInteger('review_system_CVS')->nullable();
            $table->text('review_system_CVS_description')->nullable();
            $table->unsignedTinyInteger('review_system_RS')->nullable();
            $table->text('review_system_RS_description')->nullable();
            $table->unsignedTinyInteger('review_system_GI')->nullable();
            $table->text('review_system_GI_description')->nullable();
            $table->unsignedTinyInteger('review_system_GU')->nullable();
            $table->text('review_system_GU_description')->nullable();
            $table->unsignedTinyInteger('review_system_musculoskeletal')->nullable();
            $table->text('review_system_musculoskeletal_description')->nullable();
            $table->unsignedTinyInteger('review_system_nervous_system')->nullable();
            $table->text('review_system_nervous_system_description')->nullable();
            $table->unsignedTinyInteger('review_system_psychological_symptoms')->nullable();
            $table->text('review_system_psychological_symptoms_description')->nullable();

            $table->decimal('temperature_celsius', 3, 1)->nullable();
            $table->unsignedTinyInteger('pulse_rate_per_min')->nullable();
            $table->unsignedTinyInteger('respiratory_rate_per_min')->nullable();
            $table->string('BP', 7)->nullable();
            $table->boolean('estimated_height')->default(0);
            $table->decimal('height_cm', 4, 1)->nullable();
            $table->boolean('estimated_weight')->default(0);
            $table->decimal('weight_kg', 4, 1)->nullable();
            $table->unsignedTinyInteger('SpO2')->nullable();
            $table->unsignedTinyInteger('breathing')->nullable();
            $table->decimal('O2_rate', 3, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_admission_notes');
    }
}
