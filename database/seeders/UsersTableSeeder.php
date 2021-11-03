<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $adminUser = [
          'email' => 'admin',
          'username' => 'admin',
          'phone' => '1234567890',
          'password' => bcrypt('secret'),
          'role_id' => Role::where('code', 'admin')->value('id'),
       ];
       try {
          User::updateOrCreate([
             'email' => 'admin',
          ], $adminUser);
       }catch (\Throwable $th) {
          throw $th;
       }
    }
}
