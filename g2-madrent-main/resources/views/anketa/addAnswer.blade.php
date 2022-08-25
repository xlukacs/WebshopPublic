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
        <form action="/addAnswerToPool" method="post">
            <input type="text" name="newAnswerName">
            <input type="submit" value="Add to pool">
            <input type="hidden" name="questionID" value="{{$questionID}}">

            {!! method_field('get') !!}
            {!! csrf_field() !!}
        </form>
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

