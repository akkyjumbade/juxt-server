<?php
namespace App\Traits;

trait GeoLocationsTrait {
   function mapEntity($row) {

   }
   function getPostalCodeData($postalCode) {
      try {
         $url = "https://api.postalpincode.in/pincode/$postalCode";
         $res = cache()->rememberForever("pincode_$postalCode", function() use ($url) {
            return @file_get_contents($url);
         });
         $res = json_decode($res, true);
         $res = $res[0] ?? $res;
         $res = $res['PostOffice'] ?? $res;
         return $res;
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
