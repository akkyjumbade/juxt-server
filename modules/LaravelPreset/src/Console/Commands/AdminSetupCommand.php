<?php

namespace Modules\LaravelPreset\Console\Commands;

use Illuminate\Console\Command;

class AdminSetupCommand extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'admin {action?} {--mode=}';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Admin control actions';

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
      // if
      // if (!$this->confirm('Did you commit your changes before setup? If not please do git commit.')) {
      //    return 0;
      // }
      $this->info('Creating admin setup...');

      $stages = [
         fn() => $this->migrateAdminSetup(),
         fn() => $this->exportAdminAssets(),
      ];
      $stagesCount = count($stages);
      $progressBar = $this->output->createProgressBar($stagesCount);
      $progressBar->start();
      foreach ($stages as $key => $stage) {
         try {
            $stage && $stage();
            // $this->warn(PHP_EOL. $th->getMessage());
         } catch (\Throwable $th) {
            // throw $th;
            $this->warn(PHP_EOL. '[WARNING]: ' . $th->getMessage());
         } finally {
            $progressBar->advance();
         }
      }
      \Artisan::call('migrate:status');

      $progressBar->finish();


      $this->info(PHP_EOL . 'Setup created');
      return 0;
   }


   function migrateAdminSetup() {
      try {

      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function exportAdminAssets() {
      try {
         \Artisan::call('vendor:publish', [
            '--tag' => 'admin-setup'
         ]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
