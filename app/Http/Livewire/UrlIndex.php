<?php

namespace App\Http\Livewire;

use App\Models\Url;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class UrlIndex extends Component
{
    public $url;

    public function mount(Url $url)
    {
        $this->url = $url;
    }

    public function render()
    {
        $columnChartModel =
            (new ColumnChartModel())
            ->setTitle(__('Index Value'))
            ->setAnimated(true)
            ->withDataLabels()
            ->withoutLegend();
        foreach ($this->url->index as $day) {
            $columnChartModel = $columnChartModel->addColumn($day->created_at->format('Y-m-d'), $day->val, '#f6ad55');
        }
        return view('livewire.url-index')->with(compact('columnChartModel'));
    }
}
