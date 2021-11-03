<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
   public $tableName = 'teams';
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      if (!Schema::hasTable($this->tableName)) {
         return false;
      }
      Schema::table($this->tableName, function (Blueprint $table) {
         if (!Schema::hasColumn($this->tableName, 'display_name')) {
            $table->string('display_name')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'description')) {
            $table->string('description')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'thumbnail')) {
            $table->string('thumbnail')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'logo')) {
            $table->string('logo')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'phone')) {
            $table->string('phone')->nullable();
            $table->timestampTz('phone_verified_at')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'email')) {
            $table->string('email')->nullable();
            $table->timestampTz('email_verified_at')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'website')) {
            $table->string('website')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'status')) {
            $table->string('status')->default('pending');
         }
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::dropIfExists('teams');
   }
}
