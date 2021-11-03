<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('categories', function (Blueprint $table) {
         $table->id();
         $table->string('title');
         $table->string('slug');
         $table->unsignedBigInteger('categoryable_id')->nullable();
         $table->string('categoryable_type')->nullable();
         $table->string('group')->default('posts');
         $table->string('caption')->nullable();
         $table->string('thumbnail_url')->nullable();
         $table->string('cover_url')->nullable();
         $table->longText('icon')->nullable()->comment('Can store svg icon file');
         $table->string('theme_color')->default('#000');
         $table->longText('description')->nullable();
         $table->boolean('is_featured')->default(0);
         $table->string('status')->default('draft');
         $table->unsignedBigInteger('category_id')->nullable()->comment('Self nested parent_id like');
         $table->foreign('category_id')->references('id')->on('categories');
         $table->bigInteger('order_index')->default(999);
         $table->foreignId('created_by_user_id')->nullable()->constrained('users');
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
      Schema::dropIfExists('categories');
   }
}
