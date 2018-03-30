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

            $table->tinyInteger('admit_reason')->unsigned()->nullable();
            $table->string('chief_complaint', 50)->nullable();

            $table->tinyInteger('comorbid_DM')->unsigned()->nullable();
            $table->tinyInteger('comorbid_DM_type')->unsigned()->nullable();
            $table->boolean('comorbid_DM_DR')->default(false);
            $table->boolean('comorbid_DM_nephropathy')->default(false);
            $table->boolean('comorbid_DM_neuropathy')->default(false);
            $table->boolean('comorbid_DM_diet')->default(false);
            $table->boolean('comorbid_DM_oral_meds')->default(false);
            $table->boolean('comorbid_DM_insulin')->default(false);

            $table->tinyInteger('comorbid_valvular_heart_disease')->unsigned()->nullable();
            $table->boolean('comorbid_valvular_heart_disease_AS')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_AR')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_MS')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_MR')->default(false);
            $table->boolean('comorbid_valvular_heart_disease_TR')->default(false);
            $table->string('comorbid_valvular_heart_disease_other')->nullable();

            $table->tinyInteger('comorbid_asthma')->unsigned()->nullable();

            $table->tinyInteger('comorbid_cirrhosis')->unsigned()->nullable();
            $table->string('comorbid_cirrhosis_child_pugh_score')->nullable();
            $table->boolean('comorbid_cirrhosis_HBV')->default(false);
            $table->boolean('comorbid_cirrhosis_HCV')->default(false);
            $table->boolean('comorbid_cirrhosis_NASH')->default(false);
            $table->boolean('comorbid_cirrhosis_cryptogenic')->default(false);
            $table->string('comorbid_cirrhosis_other')->nullable();

            $table->tinyInteger('comorbid_HCV')->unsigned()->nullable();

            $table->tinyInteger('comorbid_lukemia')->unsigned()->nullable();
            $table->tinyInteger('comorbid_lukemia_specific')->unsigned()->nullable();

            $table->tinyInteger('comorbid_ICD')->unsigned()->nullable();
            $table->string('comorbid_ICD_other')->nullable();

            $table->tinyInteger('comorbid_SLE')->unsigned()->nullable();

            $table->tinyInteger('comorbid_dementia')->unsigned()->nullable();
            $table->boolean('comorbid_dementia_vascular')->default(false);
            $table->boolean('comorbid_dementia_alzheimer')->default(false);
            $table->string('comorbid_dementia_other')->nullable();

            $table->tinyInteger('comorbid_HT')->unsigned()->nullable();

            $table->tinyInteger('comorbid_stroke')->unsigned()->nullable();
            $table->tinyInteger('comorbid_stroke_ischemic')->unsigned()->nullable();
            $table->tinyInteger('comorbid_stroke_hemorrhagic')->unsigned()->nullable();
            $table->tinyInteger('comorbid_stroke_iembolic')->unsigned()->nullable();

            $table->tinyInteger('comorbid_CKD')->unsigned()->nullable();
            $table->tinyInteger('comorbid_CKD_stage')->unsigned()->nullable();

            $table->tinyInteger('comorbid_coagulopathy')->unsigned()->nullable();

            $table->tinyInteger('comorbid_HIV')->unsigned()->nullable();
            $table->boolean('comorbid_HIV_TB')->default(false);
            $table->boolean('comorbid_HIV_PCP')->default(false);
            $table->boolean('comorbid_HIV_candidiasis')->default(false);
            $table->boolean('comorbid_HIV_CMV')->default(false);
            $table->string('comorbid_HIV_other')->nullable();

            $table->tinyInteger('comorbid_lymphoma')->unsigned()->nullable();
            $table->tinyInteger('comorbid_lymphoma_specific')->unsigned()->nullable();

            $table->tinyInteger('comorbid_cancer')->unsigned()->nullable();
            $table->boolean('comorbid_cancer_lung')->default(false);
            $table->boolean('comorbid_cancer_liver')->default(false);
            $table->boolean('comorbid_cancer_colon')->default(false);
            $table->boolean('comorbid_cancer_breast')->default(false);
            $table->boolean('comorbid_cancer_prostate')->default(false);
            $table->boolean('comorbid_cancer_cervix')->default(false);
            $table->boolean('comorbid_cancer_pancreas')->default(false);
            $table->boolean('comorbid_cancer_brain')->default(false);
            $table->string('comorbid_cancer_other')->nullable();

            $table->tinyInteger('comorbid_other_autoimmune_disease')->unsigned()->nullable();
            $table->boolean('comorbid_other_autoimmune_disease_UCTD')->default(false);
            $table->boolean('comorbid_other_autoimmune_disease_sjrogren_syndrome')->default(false);
            $table->boolean('comorbid_other_autoimmune_disease_MCTD')->default(false);
            $table->boolean('comorbid_other_autoimmune_disease_DMPM')->default(false);
            $table->string('comorbid_other_autoimmune_disease_other')->nullable();
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
