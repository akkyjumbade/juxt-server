<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
   use HasSlug;
   /**
     * Get the options for generating the slug.
     */
   public function getSlugOptions() : SlugOptions
   {
      return SlugOptions::create()
         ->generateSlugsFrom('title')
         ->saveSlugsTo('slug');
   }
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
      'group',
      'caption',
      'thumbnail_url',
      'cover_url',
      'icon',
      'theme_color',
      'is_featured',
      'status',
      'category_id',
      'order_index',
   ];
   protected $appends = ['thumbnail', 'label', 'value'];
   public $refFields = ['label', 'value'];

   public $searchableFields = [
      'title', 'description',
   ];

   function getLabelAttribute() {
      return $this->title;
   }
   function getValueAttribute() {
      return $this->id;
   }
   function getThumbnailAttribute() {
      return $this->thumbnail_url;
   }

   function children() {
      return $this->hasMany(self::class, 'category_id');
   }
}
