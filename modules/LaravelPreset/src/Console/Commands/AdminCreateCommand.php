<?php

namespace Modules\LaravelPreset\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class AdminCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

   /**
    * Execute the console command.
    *
    * @return int
    */
   public function handle()
   {
      $username = $this->ask('Username:');
      $phone = $this->ask('Phone:');
      $password = $this->ask('Password:');
      try {
         $user = $this->createAdmin($username, $phone, $password);
         $this->info("Admin user created: {$user->name}");
      } catch (\Throwable $e) {
         $this->error($e->getMessage());
      }
      return 0;
   }

   /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    function createAdmin($username, $email, $password) {
       $ruler = \Validator::make([
          'username' => $username,
          'password' => $password,
          'email' => $email,
       ], [
          'username' => ['required', 'string', 'max:100', 'unique:users'],
          'email' => ['required', 'string', 'max:200', 'unique:users'],
       ]);
       if ($ruler->fails()) {
          throw new \Exception("Please all fields");
       }

       $user = new User();
       $user->username = $username;
       $user->password = bcrypt($password);
       $user->email = $email;
       $user->role_id = Role::where('code', 'admin')->value('id');
       $user->save();
       return $user;
    }

}
