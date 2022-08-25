<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>{{ config('app.title') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css'); }}">
    <script type="text/javascript" src="{{ asset('js/app.js'); }}"></script>
    <style>
        .table th, .table td {
            border-top: unset;
        }
    </style>
</head>
<body>
{{-- TOP NAVBAR --}}
<x-header/>

<div class="container-lg">
    {{-- SEARCH ROW --}}
    @include('inc.searchRow')

    {{-- MAIN navbar --}}
    <x-main-nav-bar :activeTabID="$categoryName"/>
</div>

{{-- MAIN content --}}
<div class="container">
    <section class="row justify-content-lg-center main_info">
        <article class=" col-md-12 col-lg-5 main_carousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators ">
                    @php
                        //echo $productData->pictures;
                        $imageList = explode(",", $productData->pictures);
                        $counter = 0;
                    @endphp
                    @foreach ($imageList as $image)
                        @if ($counter == 0)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                        @else
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{$counter}}"
                                    aria-label="Slide {{$counter+1}}"></button>
                        @endif
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @php
                        //echo $productData->pictures;
                        $imageList = explode(",", $productData->pictures);
                        $counter = 0;
                    @endphp
                    @foreach ($imageList as $image)
                        @if ($counter++ == 0)
                            <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                                        @endif
                                        <img src="/images/products{{$image}}" class="d-block w-100"
                                             alt="{{$productData->name}}">
                                    </div>
                                    @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{__('Previous')}}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{__('Next')}}</span>
                            </button>
                </div>
        </article>

        <article class="col-lg-4 col-md-12 justify-content-lg-center">

            <h4 class="product_section">{{$productData->name}}</h4>

            <div class="row">
                <div class="col-6 col-md-6 product_section">
                    <h5>{{__('Price')}}</h5>
                </div>
                <div class="col-6 col-md-6 product_section">
                    <h5>{{$productData->price}} €</h5>
                </div>
            </div>
            <div class="row">
                <div class="product_section col-12 col-lg-12 col-sm-12">
                    <button class="btn btn-secondary col-12" type="button"
                            onclick="window.location.href = '/cart/addToCart/{{$productData->id}}'">
                        {{__('ADD TO MY CART')}}
                    </button>
                </div>
            </div>
        </article>
    </section>

    <div class="description col-xs-12 col-sm-12">
        <h4>{{__('Product description')}}</h4>
        <div class="description  ">
            <p>{{__($productData->description)}}</p>
        </div>
    </div>
</div>

{{-- Footer --}}
@include('inc.footer')
</body>
</html>
