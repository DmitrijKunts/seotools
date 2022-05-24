<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class Spintax extends Component
{
    public $input = '';
    public $result = '';

    protected $rules = [
        'input' => 'required|min:1',
    ];

    public function process()
    {
        $this->validate();
        $this->result = $this->spintax($this->input);
    }

    public function render()
    {
        return view('livewire.spintax');
    }

    private function spintax($str)
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
