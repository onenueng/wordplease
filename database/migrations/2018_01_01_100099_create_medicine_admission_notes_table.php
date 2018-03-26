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

            $table->timestamps();
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
