<?php

namespace App\Models;

use App\Lib\NotificationTempCompiler;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    public $appends = ['title'];

    public function getTitleAttribute()
    {
        $data = [];
        if (is_array($this->data)) {
            $data = $this->data;
        }
        $data['created_at'] = $this->created_at;

        $template = new NotificationTempCompiler(
            $this->type,
            $data,
            ['created_at' => 'd/m/Y h:i:s A']
        );

        return $template->getSubject();
    }
}
