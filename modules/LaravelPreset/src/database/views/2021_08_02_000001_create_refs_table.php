<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      \DB::statement(
         "CREATE OR REPLACE VIEW refs AS
            SELECT name AS label, id AS value, 'users' AS table_name FROM users
            UNION
            SELECT title AS label, id AS value, 'roles' AS table_name FROM roles
            UNION
            SELECT title AS label, id AS value, 'categories' AS table_name FROM categories
            UNION
            SELECT title AS label, id AS value, 'permissions' AS table_name FROM permissions
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
         "DROP VIEW refs"
      );
   }
}
