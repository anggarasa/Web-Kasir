<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body
    class="bg-neutral-100 dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900 flex items-center justify-center min-h-screen">
    <div
        class="bg-white dark:bg-stone-950 border dark:border-stone-800 flex flex-col md:flex-row shadow-lg rounded-lg overflow-hidden max-w-4xl w-full">
        <div class="md:w-1/2 p-8 flex items-center justify-center bg-gray-50 dark:bg-stone-950">
            <div>
                <img src="{{ asset('imgs/login/login.svg') }}"
                    alt="Illustration of a person interacting with a large mobile phone displaying messages"
                    class="w-full h-auto" height="400" width="400" />
            </div>
        </div>

        <div class="md:w-1/2 p-8">
            {{ $slot }}
        </div>
    </div>
    @fluxScripts
</body>

</html>