<?php

namespace Modules\LaravelPreset\Console\Commands;

use Illuminate\Console\Command;
use \Modules\LaravelPreset\Traits\SetupTrait;

class SetupCommand extends Command
{
   use SetupTrait;
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'setup {action?} {--seed}';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Setup laravel presets';

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
      $hasToSeed = $this->option('seed');
      if ($hasToSeed) {
         $this->seedDB();
         return 0;
      }
      if ($this->argument('action')) {
         if ($this->argument('action') == 'publish') {
            $this->publishSetupAssetsAndCode();
         }
         if ($this->argument('action') == 'admin') {
            $this->setupAdmin();
         }
         return 0;
      }
      if (!$this->confirm('Did you commit your changes before setup? If not please do git commit.')) {
         return 0;
      }
      $this->info('Creating laravel preset setup...');

      $stages = [
         fn() => $this->exportNotificationsPreset(),
         fn() => $this->migrateQuesTable(),
         fn() => $this->migrateSessionsTable(),
         fn() => $this->linkStorage(),
         fn() => $this->exportStubs(),
         fn() => $this->copyChannels(),
         fn() => $this->migrateDB(),
      ];
      $stagesCount = count($stages);
      $progressBar = $this->output->createProgressBar($stagesCount);
      $progressBar->start();
      foreach ($stages as $key => $stage) {
         try {
            $stage && $stage();
         } catch (\Throwable $th) {
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

}
