<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('contents', function (Blueprint $table) {
         $table->id();
         $table->string('title')->nullable();
         $table->string('content_type')->default('image');
         $table->boolean('is_featured')->default(0);
         $table->longText('content')->nullable()->comment('Store a blocks of json or html content.');
         $table->bigInteger('order_index')->default(999);
         /* Content can be used by any model by contentable trait */
         $table->unsignedBigInteger('contentable_id')->nullable();
         $table->string('contentable_type')->nullable();
         /* Content can be used by any model by contentable trait */
         $table->unsignedBigInteger('created_by_user_id')->nullable()->comment('Created by user id');
         $table->foreign('created_by_user_id')->references('id')->on('users');
         $table->timestampTz('published_at')->nullable();
         $table->softDeletes();
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
      Schema::dropIfExists('contents');
   }
}
