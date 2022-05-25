<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\Message;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class SEOToolsHandler extends WebhookHandler
{
    public function chekIndex()
    {
        $text = $this->message()->text();
        $this->chat->message("Chat ID:" . $text)->send();
    }
}
