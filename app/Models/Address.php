<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;


class Address extends Model
{
   use Prunable;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'is_primary',
      'is_deliverable',
      'user_id',
      'type',
      'name',
      'phone',
      'landmark',
      'plot_no',
      'company',
      'address_line',
      'address_line_2',
      'city',
      'district',
      'state',
      'postal_code',
      'country',
      'latitude',
      'longitude',
      'addressesable_type',
      'addressesable_id',
   ];
   protected $hidden = [
      'created_at',
      'is_deliverable',
      'updated_at',
   ];
   function user() {
      return $this->belongsToMany(
         \App\Models\User::class,
      );
   }

   public function prunable()
   {
      return static::whereNull('addressesable_id');
   }
}
