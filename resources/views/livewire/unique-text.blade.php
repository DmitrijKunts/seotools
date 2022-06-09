<div>
    <x-slot name="title">{{ __('Text uniqueizer') }}</x-slot>
    <x-slot name="header">{{ __('Text uniqueizer') }}</x-slot>



    <form wire:submit.prevent="process">

        @error('ln')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
        <label for="underline_select" class="sr-only">{{ __('Choose a language') }}</label>
        <select wire:model="ln" id="underline_select"
            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            <option>{{ __('Choose a language') }}</option>
            <option selected="" value="ru">{{ __('Russian') }}</option>
            <option value="en">{{ __('English') }}</option>
        </select>


        @error('input')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">{{ $message }}</span>
            </div>
        @enderror
        <textarea wire:model="input" rows="6" maxlength="4900"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="{{ __('Enter the text to be uniqueized.') }}"></textarea>


        <button type="submit"
            class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('Process') }}
        </button>

        <textarea wire:model="result" rows="6"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="{{ __('Result') }}"></textarea>
        <button x-data x-clipboard="$wire.result"
            class="disabled:opacity-50 disabled:cursor-not-allowed mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{ __('Copy to Clipboard') }}
        </button>
    </form>




</div>
