<?php

namespace App\Lib;

use Singsys\LQ\Lib\Concerns\NotificationTemplate;

class NotificationTempCompiler
{
    use NotificationTemplate;

    public $templateName = '';
    public $template = null;
    public $data = [];

    public function __construct($template_name, array $data, array $timeVeriables = [], string $time_offset = null)
    {
        $this->timeVeriables = $timeVeriables;
        $this->data = $data;
        $this->templateName = $template_name;
        $request = app('request');
        $time_offset = $time_offset ? $time_offset : $request->header('time-offset');
        $this->outTimeZone = $time_offset ? $time_offset : 'UTC';
        $this->template = $this->getTemaplate(
            $this->templateName, $this->data
        );
    }

    public function getSubject()
    {
        return $this->template['subject'];
    }

    public function getBody()
    {
        return $this->template['body'];
    }
}
