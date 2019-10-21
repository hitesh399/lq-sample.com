<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Lib\NotificationTempCompiler;
use App\Jobs\SendPushNotificationJob;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

/**
 * This Call designed to notify the user whom information has been updated by admin.
 */
class MyProfileChangedNotification extends Notification
{
    use Queueable;
    public $modifier = null;

    public function __construct(\App\Models\User $modifier)
    {
        $this->modifier = $modifier;
    }

    public function getData($notifiable)
    {
        return [
            'name' => $notifiable->name,
            'modifier' => [
                'name' => $this->modifier->name,
            ],
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param \App\Models\User $notifiable [User Model]
     *
     * @return array
     */
    public function via(\App\Models\User $notifiable): array
    {
        return ['push', 'DBN', 'BCN'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param \App\Models\User $notifiable [User Model]
     *
     * @return array
     */
    public function toArray(\App\Models\User $notifiable): array
    {
        return  $this->getData($notifiable);
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param \App\Models\User $notifiable [User model]
     *
     * @return BroadcastMessage
     */
    public function toBroadcast(\App\Models\User $notifiable): BroadcastMessage
    {
        return new BroadcastMessage(
            [
                'to_user' => [$notifiable->id],
                'data' => $this->getData($notifiable),
            ]
        );
    }

    /**
     * Send push notification when Porfile information has been Changed.
     *
     * @param App\Models\User $notifiable [User Model]
     *
     * @return void|
     */
    public function toPush(\App\Models\User $notifiable): void
    {
        $template = new NotificationTempCompiler(
            $this->getPushType(),
            $this->getData($notifiable)
        );

        SendPushNotificationJob::dispatchNow(
            [$notifiable->id],
            ['name' => $notifiable->name],
            $template->getSubject(),
            '',
            true,
            $this->getType()
        );
    }

    public function getType(): string
    {
        return 'MYPROFILE_UPDATED_BY_ADMIN';
    }

    public function getDatabaseType(): string
    {
        return $this->getType().'_DATABASE';
    }

    public function getPushType(): string
    {
        return $this->getType().'_PUSH_NOTIFICATION';
    }
}
