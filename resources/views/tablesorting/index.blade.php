<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    @include('tablesorting.header')
    <tbody>
        @foreach ($rows as $row)
            @include('tablesorting.row', compact('row'))
        @endforeach
    </tbody>
</table>
