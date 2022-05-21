<?php

namespace App\Http\Livewire;

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
        $res = null;
        foreach ($this->list as $list) {
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
        $this->resultCount = $res ? count($res) : '';
        $this->result = $res ? join("\n", $res) : '';
    }

    public function render()
    {
        return view('livewire.combine');
    }
}
