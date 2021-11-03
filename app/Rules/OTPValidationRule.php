<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OTPValidationRule implements Rule
{
   /**
    * Create a new rule instance.
    *
    * @return void
    */
   public $phone;
   public function __construct($phone)
   {
      $this->phone = $phone;
   }

   /**
    * Determine if the validation rule passes.
    *
    * @param  string  $attribute
    * @param  mixed  $value
    * @return bool
    */
   public function passes($attribute, $value)
   {
      $otpFromSession = cache()->get("tmp_otp_".$this->phone);

      if ($value != $otpFromSession) {
         return false;
      }
      return true;
   }

   /**
    * Get the validation error message.
    *
    * @return string
    */
   public function message()
   {
      return 'Invalid OTP';
   }
}
