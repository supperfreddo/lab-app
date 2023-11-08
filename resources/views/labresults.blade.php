@extends('main')

@section('content')
    <div
        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="text-center">
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Lab result(s)</h2>
            @foreach ($labResults as $labResult)
                {{ $labResult->code_decrypted }}
                @if ($labResult->result_decrypted)
                    Positive
                @else
                    Negative
                @endif
                <br>
            @endforeach
        </div>
    </div>
@endsection
