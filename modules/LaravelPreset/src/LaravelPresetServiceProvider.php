<?php
namespace Modules\LaravelPreset;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class LaravelPresetServiceProvider extends ServiceProvider {
   function boot() {
      $this->loadRoutesFrom(__DIR__.'/routes/web.php');
      $this->mergeConfigFrom(__DIR__.'/config/options.php', 'options');
      $this->loadViewsFrom(__DIR__.'/views', 'preset');
      $this->loadMigrationsFrom(__DIR__.'/database/migrations');
      $this->loadMigrationsFrom(__DIR__.'/database/views');

      $this->publishes([
         __DIR__.'/config/options.php' => config_path('options.php'),
         __DIR__.'/translations' => resource_path('lang/vendor/preset'),
      ]);
      $this->publishes([
         __DIR__.'/database/seeders' => database_path('seeders'),
      ], 'setup-exports');
      $this->publishes([
         __DIR__.'/Models' => app_path('Models'),
         __DIR__.'/Channels' => app_path('Channels'),
         __DIR__.'/Rules' => app_path('Rules'),
         __DIR__.'/Notifications' => app_path('Notifications'),
      ], 'setup-models');
      $this->publishes([
         __DIR__.'/config/options.php' => config_path('options.php'),
         __DIR__.'/translations' => resource_path('lang/vendor/preset'),
         __DIR__.'/../assets' => public_path('assets/admin'),
      ], 'admin-setup');

      // add the commands
      if ($this->app->runningInConsole()) {
         $this->commands(config('options.commands'));
      }

      /* Register blade components @start */
      /* Register blade components @end */

      Blade::directive('datetime', function ($expression) {
         return "<?php echo ($expression)->format(config('options.datetime_format', 'Y-m-d H:i')); ?>";
      });
      Blade::directive('date', function ($expression) {
         return "<?php echo ($expression)->format(config('options.date_format', 'Y-m-d')); ?>";
      });
      Blade::directive('time', function ($expression) {
         return "<?php echo ($expression)->format(config('options.time_format', 'H:i A')); ?>";
      });
      Blade::directive('asset', function ($src) {
         return "<?php echo url('assets/'.$src); ?>";
      });

      Response::macro('success', function ($value = [], $status = 200, $statusCode = 'success') {
         $props = [
            'ok' => true,
            'timestamp' => time(),
            'code' => $status,
            'status' => strtolower($statusCode),
         ];
         $props = array_merge($value, $props);
         return Response::json($props, $status)->header('Content-Type', 'application/json');
      });
      Response::macro('error', function ($value = [], $status = 401, $statusCode = 'error') {
         $props = [
            'ok' => false,
            'timestamp' => time(),
            'code' => $status,
            'status' => strtolower($statusCode),
         ];
         $props = array_merge($value, $props);
         return Response::json($props, $status)->header('Content-Type', 'application/json');
      });
   }
   function register() {

   }
}
