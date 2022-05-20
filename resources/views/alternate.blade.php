@foreach (config('app.available_locales') as $ln)
    <link rel="alternate" hreflang="{{ $ln }}"
        href="{{ route(Route::currentRouteName(),array_merge(request()->route()->parameters(),['lang' => $ln])) }}" />
@endforeach
