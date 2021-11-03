<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $roles = config('options.permissions');
      foreach ($roles as $key => $role) {
         try {
            $roleScopes = @$role['scopes'];
            if ($roleScopes) {
               foreach ($roleScopes as $scope) {
                  \App\Models\Permission::updateOrCreate([
                     'code' => $role['value'],
                  ], [
                     'title' => $role['label'],
                     'description' => $role['label'],
                     'code' => $role['value'] . ':'.$scope,
                     'resource' => $role['value'],
                  ]);
               }
            } else {
               \App\Models\Permission::updateOrCreate([
                  'code' => $role['value'],
               ], [
                  'title' => $role['label'],
                  'description' => $role['label'],
                  'code' => $role['value'],
                  'resource' => $role['value'],
               ]);
            }



         } catch (\Throwable $th) {
            throw $th;
         }
      }
   }
}
