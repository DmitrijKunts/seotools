<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Cache;

enum TelegraphCmd
{
    case CheckIndex;
    case Combinator;
    case Spintax;
}

class SEOToolsHandler extends WebhookHandler
{

    private function genKey()
    {
        return 'telegraph:lastcmd:' . $this->chat->chat_id;
    }

    protected function handleChatMessage($text): void
    {
        $this->chat->message($this->genKey().'    ' . $text)->send();
        if ($cmd = Cache::get($this->genKey())) {
            if ($cmd == TelegraphCmd::CheckIndex) {
                $this->chat->message($this->genKey().'   Checking index for ' . $text)->send();
                return;
            }
        }
        $this->chat->message('Select command')->send();
    }

    public function checkindex()
    {
        Cache::put($this->genKey(), TelegraphCmd::CheckIndex, 60 * 15);
        $this->reply('Urls one per line');
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
