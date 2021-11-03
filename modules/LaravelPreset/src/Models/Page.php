<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
   // use HasSlug;

   // public function getSlugOptions() : SlugOptions
   // {
   //    return SlugOptions::create()
   //       ->generateSlugsFrom('title')
   //       ->saveSlugsTo('slug');
   // }
   // protected $table = 'resources';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'title',
      'slug',
      'description',
      'content',
      'theme_color',
      'is_featured',
      'order_index',
   ];
   protected $appends = ['thumbnail'];
   function getThumbnailAttribute() {
      return $this->thumbnail_url;
   }
}
