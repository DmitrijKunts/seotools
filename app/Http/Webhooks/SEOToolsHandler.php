<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SEOToolsHandler extends WebhookHandler
{

    protected function handleChatMessage($text): void
    {
        $this->chat->message('hello world')
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Check index')->action('checkindex'),
                Button::make('Combinator')->action('combinator'),
                Button::make('Spintax')->action('spintax'),

            ]))->send();
    }

    public function checkindex()
    {
        $this->chat->message("dddddddddddd")->send();
    }
}
