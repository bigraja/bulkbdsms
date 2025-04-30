<?php

namespace Bigraja\BulkSmsBD;

use Illuminate\Notifications\Notification;

class BulkSmsBDChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toBulkSmsBD')) {
            return;
        }

        $message = $notification->toBulkSmsBD($notifiable);
        $to = $notifiable->routeNotificationFor('bulksmsbd', $notification);

        if ($to && $message) {
            app(BulkSmsBDService::class)->send($to, $message);
        }
    }
}
