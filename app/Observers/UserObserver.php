<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;


class UserObserver
{
   /**
    * Handle the User "created" event.
    *
    * @param  \App\Models\User  $user
    * @return void
    */
   public function saving(User $user)
   {
      if (!$user->username) {
         $user->username = $user->phone ?? $user->email;
      }
      if (!$user->name) {
         $user->name = $user->first_name;
         if (!$user->first_name) {
            $user->name = $user->username;
            $user->first_name = $user->username;
         }
      }
      if (!$user->status) {
         $user->status = config('options.default_user_status', 'active');
      }
      if (!$user->uuid) {
         $user->uuid = Str::uuid();
      }
      if (!$user->role_id) {
         $user->role_id = \App\Models\Role::where('code', 'user')->value('id');
         if (!$user->role_id) {
            throw new \App\Exceptions\InvalidSetupException("Invalid setup, data not found for roles", 1);
         }
      }
   }
   /**
    * Handle the User "created" event.
    *
    * @param  \App\Models\User  $user
    * @return void
    */
   public function created(User $user)
   {
      if (!$user->username) {
         $user->username = uniqid();
      }
      $user->save();
   }

   /**
    * Handle the User "updated" event.
    *
    * @param  \App\Models\User  $user
    * @return void
    */
   public function updated(User $user)
   {
      //
   }

   /**
    * Handle the User "deleted" event.
    *
    * @param  \App\Models\User  $user
    * @return void
    */
   public function deleted(User $user)
   {
      //
   }

   /**
    * Handle the User "restored" event.
    *
    * @param  \App\Models\User  $user
    * @return void
    */
   public function restored(User $user)
   {
      //
   }

   /**
    * Handle the User "force deleted" event.
    *
    * @param  \App\Models\User  $user
    * @return void
    */
   public function forceDeleted(User $user)
   {
      //
   }
}
