<?php

namespace Bigraja\BulkBDSms;

use Illuminate\Notifications\Notification;

class BulkBDSmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toBulkBDSms')) {
            return;
        }

        $message = $notification->toBulkBDSms($notifiable);
        $to = $notifiable->routeNotificationFor('bulkbdsms', $notification);

        if ($to && $message) {
            app(BulkBDSmsService::class)->send($to, $message);
        }
    }
}
