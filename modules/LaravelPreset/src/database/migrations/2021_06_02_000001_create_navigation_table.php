<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('navigations', function (Blueprint $table) {
         $table->id();
         $table->string('title');
         $table->string('code');
         $table->longText('left_icon')->nullable();
         $table->longText('right_icon')->nullable();
         $table->string('caption')->nullable();
         $table->string('path')->nullable()->comment('URL Schema like /users/:id');
         $table->string('url')->nullable()->comment('Full url');
         $table->string('group')->default('primary');
         $table->string('tag')->default('admin_only');
         $table->string('css_class')->default('admin_only');
         $table->longText('extra')->nullable()->comment('Store a json data here optional');
         $table->unsignedBigInteger('role_id')->nullable()->comment('Role id');
         $table->foreign('role_id')->references('id')->on('roles');
         $table->unsignedBigInteger('navigation_id')->nullable()->comment('Self nested parent_id like');
         $table->foreign('navigation_id')->references('id')->on('navigations');
         $table->unsignedBigInteger('created_by_user_id')->nullable()->comment('Self nested parent_id like');
         $table->foreign('created_by_user_id')->references('id')->on('users');
         $table->unsignedBigInteger('order_index')->nullable()->comment('Order index');
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
      Schema::dropIfExists('navigations');
   }
}
