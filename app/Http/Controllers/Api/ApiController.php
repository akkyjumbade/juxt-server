<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeoLocation;

class ApiController extends Controller
{
   use \App\Traits\GeoLocationsTrait;

   function index() {
      $data = [];
      $data['version'] = config('app.version', '0.0.0');
      $data['android'] = [
         'version' => env('ANDROID_APP_VERSION', '0.0.0'),
         'version_number' => env('ANDROID_APP_VERSION_NUMBER', '0.0.0'),
         'store_url' => env('ANDROID_APP_URL', ),
      ];
      $data['ios'] = [
         'version' => env('IOS_APP_VERSION', '0.0.0'),
         'version_number' => env('IOS_APP_VERSION_NUMBER', '0.0.0'),
         'store_url' => env('IOS_APP_URL', ),
      ];
      $data['name'] = config('app.name');
      $data['description'] = config('app.description');
      $data['url'] = config('app.url');
      return response()->success($data);
   }

   function geoLocations(Request $req) {
      $postal_code = $req->query('postal_code');
      try {
         $data = $this->getPostalCodeData($postal_code);
         // dd($data);
         return response()->success([
            'data' => @$data,
         ]);
      } catch (\Throwable $th) {
         // throw $th;
         return response()->error([
            'msg' => $th->getMessage(),
         ]);
      }

   }
}
