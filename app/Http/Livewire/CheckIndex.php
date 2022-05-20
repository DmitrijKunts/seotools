<?php

namespace App\Http\Livewire;

use App\Models\Url;
use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CheckIndex extends Component
{
    public $urlsChecked = [];
    public $urlsCheckedRaw = '';
    public $urlsForCheck = [];
    // public $urls = "ddqc.xyz\nqh8.xyz\nlacefrontwigs.xyz\nmonstmagazine.xyz\nqbse.xyz\nabeh.xyz\nyyrr.xyz\n06h.xyz\nindosex.xyz\nshapegrain.xyz\nvasegiraffe.xyz\nfickfilme.xyz\nkjyy.xyz\nhappynewyear2015.xyz\ntjxl.xyz\ncuteasian.xyz\ngiftsmarble.xyz\nterrabattle.xyz\nsiriussun.xyz\nuaeproperty.xyz";
    // public $urls = "yandex.ru\nddqc.xyz\nqh8.xyz\nlacefrontwigs.xyz\nmonstmagazine.xyz\nqbse.xyz\nabeh.xyz";
    public $urls = '';
    public $crawlUrls = false;

    public $errorText = null;

    public $progressMsg = '';
    public $progressPos = 0;

    protected $rules = [
        'urls' => 'required|min:3',
    ];

    public function mount()
    {
        $this->urls = session('check-index.urls', '');
        $this->urlsChecked = session('check-index.urls-checked', []);
        $this->urlsCheckedRaw = session('check-index.urls-checked-raw', '');
    }

    public function render()
    {
        return view('livewire.check-index')->with([
            'lim_guest' => config('app.check_google_index_limit_guest'),
            'lim_auth' => config('app.check_google_index_limit_auth'),
        ]);
    }

    public function checkUrl($url)
    {
        $key = "index:$url";
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        try {
            $response = Http::get(config('app.check_api_url'), [
                'api_key' => config('app.check_api_key'),
                'q' => "site:$url",
            ]);
            if ($response->failed()) {
                $this->errorText = __('Bad respone');
                return false;
            }
            if ($response->successful()) {

                $xml = simplexml_load_string($response->body());
                if (isset($xml->response->error)) {
                    $this->errorText = (string)$xml->response->error;
                    return false;
                }
                if (!isset($xml->response->found)) {
                    $this->errorText = __('Bad respone');
                    return false;
                }
                $indexed = (int)$xml->response->found;
                Cache::put($key, $indexed, 60 * 60 * 24);

                $modelUrl = Url::updateOrCreate(['url' => $url]);
                $latsVal = $modelUrl->indexOnDate();
                if ($latsVal === null || $latsVal != $indexed) {
                    $modelUrl->index()->create(['val' => $indexed]);
                }

                return $indexed;
            }
        } catch (\Exception $e) {
            $this->errorText = config('app.debug') ? $e->getMessage() : '500 (Internal Server Error)';
            return false;
        }
    }

    private function getMaxAttempts()
    {
        if (Auth::check()) {
            return Auth::id() ? 999999 : config('app.check_google_index_limit_auth', 100);
        }
        if (Auth::guest()) {
            return config('app.check_google_index_limit_guest', 30);
        }
    }

    public function checking()
    {
        if ($this->crawlUrls) {
            $key = 'check-index:' . (Auth::check() ? Auth::user() : request()->ip());
            $maxAttempts = $this->getMaxAttempts();

            $startTime = now();
            foreach ($this->urlsForCheck as $url) {
                $url = (string)Str::of($url)->match("/(?:https?(?::\/\/))?((?:www\.)?[a-zA-Z0-9-_\.]+(?:\.[a-zA-Z0-9]{2,})(?:[-a-zA-Z0-9:%_\+.~#?&\/\/=]*))/m");
                if ($url == '' || isset($this->urlsChecked[$url])) {
                    continue;
                }
                $executed = RateLimiter::attempt(
                    $key,
                    $maxAttempts,
                    function () use ($url) {
                        $res = $this->checkUrl($url);
                        if ($res === false) {
                            $this->crawlUrls = false;
                            return;
                        }
                        $this->urlsChecked[$url] = $res;
                        $this->urlsCheckedRaw .= "$url\t$res\n";
                        session([
                            'check-index.urls-checked' => $this->urlsChecked,
                            'check-index.urls-checked-raw' => $this->urlsCheckedRaw,
                        ]);
                    },
                    decaySeconds: 60 * 60 * 24
                );
                $this->progressMsg = sprintf('%d/%d', count($this->urlsChecked), count($this->urlsForCheck));
                $this->progressPos = 100 * count($this->urlsChecked) / count($this->urlsForCheck);

                if (!$executed) {
                    $this->errorText = __('Too many attempts!');
                    $this->crawlUrls = false;
                    return;
                }
                if ($startTime->diffInMilliseconds(now()) >= 1000) {
                    return;
                }
            }
            $this->crawlUrls = false;
        }
    }

    public function startCheck()
    {
        $this->validate();
        session([
            'check-index.urls' => $this->urls,
            'check-index.urls-checked' => [],
            'check-index.urls-checked-raw' => '',
        ]);

        $this->urlsForCheck = explode("\n", $this->urls);
        $this->urlsChecked = [];
        $this->urlsCheckedRaw = '';
        $this->progressMsg = '';
        $this->progressPos = 0;
        $this->crawlUrls = true;
        $this->errorText = null;
        // $this->checking();
    }
}
