<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('permissions', function (Blueprint $table) {
         $table->id();
         $table->string('title');
         $table->string('code');
         $table->string('resource');
         $table->string('description');
         $table->unsignedBigInteger('permissionable_id')->nullable();
         $table->string('permissionable_type')->nullable();
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
      Schema::dropIfExists('permissions');
   }
}
