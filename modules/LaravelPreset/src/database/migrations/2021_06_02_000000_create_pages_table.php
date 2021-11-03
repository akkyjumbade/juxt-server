<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('pages', function (Blueprint $table) {
         $table->id();
         $table->string('title');
         $table->string('slug');
         $table->string('cname');
         $table->string('locale')->default(config('app.locale'));
         $table->string('layout')->default('app');
         $table->longText('meta')->nullable();
         $table->unsignedBigInteger('pageable_id')->nullable();
         $table->string('pageable_type')->nullable();
         $table->string('type')->default('page');
         $table->string('subtype')->default('post');
         $table->boolean('is_featured')->default(0);
         $table->boolean('is_indexable')->default(false);
         $table->string('theme_color')->nullable();
         $table->text('description')->nullable();
         $table->longText('head_tag')->nullable();
         $table->longText('content')->nullable();
         $table->longText('footer_tag')->nullable();
         $table->longText('page_scripts')->nullable();
         $table->bigInteger('order_index')->default(999);
         $table->unsignedBigInteger('created_by_user_id')->nullable()->comment('Created by user id');
         $table->foreign('created_by_user_id')->references('id')->on('users');
         $table->unsignedBigInteger('updated_by_user_id')->nullable();
         $table->foreign('updated_by_user_id')->references('id')->on('users');
         $table->unsignedBigInteger('author_user_id')->nullable();
         $table->foreign('author_user_id')->references('id')->on('users');
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
      Schema::dropIfExists('pages');
   }
}
