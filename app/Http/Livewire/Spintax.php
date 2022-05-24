<?php

namespace App\Http\Livewire;

use Livewire\Component;

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
        $this->result = $this->permutation($this->input);
        //{1|2}3}
    }

    public function render()
    {
        return view('livewire.spintax');
    }

    private function permutation($str)
    {
        //{1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222} {1|1|2222}
        if (preg_match_all('~\{([^\{}]+)\}~isu', $str, $m)) {
            foreach ($m[1] as $seq) {
                $parts = explode('|', $seq);
                $partsCount = count($parts);
                if ($partsCount == 1) {
                    $str = str_replace('{' . $seq . '}', $parts[0], $str);
                } else {
                    $ind = rand(0, $partsCount - 1);
                    $str = str_replace('{' . $seq . '}', $parts[$ind], $str);
                }
            }
        }

        return $str;
    }
}
