<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.title') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css'); }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css'); }}"> 
    
    <script src="{{ asset('js/app.js'); }}"></script>
</head>
<body>
    {{-- TOP NAVBAR --}}
    <x-header />

    <section class="container-lg">
        {{-- SEARCH ROW --}}
        @include('inc.searchRow')
    </section>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <section class="container-lg" id="orderList">
        {{-- Main content --}}
        <nav class="row" id="profileNav">
            @if ($subSite == "orders")
                <a href="{{ route('profile'); }}" class="col-sm-2 active">{{__('Orders')}}</a>
                <a href="{{ route('settings'); }}" class="col-sm-2">{{__('Settings')}}</a>
            @else
            <a href="{{ route('profile'); }}" class="col-sm-2">{{__('Orders')}}</a>
            <a href="{{ route('settings'); }}" class="col-sm-2 active">{{__('Settings')}}</a>
            @endif
        </nav>
        @if ($subSite == "orders")
            @include('profile.orders')
        @else
            @include('profile.settings')    
        @endif
        
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

