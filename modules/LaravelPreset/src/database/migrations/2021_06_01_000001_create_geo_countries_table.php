<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoCountriesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('geo_countries', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('title')->nullable();
         $table->string('native_name')->nullable();
         $table->string('numeric_code')->nullable();
         $table->string('phone_code')->nullable();
         $table->string('capital')->nullable();
         $table->string('continent')->nullable();
         $table->string('region')->nullable();
         $table->string('subregion')->nullable();
         $table->string('iso3', 3)->nullable();
         $table->string('iso2', 3)->nullable();
         $table->string('domain_extension')->nullable();
         $table->string('currency')->nullable();
         $table->string('currency_symbol')->nullable();
         $table->string('flag_emoji')->nullable()->comment('Emoji icon');
         $table->string('flag_emojiU')->nullable()->comment('Emoji unicode');
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
      Schema::dropIfExists('geo_countries');
   }
}
