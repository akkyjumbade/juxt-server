<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Navigation extends Model
{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'title',
      'code',
      'caption',
      'path',
      'url',
      'group',
      'tag',
      'navigation_id',
      'created_by_user_id',
   ];
   protected $casts = [
      'extra' => 'array',
   ];

   protected static function booted()
   {
      static::created(function ($model) {
         if (request()->user()) {
            $model->created_by_user_id = request()->user()->id;
         }
         if (!$model->code) {
            $model->code = Str::slug(strtolower($model->title));
         }
         $model->save();

      });
   }
   public $timestamps = false;
   function children() {
      return $this->hasMany(self::class);
   }
}
