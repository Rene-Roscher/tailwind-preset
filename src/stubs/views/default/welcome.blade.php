<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name') }}</title>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    </head>
    <body class="font-sans font-normal roman text-base tracking-normal leading-normal bg-white text-grey-darker antialiased">
        <div class="min-h-full h-full w-full flex flex-col items-center justify-center">
            <div class="font-light text-5xl mb-6">{{ config('app.name') }}</div>

            <ul class="list-reset flex flex-col sm:flex-row items-center -mb-4 sm:-mr-6">
                <li class="mb-4 sm:mr-6"><a class="text-blue-dark no-underline hover:underline" href="https://laravel.com/docs">Documentation</a></li>
                <li class="mb-4 sm:mr-6"><a class="text-blue-dark no-underline hover:underline" href="https://laracasts.com">Laracasts</a></li>
                <li class="mb-4 sm:mr-6"><a class="text-blue-dark no-underline hover:underline" href="https://laravel-news.com">News</a></li>
                <li class="mb-4 sm:mr-6"><a class="text-blue-dark no-underline hover:underline" href="https://forge.laravel.com">Forge</a></li>
                <li class="mb-4 sm:mr-6"><a class="text-blue-dark no-underline hover:underline" href="https://github.com/laravel/laravel">GitHub</a></li>
            </ul>
        </div>
    </body>
</html>