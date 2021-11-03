<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoCountriesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $url = base_path('modules/LaravelPreset/src/database/data/countries.json');
      try {
         $data = file_get_contents($url);
         $data = json_decode($data, true);
         if ($data) {
            $payload = [];
            foreach ($data as $row) {
               $inc = [
                  'name' => $row['name'],
                  'title' => @$row['name'],
                  'iso3' => @$row['iso3'],
                  'iso2' => @$row['iso2'],
                  'numeric_code' => @$row['numeric_code'],
                  'phone_code' => @$row['phone_code'],
                  'capital' => @$row['capital'],
                  'currency' => @$row['currency'],
                  'currency_symbol' => @$row['currency_symbol'],
                  'native_name' => @$row['native'],
                  'region' => @$row['region'],
                  'subregion' => @$row['subregion'],
                  'latitude' => @$row['latitude'],
                  'longitude' => @$row['longitude'],
                  'flag_emoji' => @$row['emoji'],
                  'flag_emojiU' => @$row['emojiU'],
               ];
               $payload[] = $inc;
               $matchCases = [
                  'name' => $row['name'],
               ];
               DB::table('geo_countries')->updateOrInsert($matchCases, $inc);
            }

         }
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}

