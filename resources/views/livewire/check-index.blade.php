<div>
    <x-slot name="title">{{ __('Google Bulk Check Index') }}</x-slot>
    <x-slot name="header">{{ __('Google Bulk Check Index') }}</x-slot>



    <form wire:submit.prevent="startCheck">
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800"
            role="alert">
            <span class="font-medium">{{ __('Indexing Check Limits') }}:</span>
            {{ __('for a guest 30 urls per day, and for a registered user 100.') }}
            {{-- <span class="font-medium">Ограничения проверки индексации:</span> для гостя 30 адресов в день, а для
            зарегистрированного пользователя 100. --}}
        </div>


        @if ($errorText)
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                role="alert">
                <span class="font-medium">{{ __('Error!') }}</span> {{ $errorText }}
            </div>
        @endif

        <textarea wire:model="urls" rows="10" {{ $crawlUrls ? 'disabled' : '' }}
            class="disabled:opacity-50 disabled:cursor-not-allowed block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="{{ __('Urls one per line') }}"></textarea>


        <button type="submit" {{ $crawlUrls ? 'disabled' : '' }}
            class="disabled:opacity-50 disabled:cursor-not-allowed mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('Check') }}
        </button>
    </form>

    @if ($crawlUrls)
        <div wire:poll.1000ms.keep-alive="checking">
            <div class="flex justify-between mb-1">
                <span class="text-base font-medium text-blue-700 dark:text-white">{{ $progressMsg }}</span>
                <span class="text-sm font-medium text-blue-700 dark:text-white">{{ $progressPos }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progressPos }}%"></div>
            </div>
        </div>
    @endif

    @if (count($urlsChecked) > 0)

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Indexed
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($urlsChecked as $url => $val)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $loop->iteration }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <a target="_blank" href="//{{ $url }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    {{ $url }}
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                <a target="_blank" href="https://google.com/search?q=site:{{ $url }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    {{ number_format($val, thousands_separator: ' ') }}
                                </a>
                            </td>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <button x-clipboard.raw="{!! $urlsCheckedRaw !!}"
            class="disabled:opacity-50 disabled:cursor-not-allowed mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('Copy to Clipboard') }}
        </button>
    @endif



</div>
