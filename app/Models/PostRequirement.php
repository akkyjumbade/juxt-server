<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRequirement extends Model
{
    use HasFactory;
    protected $fillable = [
       'patient_name',
       'type',
       'age',
       'gender',
       'hospital_name',
       'address_line',
       'address_line_2',
       'city',
       'postal_code',
       'state',
       'country',
       'contact_person_name',
       'contact_person_mobile',
       'message',
       'unit',
       'unit_qty',
       'status',
       'posted_by_user_id',
       'blood_group',
       'latitude',
       'longitude'


    ];

   function requests() {
      return $this->hasMany(PostRequirementInterest::class);
   }

   function creator() {
      return $this->belongsTo(User::class, 'posted_by_user_id');
   }
}
