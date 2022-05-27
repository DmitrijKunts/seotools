<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    @foreach ($row as $id => $td)
        @include('tablesorting.td', ['td' => $this->format($row, $id)])
    @endforeach
</tr>
