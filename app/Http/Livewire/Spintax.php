<?php

namespace App\Http\Livewire;

use App\Actions\Spintax as ActionsSpintax;
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
        $this->result = ActionsSpintax::spin($this->input);
    }

    public function render()
    {
        return view('livewire.spintax');
    }
}
