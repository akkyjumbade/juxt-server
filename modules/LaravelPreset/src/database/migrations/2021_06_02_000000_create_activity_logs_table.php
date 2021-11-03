<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('activity_logs', function (Blueprint $table) {
         $table->id();
         $table->string('action');
         $table->string('intent')->nullable();
         $table->longText('request')->nullable();
         $table->longText('payload')->comment('All data while performed action')->nullable();
         $table->foreignId('performed_by_user_id')->constrained('users');
         $table->longText('session_data')->nullable();
         $table->integer('attempts')->default(0);
         $table->string('flag')->nullable();
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
      Schema::dropIfExists('activity_logs');
   }
}
