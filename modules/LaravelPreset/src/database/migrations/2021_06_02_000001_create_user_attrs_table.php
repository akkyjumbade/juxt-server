<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAttrsTable extends Migration
{
   public $tableName = 'user_attrs';
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create($this->tableName, function (Blueprint $table) {
         $table->id();
         // $table->foreignId('user_id')->constrained('users');
         $table->unsignedBigInteger('user_attrsable_id')->nullable();
         $table->string('user_attrsable_type')->nullable();
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
