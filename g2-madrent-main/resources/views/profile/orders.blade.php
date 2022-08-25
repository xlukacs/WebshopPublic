@if (count($orderProductList) > 0)   
    @foreach ($orderProductList as $order)
    <article class="row order">
        @php
                $nthOrder= 0;
                @endphp
            @foreach ($order as $orderProductList)
            <div class="orderItem">
                <div style="background-image: url('/images/products/{{$orderProductList['picture']}}')" alt="Placeholder image" class="col-md-2 orderPic"></div>
                <div class="col-md-10">
                    <h3>{{$orderProductList['name']}}</h3>
                    <p>Quantity: {{$orderProductList['quantity']}}</p>
                    <p>{{$orderProductList['price']}}€</p>
                    @if ($nthOrder++ == count($order) - 1)
                    <span>{{$orderProductList['ordered_at']}}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </article>
    @endforeach        
@else
    <p class="prompt">{{__('You dont have any active orders.')}}</p>
    <div class="emptySpace"></div>
@endif