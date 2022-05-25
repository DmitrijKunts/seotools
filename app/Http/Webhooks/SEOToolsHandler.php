<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\Message;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class SEOToolsHandler extends WebhookHandler
{
    public function checkindex()
    {
        Telegraph::message('hello world')
        ->keyboard(Keyboard::make()->buttons([
                Button::make('Delete')->action('delete')->param('id', '42'),
                Button::make('open')->url('https://test.it'),
        ]))->send();
        // Telegraph::message('hello world')->send();
        // $text = $this->message->text();
        // $this->chat->message("Chat ID:" . $text)->send();
    }
}