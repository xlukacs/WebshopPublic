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
</head>
<body>
    {{-- TOP NAVBAR --}}
    <x-header />

    <div class="container-md">
         {{-- SEARCH ROW --}}
         @include('inc.searchRow')

         {{-- MAIN navbar --}}
         <x-main-nav-bar :activeTabID="$categoryName" />
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
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$counter}}"
                                aria-label="Slide {{$counter+1}}"></button>
                            @endif
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @php
                            $imageList = explode(",", $productData->pictures);    
                            $counter = 0;
                        @endphp
                        @foreach ($imageList as $image)
                            @if ($counter++ == 0)
                                <div class="carousel-item active">
                            @else    
                                <div class="carousel-item">
                            @endif
                                <img src="/images/products/{{$image}}" class="d-block w-100" alt="{{$productData->name}}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </article>

            <article class="col-lg-4 col-md-12 justify-content-lg-center">

                <h4 class="product_section">Product name</h4>

                <div class="row">
                    <div class="dropdown product_section col-12 col-lg-8 col-sm-12">
                        <button class="btn btn-secondary dropdown-toggle dropdown_button col-12" type="button"
                                id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Choose your capacity
                        </button>

                        <ul class="dropdown-menu col-11" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">32 GB</a></li>
                            <li><a class="dropdown-item" href="#">64 GB</a></li>
                            <li><a class="dropdown-item" href="#">128 GB</a></li>
                            <li><a class="dropdown-item" href="#">256 GB</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="dropdown product_section col-12 col-lg-8 col-sm-12">
                        <button class="btn btn-secondary dropdown-toggle dropdown_button col-12" type="button"
                                id="dropdownMenuButton2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Choose your color
                        </button>
                        <ul class="dropdown-menu col-11" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Gray</a></li>
                            <li><a class="dropdown-item" href="#">Black</a></li>
                            <li><a class="dropdown-item" href="#">White</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 col-md-6 product_section">
                        <h5>Price</h5>
                    </div>
                    <div class="col-6 col-md-6 product_section">
                        <h5>0,00 €</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="product_section col-12 col-lg-12 col-sm-12">
                        <button class="btn btn-secondary col-12" type="button" onclick="window.location.href = '/addToCart/{{$productData->id}}'">
                            ADD TO MY CART
                        </button>
                    </div>
                </div>


            </article>

            <div class="row justify-content-lg-start justify-content-sm-center col-11 col-lg-10 col-md-11 col-sm-11 button_prod">
                <div class="col-12 col-lg-3 col-md-6 col-sm-12 btn-group" role="group" aria-label="">
                    <a href="/product/{{$productData->id}}" class="btn btn-secondary">Specifications</a>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12 btn-group" role="group" aria-label="">
                    <a href="/product/{{$productData->id}}/reviews" class="btn btn-secondary">Reviews</a>

                </div>
            </div>
        </section>

        <section class="row justify-content-center">

            <div class="row justify-content-md-end justify-content-sm-center col-10">
                <div class="dropdown product_section col-12 col-md-3 col-sm-8">
                    <button class="btn btn-secondary dropdown-toggle dropdown_button col-12" type="button"
                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by
                    </button>

                    <ul class="dropdown-menu col-11" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Top reviews</a></li>
                        <li><a class="dropdown-item" href="#">New reviews</a></li>
                        <li><a class="dropdown-item" href="#">Old reviews</a></li>
                    </ul>
                </div>
            </div>

            <article class="col-10 card">
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-2 profile_photo">
                        <span class=""> <img src="/res/img/profile_photo.jpg" alt="user"></span>
                    </div>
                    <div class="col-10 col-xs-5">
                        <h6>Nickname</h6>
                        <div class="">
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                        </div>
                        <div>
                            <span class="date">March 21, 2019</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <p class="">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                            interested.
                            Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also
                            reproduced in their
                            exact original form, accompanied by English versions from the 1914 translation by H.
                            Rackham.</p>
                    </div>
                </div>
            </article>

            <article class="col-10 card">
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-2 profile_photo">
                        <span class=""> <img src="/res/img/profile_photo.jpg" alt="profile_photo"></span>
                    </div>
                    <div class="col-10 col-xs-5">
                        <h6>Nickname</h6>
                        <div class="">
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div>
                            <span class="date">March 21, 2019</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <p class="">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                            interested.
                            Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also
                            reproduced in their
                            exact original form, accompanied by English versions from the 1914 translation by H.
                            Rackham.</p>
                    </div>
                </div>
            </article>

            <article class="col-10 card">
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-2 profile_photo">
                        <span class=""> <img src="/res/img/profile_photo.jpg" alt="profile_photo"></span>
                    </div>
                    <div class="col-10 col-xs-5">
                        <h6>Nickname</h6>
                        <div class="">
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div>
                            <span class="date">March 21, 2019</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <p class="example">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                            interested.
                            Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also
                            reproduced in their
                            exact original form, accompanied by English versions from the 1914 translation by H.
                            Rackham.</p>
                    </div>
                </div>
            </article>

            <article class="col-10 card">

                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-2 profile_photo">
                        <span class=""> <img src="/res/img/profile_photo.jpg" alt="profile_photo"></span>
                    </div>
                    <div class="col-10 col-xs-5">
                        <h6>Nickname</h6>
                        <div class="">
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 new_comm">

                        <div class="row col-12">
                            <textarea class="comm_section" placeholder="Your text"></textarea>
                        </div>

                        <div class="row col-4 col-md-3">
                            <div class="form-check comm_section">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    anonymously
                                </label>
                            </div>
                        </div>

                        <div class="row justify-content-end comm_section">
                            <button type="button" class="btn btn-secondary col-2">Send</button>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </div>
    
    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>
