<x-app-layout>

    <x-slot name="title">{{ __('SEO Tools by codeLocker lab') }}</x-slot>
    <x-slot name="header">{{ __('SEO Tools by codeLocker lab') }}</x-slot>


    <div
        class="mx-auto max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="p-8 flex justify-center">
            {!! QrCode::size(300)->generate('https://t.me/SEOToolsmodernbot') !!}
        </div>
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                SEO Tools Modern bot
            </h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ __('All functions of the service in the Telegram bot') }}
            </p>
            <a target="_blank" href="https://t.me/SEOToolsmodernbot"
                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('Connect') }}
                <svg class="ml-2 -mr-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                        clip-rule="evenodd"></path>
                </svg>

            </a>
        </div>
    </div>

</x-app-layout>
