<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('options', function (Blueprint $table) {
         $table->id();
         $table->string('var');
         $table->string('type')->default('option');
         $table->string('label');
         $table->string('caption')->nullable();
         $table->string('data_type')->default('text');
         $table->string('input_component')->default('TextInput');
         $table->string('output_component')->default('View');
         $table->longText('data')->nullable();
         $table->longText('default_value')->nullable();
         $table->longText('tags')->nullable();
         $table->string('scope')->default('system');
         $table->boolean('is_autoload')->default(false);
         $table->unsignedBigInteger('option_id')->nullable()->comment('Self nested parent_id like');
         $table->foreign('option_id')->references('id')->on('options');
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
      Schema::dropIfExists('options');
   }
}
