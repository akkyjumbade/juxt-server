<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('tags', function (Blueprint $table) {
         $table->id();
         $table->string('text')->nullable();
         $table->unsignedBigInteger('taggable_id')->nullable();
         $table->string('taggable_type')->nullable();
         $table->unsignedBigInteger('created_by_user_id')->nullable()->comment('Created by user id');
         $table->foreign('created_by_user_id')->references('id')->on('users');
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
      Schema::dropIfExists('tags');
   }
}
