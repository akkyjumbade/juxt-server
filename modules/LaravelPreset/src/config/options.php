<?php

use Modules\LaravelPreset\Console\Commands\AdminExportCommand;
use Modules\LaravelPreset\Console\Commands\SetupCommand;

return [
   'title' => env('APP_NAME'),
   'url_prefix' => 'admin',

   /* Default options */
   'time_format' => 'H:i:s',
   'date_format' => 'Y-m-d',
   'timezone' => env('APP_LOCALE'),
   'default_user_status' => 'pending',
   'default_country' => env('DEFAULT_COUNTRY', 'IN'),
   'default_currency' => env('DEFAULT_CURRENCY', 'INR'),

   /* Database seeders */
   'db_seeders' => array(
      \Database\Seeders\RolesTableSeeder::class,
      \Database\Seeders\PermissionsTableSeeder::class,
      \Database\Seeders\UsersTableSeeder::class,
      \Database\Seeders\GeoCountriesTableSeeder::class,
      \Database\Seeders\GeoProvincesTableSeeder::class,
      \Database\Seeders\GeoCitiesTableSeeder::class,

   ),

   /* Repositories */
   'repositories' => [
      // 'users' => \App\Repositories\UsersRepository::class,
   ],

   /* Blade components */
   'blade_components' => [
      \Modules\LaravelPreset\Components\Header::class,
      \Modules\LaravelPreset\Components\Sidebar::class,
   ],

   /* Console commands to register in service provider */
   'commands' => [
      SetupCommand::class,
      AdminExportCommand::class,
      \Modules\LaravelPreset\Console\Commands\AdminCreateCommand::class,
      \Modules\LaravelPreset\Console\Commands\ModuleCreateCommand::class,
   ],

   /* Roles */
   'roles' => [
      [
         'label' => 'User',
         'value' => 'user',
      ],
      [
         'label' => 'Admin',
         'value' => 'admin',
      ],
      [
         'label' => 'Root',
         'value' => 'root',
      ],
   ],

   /* Permissions */
   'permissions' => [
      [
         'label' => 'Users',
         'value' => 'users',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Roles',
         'value' => 'roles',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Permissions',
         'value' => 'permissions',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Teams',
         'value' => 'teams',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Categories',
         'value' => 'categories',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Tags',
         'value' => 'tags',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Pages',
         'value' => 'pages',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Address',
         'value' => 'addresses',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
      [
         'label' => 'Navigations',
         'value' => 'navigations',
         'scopes' => ['create', 'read', 'update', 'delete'],
      ],
   ],

   /* User statuses */
   'user_statuses' => [
      [
         'label' => 'Pending',
         'value' => 'pending',
      ],
      [
         'label' => 'Blocked',
         'value' => 'blocked',
      ],
      [
         'label' => 'Suspended',
         'value' => 'suspended',
      ],
      [
         'label' => 'Active',
         'value' => 'active',
      ],
   ],
   /* Categories */
   'categories' => [
      [
         'label' => 'Undefined',
         'value' => 'undefined',
      ],
   ],

   /* Tags */
   'tags' => [
      [
         'label' => 'Undefined',
         'value' => 'undefined',
      ],
   ],



];
