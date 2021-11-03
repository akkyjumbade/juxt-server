<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoLocationsViewTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      \DB::statement(
         "CREATE OR REPLACE VIEW geo_locations_view as (
            SELECT
            CONCAT(C.name, ', ', S.name, ', ', CC.name) AS title,
            C.name AS city, C.id AS city_id, C.latitude, C.longitude, S.name AS state, C.geo_province_id AS state_id, CC.name AS country, C.geo_country_id AS country_id
            FROM geo_cities C
            JOIN geo_provinces S
            ON C.geo_province_id = S.id
            JOIN geo_countries CC
            ON C.geo_country_id = CC.id
            ORDER BY C.name ASC
            -- LIMIT 100
         )
         "
      );
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      \DB::statement(
         "DROP VIEW geo_locations_view"
      );
   }
}
