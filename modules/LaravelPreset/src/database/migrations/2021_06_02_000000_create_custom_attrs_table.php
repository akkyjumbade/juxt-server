<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomAttrsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('custom_attrs', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('label');
         $table->string('group')->default('attr');
         $table->string('type')->default('text');
         $table->string('data_type')->default('string');
         $table->string('thumbnail')->nullable();
         $table->string('icon')->nullable();
         $table->longText('data')->nullable();
         $table->bigInteger('order_index')->nullable();
         $table->longText('extra')->nullable();
         $table->boolean('is_autoload')->default(false);
         $table->unsignedBigInteger('custom_attr_id')->nullable();
         $table->foreign('custom_attr_id')->references('id')->on('custom_attrs');
         $table->unsignedBigInteger('custom_attrsable_id')->nullable();
         $table->string('custom_attrsable_type')->nullable();
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
      Schema::dropIfExists('custom_attrs');
   }
}
