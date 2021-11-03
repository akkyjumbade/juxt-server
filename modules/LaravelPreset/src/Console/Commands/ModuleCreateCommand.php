<?php

namespace Modules\LaravelPreset\Console\Commands;

use App\Traits\DeleteUserTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ModuleCreateCommand extends Command
{
   use DeleteUserTrait;
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'module:create';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Create a module and install';

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
      $name = $this->ask('Module Name:', null);
      if (!$name) {
         return 0;
      }

      try {
         $this->updateComposerJson([
            'name' => $name,
         ]);
         return 0;
      } catch (\Throwable $th) {
         throw $th;
      }

   }

   function createDirAndExport($dirName) {
      try {
         @mkdir(base_path("modules/$dirName"));
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   function updateComposerJson(array $params = []) {
      $name = $params['name'];
      $className = Str::studly($name);
      try {
         $this->createDirAndExport($className);
         $contents = file_get_contents(base_path('composer.json'));
         $contents = json_decode($contents, true);
         $autoloadClasses = $contents['autoload']['psr-4'];
         $autoloadClasses["$className\\"] = "modules/$className/";
         $contents = array_merge($contents, [
            'autoload' => [
               'psr-4' => $autoloadClasses,
            ]
         ]);
         dump($className, $contents);
      } catch (\Throwable $th) {
         throw $th;
      }
   }

}
