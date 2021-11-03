<?php

namespace Modules\LaravelPreset\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class GeoLocationController extends Controller
{
   function geoQueryLocations(Request $req) {
      try {
         $sql = "SELECT name as city, latitude as city_latitude
                FROM geo_cities
                LIMIT 10";
         if ($req->query('q')) {
            $search = $req->query('q');
            $sql = "SELECT *
                   FROM geo_locations_view
                    WHERE title LIKE '%$search%'
                   LIMIT 10";
         }
         $data = cache()->rememberForever("search_geo_$search", function () use($sql) {
            return DB::select(DB::raw($sql));
         });
         //dd($data);
         return response()->success([
            'data' => $data,
         ]);
      }catch (\Throwable $th) {
         throw $th;
      }
   }
   function getCountries(Request $req) {
      try {
         $countries = \DB::table('geo_countries')->select([
            'name', 'latitude', 'longitude', 'flag_emoji as flag'
         ])->orderBy('name')->get();
         return response()->success([
            'data' => $countries
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }
   function getStates(Request $req) {
      $req->validate([
         'country' => ['nullable'],
      ]);
      $countryCode = $req->query('country', config('options.default_country', 'IN'));
      try {
         $states = \DB::table('geo_provinces')->select([
            'name', 'latitude', 'longitude',
         ])->whereRaw("country_id IN (SELECT id FROM geo_countries WHERE iso2 = '$countryCode')")->orderBy('name')->get();
         return response()->success([
            'data' => $states
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }

   function getCities(Request $req) {
      $req->validate([
         'state' => ['nullable'],
      ]);
      $stateCode = $req->query('state');
      try {
         $cities = \DB::table('geo_cities')->select([
            'name', 'latitude', 'longitude',
         ])->whereRaw("geo_province_id IN (SELECT id FROM geo_provinces WHERE name LIKE '$stateCode')")->orderBy('name')->get();
         return response()->success([
            'data' => $cities
         ]);
      } catch (\Throwable $th) {
         return response()->error([
            'message' => $th->getMessage(),
         ]);
      }
   }
}
