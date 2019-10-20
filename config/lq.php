<?php

return [
    'media_model_instance' => App\Models\Media::class,
    'site_config_class' => Singsys\LQ\Models\SiteConfig::class,
    'notification_template_class' => Singsys\LQ\Models\NotificationTemplate::class,
    'device_class' => App\Models\Device::class,
    'request_log_class' => Singsys\LQ\Models\RequestLog::class,
    'check_authentication' => false,
];
