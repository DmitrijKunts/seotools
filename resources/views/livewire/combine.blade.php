<div>
    <x-slot name="title">{{ __('Combinator') }}</x-slot>
    <x-slot name="header">{{ __('Combinator') }}</x-slot>

    <form wire:submit.prevent="combine" class="flex flex-wrap">
        @foreach (range(1, $listCount) as $listIndex)
            <div class="w-full md:w-1/2 p-2">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                    {{ __('List #:n', ['n' => $listIndex]) }}
                </label>
                <textarea wire:model="list.{{ $listIndex }}" rows="10"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Type or paste the phrases one per line. Empty lines are ignored.') }}"></textarea>
            </div>
        @endforeach


        <button type="submit"
            class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('Combine') }}
        </button>
    </form>
    <div class="w-full p-2">
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
            {{ __('Reuslt') . ": $resultCount" }}
        </label>
        <textarea wire:model="result" rows="20"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="{{ __('Comming soon') }}"></textarea>
        <button x-data x-clipboard="$wire.result"
            class="disabled:opacity-50 disabled:cursor-not-allowed mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('Copy to Clipboard') }}
        </button>

    </div>
</div>
