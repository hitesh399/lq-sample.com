<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Events\BroadcastNotificationCreated as BroadcastNotificationCreatedCore;

class BroadcastNotificationCreated extends BroadcastNotificationCreatedCore implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Get the data that should be sent with the broadcasted event.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return method_exists($this->notification, 'broadcastAs')
        ? $this->notification->broadcastAs()
        : (
            method_exists($this->notification, 'getType')
            ? $this->notification->getType()
            : get_class($this->notification)
        );
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        $channels = $this->notification->broadcastOn();

        if (!empty($channels)) {
            return $channels;
        }

        return ['notification'];
    }
}
