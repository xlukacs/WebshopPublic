<article class="col mb-4">
    <div class="card h-100">
        <div class="card-header bg-transparent">
            <div class="card-image" style="background-image: url(/images/products/{{$img}})"></div>
        </div>
        <div class="card-body">
            <div class="rating">
                @for ($i = 0; $i < $stars; $i++)
                    <div class="star selected"></div>
                @endfor
                @for ($i = 5 - $stars; $i > 0; $i--)
                    <div class="star"></div>
                @endfor
            </div>
            @if ($favourite == 'false')
                <div class="favouriteButton"></div>
            @else
                <div class="favouriteButton favourited"></div>
            @endif
            <a href="{{ route('product', ['productID' => $itemID]); }}" class="card-title underlineOnHover">{{$name}}</a>
            <p class="card-text">{{__($description)}}</p>
        </div>
        <div class="card-footer priceAndBuy">
            <span>{{$price}}</span>
            <button button-for="{{$itemID}}" onclick="window.location.href = '/addToCart/{{$itemID}}'"></button>
        </div>
    </div>
</article>
