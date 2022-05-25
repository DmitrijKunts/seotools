<?php

namespace App\Actions;

use Illuminate\Support\Str;

class Spintax
{
    public static function spin($str)
    {
        do {
            $str = $strNew ?? $str;
            $strNew = (string)Str::of($str)->replaceMatches('~\{([^\{\}]+)\}~u', function ($match) {
                return (string)Str::of($match[1])->explode('|')->random();
            });
        } while ($strNew != $str);

        return $strNew;
    }
}
