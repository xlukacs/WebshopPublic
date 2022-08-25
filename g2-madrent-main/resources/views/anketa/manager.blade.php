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
        {{-- TODO change this to a simple <A> --}}
        <form action="/addQuestion" method="get">
            <input type="submit" value="Add Survey">
        </form>
        <section>
            @if ($anketaList != "")
                <ul id="anketaItems">
                    @foreach ($anketaList as $anketa)
                        <li>
                            <div class="questionText">
                                {{ $anketa->question_text }}
                            </div>
                            <div class="questionControls">
                                <form action="/patchQuestion" method="post">
                                    <input type="hidden" name="questionID" value="{{ $anketa->id }}">
                                    <input type="submit" value="Edit">
                                    {!! method_field('get') !!}
                                    {!! csrf_field() !!}
                                </form>
                                <form action="/deleteQuestion" method="post">
                                    <input type="hidden" name="questionID" value="{{ $anketa->id }}">
                                    <input type="submit" value="Delete">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                </form>
                                <form action="/showQuestionResult" method="post">
                                    <input type="hidden" name="questionID" value="{{ $anketa->id }}">
                                    <input type="submit" value="Results">
                                    {!! method_field('get') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

