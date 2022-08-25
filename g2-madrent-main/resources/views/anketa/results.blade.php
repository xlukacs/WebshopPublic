<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.title') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css'); }}">
    <link rel="stylesheet" href="{{ asset('css/index.css'); }}"> 
    <link rel="stylesheet" href="{{ asset('css/components.css'); }}"> 
    
    <script type="text/javascript" src="{{ asset('js/app.js'); }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js'); }}"></script>
</head>
<body>
   {{-- TOP NAVBAR --}}
   <x-header />

    <section class="container-lg specialHeight">
        <ul>
            @foreach ($answers as $answer)
                <li>{{$answer->answer_text}} - votes: 0</li>
            @endforeach
        </ul>
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

