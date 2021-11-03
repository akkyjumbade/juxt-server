<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class OtpController extends Controller
{
   use \App\Traits\UserTrait;
   function sendOtp(Request $req) {
      $req->validate([
         'phone' => ['required', 'digits:10'],
      ]);
      $phone = $req->phone;
      try {
         $tmpOtp = cache()->remember("tmp_otp_". $phone, 60 /2, function() {
            return rand(111111, 999999);
         });
         $msg = "Dear User, Your OTP for login is $tmpOtp Note: The OTP is valid for 30 mins only. Do not share the OTP with anyone.";
         \Notification::send([ $phone, ],
            new \App\Notifications\SMSNotification($msg)
         );
         $user = User::where('phone', $phone)->first();
         $token = null;
         if ($user) {
            $user->load('address');
            $token = auth('jwt')->login($user);
         }
         return response()->success([
            'message' => 'OTP Sent successfully.',
            'otp' => $tmpOtp,
            'token' => $token,
         ]);
      } catch (\Throwable $th) {
         //throw $th;
         return response()->error([
            'message' => $th->getMessage()
         ]);
      }
   }
}
