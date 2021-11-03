<?php

namespace App\Traits;

use App\Models\Address;
use App\Models\User;
use App\Models\UserAttr;

trait DeleteUserTrait
{
   function remove(int $userID) {

      try {
         return \DB::transaction(function () use ($userID) {
            Address::where('addressesable_id', $userID)->delete();
            UserAttr::where('user_attrsable_id', $userID)->delete();
            /* And finally remove the user itself */
            User::where('id', $userID)->delete();
         });
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
