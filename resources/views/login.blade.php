@extends('main')

@section('content')
    <div
        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="text-center">
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">I have a code</h2>
            <br>
            <input type="text" name="code" id="code"
                class="outline rounded-lg focus:outline focus:outline-2 focus:outline-red-500">
            <br>
            <button type="submit" class="mt-4" onclick="getLabResult()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                </svg>
            </button>
            @if ($errors->hasBag('labresults'))
                @foreach ($errors->labresults->all() as $error)
                    <div class="text-red">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>

    <div
        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="text-center">
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Login</h2>
            <br>
            <form method="POST" action="{{ route('loginPost') }}">
                @csrf
                <input type="email" name="username" id="username" maxlength="255" required
                    class="outline rounded-lg focus:outline focus:outline-2 focus:outline-red-500 mb-1">
                <br>
                <input type="password" maxlength="255" name="password" id="password" required
                    class="outline rounded-lg focus:outline focus:outline-2 focus:outline-red-500 mt-4">
                <br>
                <button type="submit" class="mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </button>
            </form>
            @if ($errors->hasBag('user'))
                @foreach ($errors->user->all() as $error)
                    <div class="text-red">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
