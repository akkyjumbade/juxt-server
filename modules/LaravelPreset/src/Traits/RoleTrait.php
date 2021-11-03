<?php
namespace Modules\LaravelPreset\Traits;

trait RoleTrait {
   function role() {
      return $this->belongsTo(
         \App\Models\Role::class
      );
   }

   function getRoleCodeAttribute() {
      return $this->role->code ?? 'user';
   }

}
