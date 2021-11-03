<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
   // use \Admin\Traits\HasCustomAttrs;
   // protected $table = 'resources';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'title',
      'code',
      'type',
      'subtype',
      'thumbnail_url',
      'theme_color',
      'description',
      'content',
      'content_type',
      'status',
      'caption',
      'cover_url',
      'icon',
      'is_featured',
      'tags',
      'keywords',
      'resource_id',
      'order_index',
      'created_by_user_id',
      'published_at',
      // 'published_at',
   ];
   protected $appends = ['thumbnail'];
   function scopeType($builder, $value) {
      $builder->where('type', 'LIKE', $value);
   }
   function scopeSorted($builder) {
      $builder->orderBy('order_index');
   }
   function scopeActive($builder) {
      $builder->where('status', 'LIKE', 'active');
   }
   protected static function booted()
   {
      static::created(function ($resource) {
         if (request()->user()) {
            $resource->created_by_user_id = request()->user()->id;
         }
         if ($resource->status == 'active') {
            $resource->published_at = now();
         }
         if (!$resource->code) {
            $resource->code = time();
         }
         $resource->save();

      });
   }
   function attrs() {
      return $this->hasMany(
         \App\Models\CustomAttr::class,
         'resource_id'
      )->where('resource_name', 'resource');
   }
   function getCustomAttrsAttribute() {
      $attrs = $this->attrs()->where('resource_id', $this->id)->pluck('data', 'name');
      return $attrs;
   }
   function addAttribute(array $payload) {
      $this->attrs()->updateOrCreate([
         'name' => $payload['name'],
      ], array_merge($payload, [
         'resource_name' => 'resource',
      ]));
   }
   function getThumbnailAttribute() {
      return url($this->thumbnail_url);
   }
}
