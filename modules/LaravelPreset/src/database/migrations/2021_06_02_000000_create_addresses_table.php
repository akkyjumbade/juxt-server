<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
   public $tableName = 'addresses';
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create($this->tableName, function (Blueprint $table) {
         $table->id();
         $table->boolean('is_primary')->default(false);
         $table->boolean('is_deliverable')->default(false);
         $table->string('type')->default('other');
         $table->string('name');
         $table->string('phone', 15)->nullable();
         $table->string('landmark')->nullable();
         $table->string('plot_no')->nullable();
         $table->string('company')->nullable();
         $table->text('address_line')->nullable();
         $table->text('address_line_2')->nullable();
         $table->string('city')->nullable();
         $table->string('district')->nullable();
         $table->string('state')->nullable();
         $table->string('postal_code')->nullable();
         $table->string('country')->default(config('admin.country', 'IN'));
         $table->string('latitude')->nullable();
         $table->string('longitude')->nullable();
         $table->unsignedBigInteger('addressesable_id')->nullable();
         $table->string('addressesable_type')->nullable();
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
      Schema::dropIfExists('addresses');
   }
}
