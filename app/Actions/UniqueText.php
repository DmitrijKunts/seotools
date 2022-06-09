<?php

namespace App\Actions;

use \Statickidz\GoogleTranslate;

class UniqueText
{
    public static function unique($text, $ln = 'ru')
    {
        $trans = new GoogleTranslate();

        //https://cloud.google.com/translate/docs/languages
        $allowLangs = [
            'ru',
            'en',
            'fr',
            'de',
            'el',
            'ga',
            'pl',
            'pt',
            'sv',
            'it',
            'fi',
            'da',
        ];

        #Tier 1
        $allowLangs = array_diff($allowLangs, [$ln]);
        $targetTier1 = $allowLangs[array_rand($allowLangs)];
        $text = $trans->translate($ln, $targetTier1, $text);

        #Tier 2
        $allowLangs = array_diff($allowLangs, [$targetTier1]);
        $targetTier2 = $allowLangs[array_rand($allowLangs)];
        $text = $trans->translate($targetTier1, $targetTier2, $text);

        return $trans->translate($targetTier2, $ln, $text);
    }
}
