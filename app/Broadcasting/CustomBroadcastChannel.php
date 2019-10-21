<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Channels\BroadcastChannel;
use App\Events\BroadcastNotificationCreated;

class CustomBroadcastChannel extends BroadcastChannel
{
    /**
     * Send the given notification.
     *
     * @param \App\Models\User                       $notifiable   [user model]
     * @param \Illuminate\Notifications\Notification $notification [Notification class]
     *
     * @return array|null
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $this->getData($notifiable, $notification);

        $event = new BroadcastNotificationCreated(
            $notifiable, $notification, is_array($message) ? $message : $message->data
        );

        if ($message instanceof BroadcastMessage) {
            $event->onConnection($message->connection)
                ->onQueue($message->queue);
        }

        return $this->events->dispatch($event);
    }
}
