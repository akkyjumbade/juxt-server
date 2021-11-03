<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'var',
      'type',
      'label',
      'data_type',
      'data',
      'input_component',
      'output_component',
      'is_autoload',
   ];
   protected $appends = ['tags'];
   protected $casts = [
      'is_autoload' => 'boolean'
   ];
   function getTagsAttribute($value) {
      if ($value) {
         return $value;
      }
      return 'general';
   }
}
