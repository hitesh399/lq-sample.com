<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user_ids = [];
    public $title = null;
    public $body = null;
    public $data = [];
    public $type = null;
    public $force_send = null;
    public $include_notification_payload = true;

    /**
     * Push Notification.
     *
     * @param array  $user_ids                     [User database primary key to send the push noti]
     * @param array  $data                         [Data to send in payload]
     * @param string $title                        [Notification Title]
     * @param string $body                         [Notification Body]
     * @param bool   $include_notification_payload [send Notification payload]
     * @param string $type                         [Indetify the message on client side]
     * @param bool   $force_send                   [Send, if user does not allowed push notification]
     */
    public function __construct(
        array $user_ids,
        array $data,
        string $title = null,
        string $body = null,
        bool $include_notification_payload = true,
        string $type = null,
        bool $force_send = false
    ) {
        $this->user_ids = $user_ids;
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
        $this->data = $data;
        $this->include_notification_payload = $include_notification_payload;
        $this->force_send = $force_send;
    }

    /**
     * Execute the job.
     *
     * @return void|
     */
    public function handle()
    {
        $site_config = app()->make('site_config');

        app('config')->set(
            'fcm',
            [
                'driver' => env('FCM_PROTOCOL', 'http'),
                'log_enabled' => false,
                'http' => [
                    'server_key' => $site_config->get('FIREBASE_SERVER_KEY', env('FCM_SERVER_KEY')),
                    'sender_id' => $site_config->get('FIREBASE_SENDER_ID', env('FCM_SENDER_ID')),
                    'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
                    'server_group_url' => 'https://android.googleapis.com/gcm/notification',
                    'timeout' => 30.0, // in second
                ],
            ]
        );
        $tokens = \App\Lib\MyApp::getUserDeviceToken($this->user_ids);
        if (!$this->force_send) {
            $tokens->where('device_user.settings->allow_push_notification', 'Yes');
        }
        $tokens = $tokens->get()->pluck('device_token')->toArray();
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        if ($this->include_notification_payload) {
            $notificationBuilder = new PayloadNotificationBuilder($this->title);
            $notificationBuilder->setBody($this->body)
                ->setSound('default');
            $notification_payload = $notificationBuilder->build();
        } else {
            $notification_payload = [];
        }

        $this->data['type'] = $this->type;

        if (!$this->include_notification_payload) {
            $this->data['title'] = $this->title;
            $this->data['body'] = $this->body;
        }

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($this->data);
        $data_payload = $dataBuilder->build();

        $option = $optionBuilder->build();

        try {
            FCM::sendTo($tokens, $option, $notification_payload, $data_payload);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
