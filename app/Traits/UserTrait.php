<?php
namespace App\Traits;

use App\Models\User;

trait UserTrait {
   function respondWithToken($user, $params = [], $refreshToken = false) {
      $user = auth('jwt')->user();
      $token = null;
      if ($refreshToken) {
         $token = auth('jwt')->refresh();
      }

      if($user) {
         $user->update([
            'last_login_at' => now()
         ]);
      }
      return response()->success(array_merge([
         'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('jwt')->factory()->getTTL() * 60
         ],
         'user' => $user,
      ], $params));
   }

   function sendUserInfo($params = []) {
      try {
         $user = auth('jwt')->user();
         $token = auth('jwt')->refresh();
         $user->load('address');
         $customAttrs = $user->custom_attrs;
         $user = array_merge($user->toArray(), [
            'attrs' => $customAttrs
         ]);
         return response()->success(array_merge([
            'data' => [
               'token' => $token,
               'token_type' => 'bearer',
               'expires_in' => auth('jwt')->factory()->getTTL() * 60,
               'user' => $user,
            ],
            //'user' => $user,
         ], $params));
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }
}
