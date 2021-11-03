<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name')->nullable();
            $table->string('type')->comment('Type')->nullable();
            $table->string('blood_group')->comment('Blood group type')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('hospital_name')->nullable();
            // address details
            $table->string('address_line')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_mobile')->nullable();
            $table->text('message')->nullable();
            $table->string('unit')->nullable();
            $table->string('unit_qty')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedBigInteger('posted_by_user_id')->nullable();
            $table->foreign('posted_by_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('post_requirements');
    }
}
