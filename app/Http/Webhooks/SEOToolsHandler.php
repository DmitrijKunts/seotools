<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SEOToolsHandler extends WebhookHandler
{
    public function checkindex()
    {
        $this->chat->message('hello world')
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Delete')->action('delete')->param('id', '42'),
                Button::make('open')->url('https://test.it'),
            ]))->send();
        // Telegraph::message('hello world')->send();
        // $text = $this->message->text();
        // $this->chat->message("Chat ID:" . $text)->send();
    }
}
