<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class SEOToolsHandler extends WebhookHandler
{

    // protected function handleChatMessage($text): void
    // {
    //     $this->chat->message('hello world')
    //         ->keyboard(Keyboard::make()->buttons([
    //             Button::make('Check index')->action('checkindex')->param('id', 'checkindex42'),
    //             Button::make('Combinator')->action('combinator')->param('id', 'combinator1'),
    //             Button::make('Spintax')->action('spintax')->param('id', 'spintax542'),

    //         ]))->send();
    // }

    public function checkindex()
    {
        $this->chat->message("checkindex: dddddddddddd")->send();
    }

    public function combinator()
    {
        // // $this->chat->message("combinator: dddddddddddd")->send();
        // $this->reply("notification dismissed");
        $this->chat->message('hello world')
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Check index')->action('checkindex')->param('id', 'checkindex42'),
                Button::make('Combinator')->action('combinator')->param('id', 'combinator1'),
                Button::make('Spintax')->action('spintax')->param('id', 'spintax542'),

            ]))->send();
    }
}
