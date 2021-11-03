<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttr extends Model
{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name',
      'group',
      'label',
      'type',
      'data_type',
      'data',
      'user_id',
      'order_index',
      'extra',
      'thumbnail',
      'icon',
   ];

}
