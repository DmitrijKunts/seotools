<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        @foreach ($columns as $id => $column)
            @include('tablesorting.th', compact('id', 'column'))
        @endforeach
    </tr>
</thead>
