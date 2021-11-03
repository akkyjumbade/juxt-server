<?php
namespace Modules\LaravelPreset\Traits;

trait SetupTrait {
   function setupAdmin() {
      try {
         $this->info('Creating admin panel setup...' . PHP_EOL);
         \Artisan::call('vendor:publish', [
            '--tag' => 'admin-setup'
         ]);
         // $this->publishes();
      } catch (\Throwable $th) {
         throw $th;
      }
   }
   function copyChannels() {
      try {
         // \Artisan::call('notifications:table');
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function migrateDB() {
      try {
         \Artisan::call('migrate --seed');
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function exportNotificationsPreset() {
      try {
         \Artisan::call('notifications:table');
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function migrateQuesTable() {
      try {
         \Artisan::call('queue:table');
         \Artisan::call('queue:batches-table');
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function exportStubs() {
      $isExists = file_exists(app_path() .'/'.__DIR__);
      if (!$isExists) {
         \Artisan::call('stub:publish');
      }
   }

   function linkStorage() {
      \Artisan::call('storage:link');
   }

   function migrateSessionsTable() {
      try {
         \Artisan::call('session:table');
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function seedDB() {
      try {
         \Artisan::call('db:seed', [
            'class' => 'Packages\LaravelPreset\Database\Seeders\DatabaseSeeder'
         ]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function publishSetupAssetsAndCode() {
      try {
         \Artisan::call('vendor:publish', [
            '--tag' => 'setup-models'
         ]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
