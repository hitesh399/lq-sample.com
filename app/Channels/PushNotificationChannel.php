<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class PushNotificationChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable   [User object]
     * @param \Illuminate\Notifications\Notification $notification [Notification object]
     *
     * @return void|
     */
    public function send(\App\Models\User $notifiable, Notification $notification)
    {
        $notification->toPush($notifiable);
    }
}
