@extends('main')

@section('content')
    <div
        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="text-center">
            @if(isset($successMessage))
                <div>
                    {{$successMessage}}
                </div>
            @endif

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Create a new lab results</h2>
            <form method="POST" action="{{route('storeLabResult')}}" id="labResultForm">
                @csrf
                <label for="result">Positve</label>
                <input type="checkbox" name="result" id="result">
                <br>
                <label for="code">Code</label>
                <input type="text" name="code" id="code" required maxlength="36"
                    class="outline rounded-lg focus:outline focus:outline-2 focus:outline-red-500">
                <br>
                <button type="submit" class="mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </button>
            </form>
            @if ($errors->hasBag('labresults'))
                @foreach ($errors->labresults->all() as $error)
                    <div class="text-red">{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        $(function() {
            $('#labResultForm').submit(function(e) {
                if (validateGuid($('#code').val()) === false)
                    e.preventDefault();
            });
        });
    </script>
@endsection
