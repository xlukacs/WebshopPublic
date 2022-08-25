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
        <form action="/addAnswer" method="get">
            <input type="hidden" name="questionID" value="{{$questionID}}">
            <input type="submit" value="Add answer">
            {!! method_field('get') !!}
            {!! csrf_field() !!}
        </form>

        @foreach ($answers as $answer)    
            <form action="/saveAnswer" method="get">
                <input type="text" value="{{$answer->answer_text}}" name="answerText">
                <input type="hidden" name="answerID" value="{{$answer->id}}">
                <input type="submit" value="SAVE">
                
                {!! method_field('get') !!}
                {!! csrf_field() !!}
            </form>
        @endforeach
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

