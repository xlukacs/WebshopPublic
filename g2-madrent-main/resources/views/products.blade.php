<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.title') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css'); }}">
    <link rel="stylesheet" href="{{ asset('css/index.css'); }}"> 
    <link rel="stylesheet" href="{{ asset('css/products.css'); }}"> 
    
    <script src="{{ asset('js/app.js'); }}"></script>
</head>
<body>
    {{-- TOP NAVBAR --}}
    <x-header />

    <div class="container-lg">
        {{-- SEARCH ROW --}}
        @include('inc.searchRow')

        {{-- MAIN navbar --}}
        <x-main-nav-bar :activeTabID="$categoryName" />
                
        {{-- Main section --}}
        <section class="row">
            {{-- {{URL::current()}}/products --}}
            @if (strpos(URL::current(),"/products") > 0)
                <form class="col-lg-2 bg-dark text-light filters no-padding-horizontal text-center" action="{{URL::current()}}" method="GET" id="priceFilterForm">
            @else
                <form class="col-lg-2 bg-dark text-light filters no-padding-horizontal text-center" action="{{URL::current()}}/products" method="GET" id="priceFilterForm">    
            @endif
                @csrf
                {{-- Values to reconstruct the URL even if we change a filter --}}
                <input type="hidden" name="searchVal" value="{{$searchData['searchQuery']}}">
                <input type="hidden" name="minPrice" value="{{$searchData['minPrice']}}">
                <input type="hidden" name="maxPrice" value="{{$searchData['maxPrice']}}">
                <input type="hidden" name="orderVal" value="{{$searchData['order']}}">
                <input type="hidden" name="memVal" value="{{$searchData['memVal']}}">
                <input type="hidden" id="brandList" name="brandVal" value="{{$searchData['brandVal']}}">

                <article class="filterRow filterSelector text-light">
                    <p class="h5">{{__('Manufacturer')}}</p>
                    <div class="filterSelectors">
                        @foreach ($brandList as $brand)
                             <div class="form-check">
                                @if (strpos($searchData['brandVal'], $brand->brand) != "")
                                    <input class="form-check-input" type="checkbox" checked value="{{$brand->brand}}" id="{{$brand->brand}}" name="brand[]">
                                @else
                                    <input class="form-check-input" type="checkbox" value="{{$brand->brand}}" id="{{$brand->brand}}" name="brand[]">    
                                @endif
                                <label class="form-check-label" for="{{$brand->brand}}">
                                    {{$brand->brand}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </article>
                @if ($categoryName == "GPUs")
                    <article class="filterRow filterSelector text-light">
                        <p class="h5">{{__('Video Memory')}}</p>
                        <select class="form-select form-select-lg color-selector" name="VMsize" aria-label=".form-select-lg example">
                            <option>VM size...</option>
                            @if ($searchData['memVal'] == 8)
                            <option id="colorRed" value="8" selected>>8GB</option>
                            @else
                            <option id="colorRed" value="8">>8GB</option>
                            @endif
                            @if ($searchData['memVal'] == 12)
                            <option id="colorRed" value="12" selected>>12GB</option>
                            @else
                            <option id="colorRed" value="12">>12GB</option>
                            @endif
                            @if ($searchData['memVal'] == 24)
                            <option id="colorRed" value="24" selected>>24GB</option>
                            @else
                            <option id="colorRed" value="24">>24GB</option>
                            @endif
                        </select>
                    </article>
                @endif
                <article class="filterRow filterSelector moneyFilterSelector text-light">
                    <p class="h5">{{__('Cost filter')}}</p>
                    {{-- FROM https://codepen.io/ChrisSargent/pen/meMMye --}}
                    
                    <span class="multi-range">
                        <input type="range" min="{{floor($minProductValue[0]->price)}}" max="{{ceil($maxProductValue[0]->price)}}" value="{{round($searchData['minPrice'])}}" id="lowerMoneyFilterRange">
                        <input type="range" min="{{floor($minProductValue[0]->price)}}" max="{{ceil($maxProductValue[0]->price)}}" value="{{round($searchData['maxPrice'])}}" id="upperMoneyFilterRange">
                    </span>
                    <div class="boundWrapper d-flex justify-content-center">
                        <input type="text" name="lowerBound" id="lowerMoneyBound" value="{{floor($searchData['minPrice'])}}">
                        <input type="text" name="upperBound" id="upperMoneyBound" value="{{ceil($searchData['maxPrice'])}}">
                    </div>
                    
                    <input type="submit" name="filterSelectors" value="{{__('Apply')}}">
                </article>
            </form>
            {{-- MAIN CHANGING CONTENT --}}
            <section class="col-lg-10 productList">
                <div class="row additionalDataForList">
                    @if (strpos(URL::current(),"/products") > 0)
                        <form action="{{URL::current()}}" method="GET" id="additionalFilterForm">
                    @else
                        <form action="{{URL::current()}}/products" method="GET" id="additionalFilterForm">
                    @endif
                        @csrf
                        {{-- Values to reconstruct the URL even if we change a filter --}}
                        <input type="hidden" name="searchVal" value="{{$searchData['searchQuery']}}">
                        <input type="hidden" name="minPrice" value="{{$searchData['minPrice']}}">
                        <input type="hidden" name="maxPrice" value="{{$searchData['maxPrice']}}">
                        <input type="hidden" name="orderVal" value="{{$searchData['order']}}">
                        <input type="hidden" name="memVal" value="{{$searchData['memVal']}}">
                        <input type="hidden" name="brandVal" value="{{$searchData['brandVal']}}">
                        {{-- <input type="hidden" name="brandVal" value="{{$searchData['brandVal']}}"> --}}

                        <label for="additionalFilter">{{__('Order by')}}: </label>
                        <select name="additionalFilter">
                            <option value="ASC" {{ $searchData['order'] == 'ASC' ? 'selected' : '' }}>{{__('Ascending')}}</option>
                            <option value="DESC" {{ $searchData['order'] == 'DESC' ? 'selected' : '' }}>{{__('Descending')}}</option>
                        </select>
                        <input type="submit" name="additionalFiltersApply" value="{{__('Apply')}}">
                    </form>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                    @foreach ($productList as $item)
                        @php
                            $imageList = explode(",", $item->pictures);
                        @endphp
                        
                        @include('displays.productDisplay.product', ['stars' => 2, 'favourite' => 'false', 'name' => $item->name, 'description' => $item->description, 'price' => $item->price, 'img' => $imageList[0], 'itemID' => $item->id]) 
                    @endforeach
                </div>
                {!! $productList->withQueryString()->links() !!}
            </section>
        </section>
    </div>
    
    {{-- Footer --}}
    @include('inc.footer')
        
    <script src="{{ asset('js/custom.js'); }}"></script>
</body>
</html>

