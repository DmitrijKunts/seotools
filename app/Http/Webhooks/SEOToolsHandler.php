<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\Message;

class SEOToolsHandler extends WebhookHandler
{
    public function chekIndex()
    {
        $text = $this->message()->text();
        $this->chat->message("Chat ID:" . $text)->send();
    }
}
