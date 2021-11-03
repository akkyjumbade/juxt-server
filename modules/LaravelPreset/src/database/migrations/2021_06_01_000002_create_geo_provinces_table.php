<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoProvincesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('geo_provinces', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('native_name')->nullable();
         $table->string('capital')->nullable();
         $table->string('type')->nullable();
         $table->string('state_code')->nullable();
         $table->string('latitude')->nullable();
         $table->string('longitude')->nullable();
         /* Map */
         $table->unsignedBigInteger('country_id')->nullable();
         $table->foreign('country_id')->references('id')->on('geo_countries')->onDelete('cascade');
         $table->longText('options')->comment('Use api params or any')->nullable();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('geo_provinces');
   }
}
