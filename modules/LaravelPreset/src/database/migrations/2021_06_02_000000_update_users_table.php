<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
   public $tableName = 'users';
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table($this->tableName, function (Blueprint $table) {
         if (!Schema::hasColumn('users', 'first_name')) {
            $table->string('first_name')->nullable();
         }
         if (!Schema::hasColumn('users', 'middle_name')) {
            $table->string('middle_name')->nullable();
         }
         if (!Schema::hasColumn('users', 'last_name')) {
            $table->string('last_name')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'uuid')) {
            $table->string('uuid')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'bio')) {
            $table->string('bio')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'phone')) {
            $table->string('phone')->nullable();
            $table->timestampTz('phone_verified_at')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'birth_date')) {
            $table->date('birth_date')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'gender')) {
            $table->string('gender')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'avatar')) {
            $table->string('avatar')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'website')) {
            $table->string('website')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'country')) {
            $table->string('country')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'region')) {
            $table->string('region')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'locale')) {
            $table->string('locale')->default('en');
         }
         if (!Schema::hasColumn($this->tableName, 'timezone')) {
            $table->string('timezone')->default('en');
         }
         if (!Schema::hasColumn($this->tableName, 'status')) {
            $table->string('status')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'username')) {
            $table->string('username')->unique();
         }
         if (!Schema::hasColumn($this->tableName, 'last_login_at')) {
            $table->timestampTz('last_login_at')->nullable();
         }
         if (!Schema::hasColumn($this->tableName, 'role_id')) {
            $table->foreignId('role_id')->constrained('roles');
         }
         if (!Schema::hasColumn($this->tableName, 'refferal_code')) {
            $table->string('refferal_code')->nullable();
            $table->foreignId('reffered_user_id')->nullable()->constrained($this->tableName);
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
      // Schema::dropColumn([

      // ]);
   }
}
