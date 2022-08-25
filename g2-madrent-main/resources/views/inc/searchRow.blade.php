<div class="row searchRow">
    <div class="col-sm-12 col-lg-3 text-center logoWrapper" onclick="window.location.href='/'">
        <img src="/images/logo.png" alt="Placeholder for Logo">
    </div>
    <div class="col-sm-12 col-lg-9 d-flex justify-content-end align-items-center searchAndCart">
        {{-- TODO remove onclick from button --}}
        {{-- {{ route('products'); }} --}}
        <form action="/products" method="get">
            <input type="text" name="searchInput" placeholder="{{__('Search by tiping here...')}}">
            <input type="submit" name="searchInputButton" value="Search">
            {{-- onclick="window.location.href = '/products';" --}}
        </form>
            <div class="cart" onclick="window.location.href = '/cart/checkout';">
            @if (session('cart'))
                @php
                    $count = 0;
                @endphp
                @foreach (session('cart') as $cartItem)
                    @php
                        $count++;
                    @endphp
                @endforeach
                <span class="itemsInCartCounter">{{$count}}</span>
            @endif
        </div>
    </div>
</div>
