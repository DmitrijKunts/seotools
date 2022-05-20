<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="/favicon.png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @include('alternate')
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container px-5 py-12 mx-auto">
            {{ $slot }}
        </main>



        <footer class="p-4 bg-white shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 {{ __('SEO Tools by') }} <a
                    href="https://codelockerlab.com/" class="hover:underline" target="_blank">codeLocker lab</a>. All
                Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="{{ route('policy.show') }}"
                        class="mr-4 hover:underline md:mr-6">{{ __('Privacy Policy') }}</a>
                </li>
                <li>
                    <a href="{{ route('terms.show') }}"
                        class="mr-4 hover:underline md:mr-6">{{ __('Terms of Service') }}</a>
                </li>
                <li>
                    <a href="https://codelockerlab.com/contact" target="_blank"
                        class="hover:underline">{{ __('Contact') }}</a>
                </li>
            </ul>
        </footer>


    </div>

    @stack('modals')
    @livewireScripts
</body>

</html>
