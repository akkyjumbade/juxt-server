<?php

namespace Modules\LaravelPreset\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdminExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export admin panel setup with assets and essential classes.';

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
       $confirmationMsg = "Have you committed your changes before exporting admin setup?";
       if (!$this->confirm($confirmationMsg)) {
          return 0;
       }
       if (!file_exists(base_path('admin'))) {
          @mkdir(base_path('admin'));
       }
       Artisan::call('vendor:publish --tag admin-setup');
       return 0;
    }
}
