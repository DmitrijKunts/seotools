<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableSorting extends Component
{
    public $columns;
    public $sorted;
    public $rows;
    public $formaters;
    public $excludeSorting;

    public function mount(
        array $columns = ['id'],
        array $rows = [],
        array $sorted = ['c' => 0, 'd' => true],
        $formaters = [],
        $excludeSorting = []
    ) {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->sorted = $sorted;
        $this->excludeSorting = $excludeSorting;

        $this->formaters = [];
        foreach (range(0, count($columns) - 1) as $i) {
            $this->formaters[$i] = ':cur';
        }
        $this->formaters = array_replace($this->formaters, $formaters);
    }

    public function render()
    {
        return view('tablesorting.index');
    }

    public function format($row, $id)
    {
        $f = [];
        foreach ($row as $i => $td) {
            $f["other$i"] = $td;
        }
        $f["cur"] = $row[$id];
        return __($this->formaters[$id], $f);
    }

    public function setSorting($c, $d)
    {
        $this->sorted['c'] = $c;
        $this->sorted['d'] = $d;
        $this->rows = collect($this->rows)
            ->sortBy([[$this->sorted['c'], $this->sorted['d'] ? 'asc' : 'desc']])
            ->all();
    }
}
