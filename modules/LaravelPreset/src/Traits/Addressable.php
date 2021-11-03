<?php

namespace Modules\LaravelPreset\Traits;
use \App\Models\Address;

trait Addressable {
   function _emptyProps() {
      return [
         'address_line' => '',
         'address_line_2' => '',
         'city' => '',
         'state' => '',
         'postal_code' => '',
         'country' => '',
         'latitude' => '',
         'longitude' => '',
      ];
   }
   public function addresses() {
      return $this->morphMany(Address::class, 'addressesable');
   }
   public function address() {
      return $this->morphOne(Address::class, 'addressesable')->latestOfMany()->withDefault($this->_emptyProps());
   }
}
