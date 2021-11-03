<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GeoCitiesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      // fetch from provinces from api
      $url = base_path('modules/LaravelPreset/src/database/data/cities.json');
      try {
         $data = file_get_contents($url);
         $data = json_decode($data, true);
         if ($data) {
            $payload = [];
            foreach ($data as $row) {
               $countryID = DB::table('geo_countries')->where('iso2', @$row['country_code'])->value('id');
               $stateID = DB::table('geo_provinces')->where([
                  'state_code' => @$row['state_code'],
                  'country_id' => $countryID,
               ])->value('id');
               if ($stateID) {
                  $inc = [
                     'name' => $row['name'],
                     'native_name' => $row['name'],
                     'latitude' => @$row['latitude'],
                     'longitude' => @$row['longitude'],
                     'geo_province_id' => $stateID,
                     'geo_country_id' => $countryID,
                  ];
                  $payload[] = $inc;
               } else {
                  \Log::error("Province not found: ". $row['state_code']);
               }

            }
            if ($payload) {
               Schema::disableForeignKeyConstraints();
               DB::table('geo_cities')->truncate();
               Schema::enableForeignKeyConstraints();
            }
            $payloads = collect($payload)->chunk(500)->toArray();
            foreach ($payloads as $payload) {
               DB::transaction(function () use ($data, $payload) {
                  DB::table('geo_cities')->insert($payload);
               });
            }


         }
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}

