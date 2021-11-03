<?php

namespace App\Console\Commands;

use Database\Seeders\GeoLocationsSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\LaravelPreset\Database\Seeders\GeoCitiesTableSeeder;
use Modules\LaravelPreset\Database\Seeders\GeoCountriesTableSeeder;
use Modules\LaravelPreset\Database\Seeders\GeoProvincesTableSeeder;

class GeoLocationsSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geo:setup {type=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh setup of Geo locations';

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
       $arg = $this->argument('type');
       $arg = trim(strtolower($arg));
       $seederClass = GeoLocationsSeeder::class;
       if ($arg == 'cities') {
          $seederClass = GeoCitiesTableSeeder::class;
       } else if ($arg == 'states') {
          $seederClass = GeoProvincesTableSeeder::class;
       } else if ($arg == 'countries') {
          $seederClass = GeoCountriesTableSeeder::class;
       }
       Artisan::call("db:seed", [
          '--class' => $seederClass
       ]);


       return 0;
    }
}
