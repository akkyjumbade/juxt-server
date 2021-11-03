<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
   public $tableName = 'subscribers';
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create($this->tableName, function (Blueprint $table) {
         $table->id();
         $table->string('name')->nullable();
         // channel specific fields
         $table->string('email')->nullable();
         // $table->timestampTz('email_verified_at')->nullable();
         // channel specific fields
         $table->string('push_notification_token')->nullable();
         $table->string('channel')->default('email')->nullable();
         $table->string('topic')->nullable();
         $table->string('list')->default('newsletter')->nullable();
         $table->foreignId('user_id')->nullable();
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
      Schema::dropIfExists($this->tableName);
   }
}
