<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('statuses', function (Blueprint $table) {
         $table->id();
         $table->string('code')->default('draft');
         $table->string('description')->nullable();
         $table->longText('payload')->nullable();
         $table->string('color')->default('#ccc');
         $table->unsignedBigInteger('statusable_id')->nullable();
         $table->string('statusable_type')->nullable();
         $table->unsignedBigInteger('created_by_user_id')->nullable()->comment('Created by user id');
         $table->foreign('created_by_user_id')->references('id')->on('users');
         $table->unsignedBigInteger('updated_by_user_id')->nullable()->comment('updated by user id');
         $table->foreign('updated_by_user_id')->references('id')->on('users');
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
      Schema::dropIfExists('statuses');
   }
}
