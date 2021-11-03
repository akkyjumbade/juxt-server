<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SMSNotification extends Notification
{
   use Queueable;
   public $message;
   /**
    * Create a new notification instance.
    *
    * @return void
    */
   public function __construct($msg)
   {
      $this->message = $msg;
   }

   /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
   public function via($notifiable)
   {
      return [
         \App\Channels\SmsChannel::class
      ];
   }


   /**
    * Get the array representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return array
    */
   public function toSms($notifiable)
   {
      return [
         'message' => $this->message,
      ];
   }
}
