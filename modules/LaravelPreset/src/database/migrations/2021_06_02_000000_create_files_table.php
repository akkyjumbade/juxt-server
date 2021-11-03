<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('files', function (Blueprint $table) {
         $table->id();
         $table->string('title')->nullable();
         $table->string('cite')->nullable();
         /* Files can be used by model by FilesTrait */
         $table->unsignedBigInteger('fileable_id')->nullable();
         $table->string('fileable_type')->nullable();
         /* Files can be used by model by FilesTrait */
         $table->string('mime_type')->default('image');
         $table->string('group')->default('image');
         $table->string('drive')->default('local');
         $table->string('path')->nullable();
         $table->string('ldpi_url')->nullable();
         $table->string('mdpi_url')->nullable();
         $table->string('hdpi_url')->nullable();
         $table->string('xhdpi_url')->nullable();
         $table->string('xxhdpi_url')->nullable();
         $table->string('xxxhdpi_url')->nullable();
         $table->string('original_url')->nullable();
         $table->string('color')->default('#000');
         $table->boolean('is_featured')->default(0);
         $table->bigInteger('order_index')->default(999);
         $table->longText('meta')->nullable();
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
      Schema::dropIfExists('files');
   }
}
