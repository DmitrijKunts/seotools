<?php

namespace App\Actions;

use App\Models\Url;
use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CheckIndex
{
    public static function checkUrl($url, Closure $errorSetter = null)
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
                if($errorSetter){
                    $errorSetter(__('Bad respone'));
                }
                return false;
            }
            if ($response->successful()) {

                $xml = simplexml_load_string($response->body());
                if (isset($xml->response->error)) {
                    if($errorSetter){
                        $errorSetter((string)$xml->response->error);
                    }
                    return false;
                }
                if (!isset($xml->response->found)) {
                    if($errorSetter){
                        $errorSetter(__('Bad respone'));
                    }
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
            if($errorSetter){
                $errorSetter(config('app.debug') ? $e->getMessage() : '500 (Internal Server Error)');
            }
            return false;
        }
    }
}
