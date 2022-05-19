<div class="h-96">
    <x-slot name="title">{{ __('Url Index History') }}</x-slot>
    <x-slot name="header">{{ __('Url Index History') }}</x-slot>

    {{ $url->url }}
    <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />

    <livewire:scripts />
    @livewireChartsScripts
</div>
