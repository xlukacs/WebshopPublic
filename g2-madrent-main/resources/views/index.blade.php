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
    {{-- <x-cookie-consent :showPopup="$showPopup"/> --}}
    <section id="anketaWrapper">
        <p>Question</p>
        <form action="{{ url('/submitVote') }}" method="post">
            <ul>
                <li>
                    <input type="radio" name="option" id="option1">
                    <label for="option1">Option1</label>
                </li>
                <li>
                    <input type="radio" name="option" id="option2">
                    <label for="option2">Option2</label>
                </li>
                <li>
                    <input type="radio" name="option" id="option3">
                    <label for="option3">Option3</label>
                </li>
            </ul>
            @if ($popupState == "allow")
                <input class="btn btn-default" type="submit" value="Submit">
            @endif
            @if ($popupState == "block")
                <span>You have allready voted for this question.</span>
            @endif
            @if ($popupState == "refuse")
                <span>You have to log in to be able to vote.</span>
            @endif

            {!! method_field('put') !!}
            {!! csrf_field() !!}
        </form>
    </section>


   {{-- TOP NAVBAR --}}
   <x-header />

    <section class="container-lg">
        {{-- SEARCH ROW --}}
        @include('inc.searchRow')

        {{-- MAIN navbar --}}
        <x-main-nav-bar :activeTabID="$categoryName" />

        {{-- Main section --}}
        <div class="row">
            {{-- MAIN CHANGING CONTENT --}}
            <section class="col no-padding-horizontal">
                <!-- STARTOF Slideshow -->
                <article id="hotItemCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#hotItemCarousel" data-slide-to="0" class="active"><a href="#">RTX 3090 FE</a></li>
                        <li data-target="#hotItemCarousel" data-slide-to="1" class=""><a href="#">RTX 2080TI FE</a></li>
                        <li data-target="#hotItemCarousel" data-slide-to="2" class=""><a href="#">RX 6600XT</a></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active" onclick="window.location.href = '/product/1'">
                            <div class="d-block" data-slide-type="carousel" style="background-image: url('/images/products/GPUs/3090FE.jpg');" alt="RTX 3090 Founders Edition" data-holder-rendered="true"></div>
                            <div class="carousel-caption d-none d-sm-block">
                                <h5>RTX 3090Fe</h5>
                                <p>The powerhouse GPU</p>
                            </div>
                        </div>
                        <div class="carousel-item" onclick="window.location.href = '/product/6'">
                            <div class="d-block" data-slide-type="carousel" style="background-image: url('/images/products/GPUs/2080tiFE.jpg');" alt="RTX 2080TI Founders Edition" data-holder-rendered="true"></div>
                            <div class="carousel-caption d-none d-sm-block">
                                <h5>RTX 2080ti FE</h5>
                                <p>The OLDy but GOODy</p>
                            </div>
                        </div>
                        <div class="carousel-item" onclick="window.location.href = '/product/5'">
                            <div class="d-block" data-slide-type="carousel" style="background-image: url('/images/products/GPUs/hellhoundRX6600xt.png');" alt="RX 6600XT" data-holder-rendered="true"></div>
                            <div class="carousel-caption d-none d-sm-block">
                                <h5>RX 6600xt</h5>
                                <p>The competitors answer</p>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- ENDOF Slideshow -->
                
                <!-- STARTOF HotIremRows -->
                <article class="row displayRows">
                    <h3>{{__('Hot products')}}</h3>
                    @include('displays.rowDisplay.wrapper')
                    @include('displays.rowDisplay.wrapper')
                    @include('displays.rowDisplay.wrapper')
                    <!-- ENDOF HotIremRows -->
                </article>
            </section>
        </div>
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

