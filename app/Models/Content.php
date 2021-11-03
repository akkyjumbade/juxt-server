<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
   // protected $table = 'resources';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'title',
      'contentable_id',
      'contentable_type',
      'contentable_type',
      'content_type',
      'is_featured',
      'content',
      'created_by_user_id',
      'order_index',
   ];

}
