<?php
namespace Modules\LaravelPreset\Traits;

trait HasUserAttrs {
   function attrs() {
      return $this->morphMany(
         \App\Models\UserAttr::class,
         'user_attrsable'
      );
   }
   function getCustomAttrsAttribute() {
      $attrs = $this->attrs()->pluck('data', 'name');
      return $attrs;
   }
   function addAttribute($key, $value = null, $payload = []) {
      $this->attrs()->updateOrCreate([
         'name' => $key,
      ], array_merge($payload, [
         'name' => $key,
         'label' => $key,
         'data' => $value,
         // 'resource_name' => 'users',
      ]));
   }
}
