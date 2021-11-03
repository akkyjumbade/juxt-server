<?php

return [

   /*
   |--------------------------------------------------------------------------
   | Third Party Services
   |--------------------------------------------------------------------------
   |
   | This file is for storing the credentials for third party services such
   | as Mailgun, Postmark, AWS and more. This file provides the de facto
   | location for this type of information, allowing packages to have
   | a conventional file to locate the various service credentials.
   |
   */

   'mailgun' => [
      'domain' => env('MAILGUN_DOMAIN'),
      'secret' => env('MAILGUN_SECRET'),
      'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
   ],

   'postmark' => [
      'token' => env('POSTMARK_TOKEN'),
   ],

   'ses' => [
      'key' => env('AWS_ACCESS_KEY_ID'),
      'secret' => env('AWS_SECRET_ACCESS_KEY'),
      'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
   ],
   'sms' => [
      'send_url' => "http://websms.esandesh.in/websms/sendsms.aspx",
      'userid' => env('SMS_USERID', 'demoesandesh'),
      'password' => env('SMS_PASSWORD', 'demo123'),
      'sender' => env('SMS_SENDERID', 'ESNOTP'),
      'peid' => env('SMS_PEID', '1201161767891297633'),
      'tpid' => env('SMS_TPID', '1207161837752607119'),
   ]

];
