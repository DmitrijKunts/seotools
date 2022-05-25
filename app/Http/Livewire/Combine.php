<?php

namespace App\Http\Livewire;

use App\Actions\Combinator;
use Livewire\Component;
use Illuminate\Support\Arr;

class Combine extends Component
{
    public $listCount;
    public $list = [];
    public $result;
    public $resultCount;

    public function mount()
    {
        $this->listCount = 2;
        foreach (range(1, $this->listCount) as $i) {
            $this->list[$i] = '';
        }
        $this->result = '';
    }

    public function combine()
    {
        $this->result = '';
        $res = Combinator::combine($this->list);
        $this->resultCount = $res ? count($res) : '';
        $this->result = $res ? join("\n", $res) : '';
    }

    public function render()
    {
        return view('livewire.combine');
    }
}
