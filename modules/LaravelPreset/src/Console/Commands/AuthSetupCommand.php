<?php

namespace Modules\LaravelPreset\Console\Commands;

use Illuminate\Console\Command;

class AuthSetupCommand extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'auth:setup {action?}';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Authenticate setup';

   /**
    * Create a new command instance.
    *
    * @return void
    */
   public function __construct()
   {
      parent::__construct();
   }

   /**
    * Execute the console command.
    *
    * @return int
    */
   public function handle()
   {
      $action = $this->argument('action');
      if ($action == 'init') {
         $this->initAuthSetup();
      }
      return 0;
   }

   function initAuthSetup() {
      try {
         $this->insertRolesAndPermissions();
      } catch (\Throwable $th) {
         //throw $th;
      }
   }
   function insertRolesAndPermissions() {
      try {
         \Artisan::call('migrate');
         \Artisan::call('db:seed', [
            'class' => 'Modules\LaravelPreset\Database\Seeders\DatabaseSeeder'
         ]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
