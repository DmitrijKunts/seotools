<?php

namespace App\Http\Webhooks;

use App\Actions\CheckIndex;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

enum TelegraphCmd: string
{
    case CheckIndex = 'CheckIndex';
    case Combinator = 'Combinator';
    case Spintax = 'Spintax';
}

class SEOToolsHandler extends WebhookHandler
{

    public function genKey()
    {
        return 'telegraph:lastcmd:' . $this->chat->chat_id;
    }

    protected function handleChatMessage($text): void
    {
        if ($cmd = Cache::get($this->genKey())) {
            if ($cmd == TelegraphCmd::CheckIndex) {
                Cache::forget($this->genKey());
                $response = '';
                $error = '';
                foreach (Str::of($text)->explode("\n")->slice(0, 10) as $url) {
                    $res = CheckIndex::checkUrl($url, function ($s) use (&$error) {
                        $error = $s;
                    });
                    if ($res === false) {
                        $response .= $error;
                        break;
                    }
                    $response .= "{$url}\t{$res}\n";
                }
                $this->chat->message($response)->send();
                return;
            }
        }
        Cache::forget($this->genKey());
        // $this->chat->message('Select command')->send();
        $this->chat->message('Select command')
            ->keyboard(Keyboard::make()->row([
                Button::make('Check index')->action('checkindex'),
                Button::make('Combinator')->action('combinator'),
                Button::make('Spintax')->action('spintax'),

            ]))->send();
    }

    public function checkindex()
    {
        Cache::put($this->genKey(), TelegraphCmd::CheckIndex, 60 * 15);
        $this->chat->message('Urls one per line. Max 10 urls.')->send();
    }

    public function combinator()
    {
        $this->chat->message("combinator")->send();
    }

    public function spintax()
    {
        $this->chat->message("spintax")->send();
    }
}
