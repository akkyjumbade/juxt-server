<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Schema;

class GeoProvincesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      // fetch from provinces from api
      $url = base_path('modules/LaravelPreset/src/database/data/states.json');
      try {
         $data = file_get_contents($url);
         $data = json_decode($data, true);
         if ($data) {
            Schema::disableForeignKeyConstraints();
            DB::table('geo_cities')->truncate();
            DB::table('geo_provinces')->truncate();
            Schema::enableForeignKeyConstraints();
            DB::transaction(function () use ($data) {
               $payload = [];
               foreach ($data as $row) {
                  $countryID = DB::table('geo_countries')->where('iso2', $row['country_code'])->value('id');
                  $inc = [
                     'name' => $row['name'],
                     'native_name' => $row['name'],
                     'state_code' => @$row['state_code'],
                     'latitude' => @$row['latitude'],
                     'longitude' => @$row['longitude'],
                     'country_id' => $countryID,
                  ];
                  $payload[] = $inc;

               }
               DB::table('geo_provinces')->insert($payload);

            });

         }
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}

