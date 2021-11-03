<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomAttr extends Model
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
      'resource_id',
      'resource_name',
      'order_index',
      'extra',
      'thumbnail',
      'icon',
   ];

}
