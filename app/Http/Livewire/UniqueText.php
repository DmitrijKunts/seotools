<?php

namespace App\Http\Livewire;

use App\Actions\UniqueText as ActionsUniqueText;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UniqueText extends Component
{
    public $input = '';
    public $ln = '';
    public $result = '';

    protected $rules = [
        'input' => 'required|min:5|max:4900',
        'ln' => 'required|in:ru,en',
    ];

    public function mount()
    {
        $this->ln = 'ru';
    }

    public function process()
    {
        $this->validate();
        $this->result = ActionsUniqueText::unique($this->input, $this->ln);
    }

    public function render()
    {
        return view('livewire.unique-text');
    }
}
