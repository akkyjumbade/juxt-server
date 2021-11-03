<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'action',
      'intent',
      'request',
      'payload',
      'performed_by_user_id',
      'session_data',
      'attempts',
      'flag',
   ];

   protected $casts = [
      'payload' => 'array',
      'request' => 'array',
      'session_data' => 'array',
   ];

}
