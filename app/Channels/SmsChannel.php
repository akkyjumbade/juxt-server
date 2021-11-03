<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;


class SmsChannel
{
   /**
    * Send the given notification.
    *
    * @param  mixed  $notifiable
    * @param  \Illuminate\Notifications\Notification  $notification
    * @return void
    */
   public function send($notifiable, Notification $notification)
   {
      $message = $notification->toSms($notifiable);
      $message = @$message['message'];
      $phoneNumber = intval($notifiable);
      /* Validate the inputs @starts */
      $validator = \Validator::make([
         'message' => $message,
         'phone' => $phoneNumber,
      ], $this->rules());

      if ($validator->fails()) {
         throw \Illuminate\Validation\ValidationException::withMessages($validator->errors()->toArray());
      }
      /* Validate the inputs @ends */

      try {
         $this->callSmsApi($phoneNumber, $message);
      } catch (\Throwable $th) {
         throw $th;
      }

      // Send notification to the $notifiable instance...
   }

   function rules() {
      return [
         'phone' => ['required', 'digits:10'],
         'message' => ['required', 'string', 'max:200'],
      ];
   }

   function callSmsApi(int $phoneNumber, string $msg) {
      try {
         $url = config('services.sms.send_url');
         $defaultParams = [
            'userid' => config('services.sms.userid'),
            'password' => config('services.sms.password'),
            'sender' => config('services.sms.sender'),
            'peid' => config('services.sms.peid'),
            'tpid' => config('services.sms.tpid'),
         ];
         $params = http_build_query(array_merge($defaultParams, [
            'mobileno' => $phoneNumber,
            'msg' => $msg,
         ]));
         $res = @file_get_contents("$url?$params");
         if (is_string($res)) {
            $isSuccess = Str::contains($res, 'Success');
            if ($isSuccess) {
               return [
                  'ok' => true,
               ];
            } else {
               throw new \App\Exceptions\SmsApiException("Invalid response from SMS API", 1);
            }
         } else {
            throw new \App\Exceptions\SmsApiException("SMS API Exception, Unable to send SMS", 1);
         }
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
