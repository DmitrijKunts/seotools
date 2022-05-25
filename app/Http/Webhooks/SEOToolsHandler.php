<?php

namespace App\Http\Webhooks;

use App\Actions\CheckIndex;
use App\Actions\Combinator;
use App\Actions\Spintax;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

enum TelegraphCmd: string
{
    case CheckIndex = 'CheckIndex';
    case Combinator1 = 'Combinator1';
    case Combinator2 = 'Combinator2';
    case Spintax = 'Spintax';
}

class SEOToolsHandler extends WebhookHandler
{

    public function genKey(): string
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

            if ($cmd == TelegraphCmd::Combinator1) {
                Cache::put($this->genKey(), TelegraphCmd::Combinator2, 60 * 15);
                Cache::put($this->genKey() . ':combinator', $text, 60 * 15);
                $this->chat->message('Enter list #2')->send();
                return;
            }
            if ($cmd == TelegraphCmd::Combinator2) {
                Cache::forget($this->genKey());
                $text1 = Cache::get($this->genKey() . ':combinator', '');
                $res = Combinator::combine([$text1, $text]);
                $this->chat->message(join("\n", $res ?? []))->send();
                return;
            }

            if ($cmd == TelegraphCmd::Spintax) {
                Cache::forget($this->genKey());
                $this->chat->message(Spintax::spin($text))->send();
                return;
            }
        }
        Cache::forget($this->genKey());
        $this->chat->message('Select command')
            // ->keyboard(Keyboard::make()->row([
            //     Button::make('Check index')->action('checkindex'),
            //     Button::make('Combinator')->action('combinator'),
            //     Button::make('Spintax')->action('spintax'),

            // ]))
            ->send();
    }

    public function checkindex()
    {
        Cache::put($this->genKey(), TelegraphCmd::CheckIndex, 60 * 15);
        $this->chat->message('Bulk Google Indexing Checker. Urls one per line. Max 10 urls.')->send();
    }

    public function combinator()
    {
        Cache::put($this->genKey(), TelegraphCmd::Combinator1, 60 * 15);
        $this->chat->message("Type or paste the phrases one per line. Empty lines are ignored. List #1")->send();
    }

    public function spintax()
    {
        Cache::put($this->genKey(), TelegraphCmd::Spintax, 60 * 15);
        $this->chat->message("Enter text in the format {a|b| {x|y|z} c}")->send();
    }

    public function upcmd()
    {
        $this->bot->registerCommands([
            'checkindex' => 'Check index',
            'combinator' => 'Combinator',
            'spintax' => 'Spintax',
        ])->send();
        $this->chat->message("Command updated!")->send();
    }
}
