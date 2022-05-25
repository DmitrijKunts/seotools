<?php

namespace App\Actions;

class Combinator
{
    public static function combine($lists){
        $res = null;
        foreach ($lists as $list) {
            $items = collect(explode("\n", $list))
                ->map(fn ($i) => trim($i))
                ->filter(fn ($i) => $i != '')
                ->slice(0, 999)->all();
            if (!$res) {
                $res = $items;
            } else {
                $resNew = [];
                foreach ($res as $i) {
                    foreach ($items as $j) {
                        $resNew[] = "$i $j";
                    }
                }
                $res = $resNew;
            }
        }
        return $res;
    }
}
