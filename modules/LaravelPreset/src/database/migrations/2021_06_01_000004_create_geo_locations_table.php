<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoLocationsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('geo_locations', function (Blueprint $table) {
         $table->id();
         $table->string('title');
         $table->string('description')->nullable();
         $table->string('type')->nullable();
         $table->string('tag')->default('#public');
         $table->string('plot')->nullable();
         $table->string('street_address')->nullable();
         $table->string('landmark')->nullable();
         $table->string('address_line')->nullable();
         $table->string('address_line_2')->nullable();
         $table->string('city')->nullable();
         $table->string('province')->comment('AKA state')->nullable();
         $table->string('district')->nullable();
         $table->string('postal_code')->nullable();
         $table->string('country')->nullable();
         $table->string('google_place_id')->nullable();
         $table->boolean('is_deliverable')->default(false);
         $table->boolean('is_featured')->default(false);
         // mask the field as array
         $table->string('latitude')->nullable();
         $table->string('longitude')->nullable();
         $table->longText('options')->comment('Use api params or any')->nullable();
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
      Schema::dropIfExists('geo_locations');
   }
}
