<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class SEOToolsHandler extends WebhookHandler
{

    protected function handleChatMessage(Stringable $text): void
    {
        $this->chat->keyboard(Keyboard::make()->buttons([
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
