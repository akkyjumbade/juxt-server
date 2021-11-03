<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRequirementInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_requirement_interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_requirement_id')->nullable();
            $table->foreign('post_requirement_id')->references('id')->on('post_requirements');
            $table->unsignedBigInteger('interested_user_id')->nullable();
            $table->foreign('interested_user_id')->references('id')->on('users');
            $table->string('status', )->default('pending');
            $table->timestampTz('accepted_at')->nullable();
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
        Schema::dropIfExists('post_requirement_interests');
    }
}
