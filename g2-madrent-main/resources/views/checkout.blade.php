<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.title') }} - Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css'); }}">
    <script type="text/javascript" src="{{ asset('js/app.js'); }}"></script>
    <script type="text/javascript" src="{{ asset('js/isempty.js'); }}"></script>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>
<body>
{{-- TOP NAVBAR --}}
@if((Auth::check()))
    @include('inc.topBar', ['showProfile' => 'true'])
@else
    @include('inc.topBar', ['showProfile' => 'false'])
@endif
<div class="container-lg">
    {{-- SEARCH ROW --}}
    @include('inc.searchRow')
</div>

{{-- MAIN content --}}

<div class="container">
    <div class="row">
        <section class="col-lg-8">
            <div class="main main-cart col-lg-12">

                <div class="row">
                    <label>{{__('Shopping cart')}}</label>
                </div>

                @foreach ((array) session('cart') as $item=>$details)
                    <article class="row productRow">
                        @php
                            $previewPicList = explode(",", $details['photo']);
                        @endphp
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            <img class="photo-product" src="/images/products/{{$previewPicList[0]}}"
                                 alt="Photo of product">
                        </div>

                        <div class="row col-xl-10 col-lg-10 col-md-10 col-sm-10">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label>{{$details['name']}}</label>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-5 col-md-4 col-sm-12">
                                <button type="button" class="btn btn-secondary col-sm-3 col-xs-12"
                                        onclick="window.location.href = '/cart/addToCart/{{$details['id']}}'">+
                                </button>
                                <button type="button" class="btn btn-secondary col-sm-3 col-xs-12"
                                        onclick="window.location.href = '/cart/removeFromCart/{{$details['id']}}'">-
                                </button>
                                <button type="button" class="btn btn-secondary col-md-5 col-sm-4 col-xs-12"
                                        onclick="window.location.href = '/cart/deleteFromCart/{{$details['id']}}'">{{__('delete')}}
                                </button>
                            </div>

                            <div class="col-xl-4 col-lg-3 col-md-4 col-sm-12 ">
                                <p>{{$details['quantity']}}</p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3">
                                <p>{{$details['price']}} €</p>
                            </div>

                        </div>

                    </article>
                @endforeach

                @if (!session('cart'))
                    {{__('Cart is empty.')}}
                @endif

            </div>


            <div class="main-contact  col-lg-12">
                <label class="fw-bold">{{__('Contact information')}}</label>

                <form id="validation" class="contact_form needs-validation" novalidate action="/edit/<?php echo $id = Auth::id(); ?>" method="post">
                    {{-- @method('PUT') --}}
                    {{-- <input type="hidden" name="_token" value="<?php //echo csrf_token(); ?>"> --}}
                    @csrf

                    @if((Auth::check()))
                        <div class="row justify-content-end">
                            <div class="col-3 col-xs-12 button_changes">
                                <a href="{{ url('/profile/edit_data/'.$id = Auth::id()) }}"
                                   class="btn btn-secondary col-12">{{__('Change')}}</a>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="firstName" class="form-label no-margin">{{__('First name')}}</label>
                            @if((Auth::check()))
                                <input type="text" name='name' class="form-control"
                                       aria-label="First name" disabled="disabled"
                                       value='<?php echo $name = Auth::user()->name; ?>'>

                            @else
                                <script>
                                    function OnInputChange(input, id_element) {
                                        const inputText = input.value
                                        document.getElementById(id_element).value = inputText;
                                    }
                                </script>
                                <input type="text" class="form-control" placeholder="{{__('First name')}}"
                                       aria-label="First name">
                            @endif

                        </div>

                        <div class="col-lg-6">
                            <label for="lastName" class="form-label no-margin">{{__('Last name')}}</label>
                            @if((Auth::check()))
                                <input type="text" id="last_name_input" class="form-control"
                                       aria-label="Last name" disabled="disabled"
                                       value='<?php echo $lastName = Auth::user()->lastName; ?>'>
                            @else
                                <input type="text" id="first_name_input" class="form-control"
                                       placeholder="{{__('Last name')}}"
                                       aria-label="Last name">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="email" class="form-label no-margin">{{__('Email')}}</label>
                            @if((Auth::check()))
                                <input type="email" class="form-control" disabled="disabled"
                                       id="exampleInputEmail1"
                                       value='<?php echo $email = Auth::user()->email; ?>'>
                            @else
                                <input type="email" class="form-control" placeholder="Email" id="exampleInputEmail1">
                            @endif
                        </div>

                        <div class="col-lg-6">
                            <label for="phone" class="form-label no-margin">{{__('Telephone number')}} (+421 000 000
                                000)</label>
                            @if((Auth::check()))
                                <input type="tel" id="phone_input" class="form-control" name="phone"
                                       placeholder="{{ Auth::user()->phone }}"
                                       disabled="disabled"
                                       name="phone_input"
                                       value='<?php echo $phone = Auth::user()->phone; ?>'>
                            @else
                                <input type="tel" id="phone_input" class="form-control"
                                       placeholder="{{__('Telephone number')}}"
                                       id="phone" name="phone"
                                       onchange="OnInputChange (this, 'input_phone')"
                                       required="required"
                                       pattern="\+[0-9]{3} [0-9]{3} [0-9]{3} [0-9]{3}"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your phone number')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <label class="fw-bold">{{__('Address')}}</label>
                    <div class="row">

                        <div class="col-lg-6">
                            <label for="state" class="form-label no-margin">{{__('State')}}</label>
                            @if((Auth::check()))
                                <input type="text" class="form-control"
                                       placeholder="{{ Auth::user()->state }}"
                                       aria-label="State" disabled="disabled"
                                       name="state_input"
                                       value='<?php echo $state = Auth::user()->state; ?>'>
                            @else
                                <input type="text" id="state_input" class="form-control" placeholder="{{__('State')}}"
                                       aria-label="State"
                                       onchange="OnInputChange (this, 'input_state')"
                                       required="required"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your state')}}
                                </span>
                            @endif
                        </div>

                        <div class="col-lg-6">
                            <label for="city" class="form-label no-margin">{{__('City')}}</label>
                            @if((Auth::check()))
                                <input type="text" class="form-control"
                                       placeholder="{{ Auth::user()->city }}"
                                       aria-label="City" disabled="disabled"
                                       name="city_input"
                                       value='<?php echo $city = Auth::user()->city; ?>'>
                            @else
                                <input type="text" id="city_input" class="form-control" placeholder="{{__('City')}}"
                                       aria-label="City"
                                       onchange="OnInputChange (this, 'input_city')"
                                       required="required"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your city')}}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <label for="aptNumber" class="form-label no-margin">{{__('Street, house number')}}</label>
                            @if((Auth::check()))
                                <input type="text" class="form-control"
                                       placeholder="{{ Auth::user()->aptNumber }}"
                                       aria-label="Apt Number" disabled="disabled"
                                       name="addr_input"
                                       value='<?php echo $aptNumber = Auth::user()->aptNumber; ?>'>
                            @else
                                <input id="addr_input" type="text" class="form-control"
                                       placeholder="{{__('Street, house number')}}"
                                       aria-label="Street, apt Number"
                                       onchange="OnInputChange (this, 'input_addr')"
                                       required="required"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your street, house number')}}
                                </span>
                            @endif
                        </div>

                        <div class="col-lg-6">
                            <label for="postalCode" class="form-label no-margin">{{__('Postal code')}} (123 45)</label>
                            @if((Auth::check()))
                                <input type="text" class="form-control"
                                       placeholder="{{ Auth::user()->postalCode }}"
                                       aria-label="postalCode" disabled="disabled"
                                       name="postal_code_input"
                                       value='<?php echo $postalCode = Auth::user()->postalCode; ?>'>
                            @else
                                <input type="text" id="postal_code_input" class="form-control"
                                       placeholder="{{__('Postal code')}}"
                                       aria-label="postalCode"
                                       onchange="OnInputChange (this, 'input_postalCode')"
                                       required="required"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your postal code')}}
                                </span>
                            @endif
                        </div>
                    </div>

                    <label class="fw-bold">{{__('Payment')}}</label>
                    <div>
                        <div class="form-check col-lg-6">
                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Cash
                            </label>
                        </div>
                        <div class="form-check col-lg-6">
                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                   checked>
                            <label for="flexRadioDefault2">
                                {{__('Credit Card')}}
                            </label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check col-lg-6">
                            <input type="radio" name="flexRadioDefault1"
                                   id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                                {{__('Courier')}}
                            </label>
                        </div>
                        <div class="form-check col-lg-6">
                            <input type="radio" name="flexRadioDefault1" id="flexRadioDefault4"
                                   checked>
                            <label class="form-check-label" for="flexRadioDefault4">{{__('Self-pickup')}}</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <label for="Card number" class="form-label no-margin">Card number</label>
                            @if((Auth::check()))
                                <input type="text" class="form-control"
                                       placeholder="{{ Auth::user()->cardNo }}"
                                       aria-label="Card number" disabled="disabled"
                                       name="card_no_input"
                                       value='<?php echo $cardNo = Auth::user()->cardNo; ?>'>
                            @else

                                <input type="text" id="card_no_input" class="form-control"
                                       placeholder="{{__('Credit card number')}}"
                                       aria-label="Card number"
                                       onchange="OnInputChange (this, 'input_cardNo')"
                                       required="required"
                                       pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your credit card number')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6  col-md-6">
                            <label for="Expiration date"
                                   class="form-label no-margin">{{__('Card expiration date')}} (12/22)</label>
                            @if((Auth::check()))
                                <input type="text" class="form-control"
                                       placeholder="{{ Auth::user()->cardExp }}"
                                       aria-label="Expiration date" disabled="disabled"
                                       name="card_exp_input"
                                       value='<?php echo $cardExp = Auth::user()->cardExp; ?>'>
                            @else
                                <input type="text" id="card_exp_input" class="form-control"
                                       placeholder="{{__('Card expiration date')}}"
                                       aria-label="Expiration date"
                                       onchange="OnInputChange (this, 'input_cardExp')"
                                       pattern="(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})"
                                       required="required"
                                >
                                <span class="invalid-feedback">
                                    {{__('Please enter your card expiration date')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-sm-4 col-xs-4">
                            <input type="text" class="form-control" placeholder="{{__('CVV code')}}"
                                   aria-label="CVV code"  pattern="[0-9]{3}"
                                   required="required"
                            >
                            <span class="invalid-feedback">
                                    {{__('Please enter your CVV code')}}
                                </span>
                        </div>
                    </div>
                    @if(!(Auth::check()))
                        <div class="row justify-content-end">
                            <div class="col-3 col-xs-12 button_changes">
                                <input type="submit" value="{{__('Validate')}}" class="btn btn-secondary col-12">
                            </div>
                        </div>
                    @endif

                </form>

            </div>
        </section>

        <form class="sum-el col-md-12 col-lg-4 col-xl-4 col-sm-12 order-sm-last"
              action="{{ route('saveOrder') }}" method="post">
            @csrf
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h4 class="my-0">{{__('Total')}}</h4>
                    </div>

                    @php
                        $total_items = 0;
                        $total_delivery = 0;
                        $total = 0
                    @endphp

                    @foreach((array) session('cart') as $id => $details)
                        @php
                            $total_items += $details['price'] * $details['quantity'];
                            $total_delivery += ($details['price'] * $details['quantity']) * 0.02
                        @endphp
                    @endforeach

                    @php
                        $total_items =  round($total_items,2);
                        $total_delivery = round($total_delivery,2);
                        $total = $total_items + $total_delivery
                    @endphp

                    <input type="text" disabled class="text-muted displayInput" value="{{ $total }}€">
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">{{__('Items')}}</h6>
                    </div>
                    <input type="text" disabled class="text-muted displayInput" value="{{ $total_items }}€">
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">{{__('Delivery')}}</h6>
                    </div>
                    <input type="text" disabled class="text-muted displayInput" value="{{ $total_delivery }}€">
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="">{{__('Delivery information')}}</h6>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>

                        <h6 class="">{{__('Phone number')}}</h6>
                        @if((Auth::check()))
                            <span class="text-muted">{{ Auth::user()->phone }}</span>
                        @endif
                        <input id="input_phone" type="text" disabled class="text-muted displayInput">
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="">{{__('Address')}}</h6>
                        @if((Auth::check()))
                            <span class="text-muted">{{ Auth::user()->state}}</span>
                            <span class="text-muted">{{ Auth::user()->city}}</span>
                            <span class="text-muted">{{ Auth::user()->aptNumber}}</span>
                            <span class="text-muted">{{ Auth::user()->postalCode}}</span>
                        @endif
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div class="justify-content-between">
                        <input id="input_state" type="text" disabled class="text-muted displayInput">
                        <input id="input_city" type="text" disabled class="text-muted displayInput">
                        <input id="input_addr" type="text" disabled class="text-muted displayInput">
                        <input id="input_postalCode" type="text" disabled class="text-muted displayInput">
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="">{{__('Expected receive date')}}</h6>
                        <?php
                        $Date = date("Y-m-d");
                        $NewDate = date('Y-m-d', strtotime($Date . ' + 5 days'));
                        ?>
                        <input type="text" disabled class="text-muted displayInput" value="{{ $NewDate }}">
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="">{{__('Payment')}}</h6>
                    </div>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>

                        <h6 class="">{{__('Card datails')}}</h6>
                        @if((Auth::check()))
                            <span class="text-muted">{{ Auth::user()->cardNo}}</span>
                            <span class="text-muted">{{ Auth::user()->cardExp}}</span>
                        @endif
                        <input id="input_cardNo" type="text" disabled class="text-muted displayInput">
                        <input id="input_cardExp" type="text" disabled class="text-muted displayInput">
                    </div>
                </li>
            </ul>

            <div class="row justify-content-center">
                <input type="hidden" name="totalPrice" value="{{ $total }}">
                @php
                    $productList = "";
                    $round = 0;
                    foreach ((array) session('cart') as $item=>$details){
                        $productList = $productList.$details['id'].":".$details['quantity'];
                        if(count((array) session('cart')) != ++$round)
                            $productList = $productList.',';
                    }

                @endphp

                <input type="hidden" name="products" value="{{ $productList }}">
                <input type="submit" id="submit" value="{{__('Order')}}" class="btn btn-secondary col-xl-10">

                @if (!empty($validation_errors))

                    <div class="row justify-content-center alert-danger col-xl-10 alert_cart" role="alert">
                        {{__('Required')}} :
                        @foreach ($validation_errors as $value)
                            <p>{{__($value)}}</p>
                        @endforeach
                    </div>
                @endif

                @if (!empty($cart_is_empty) and  $cart_is_empty==1)
                    <div class=" row col-xl-10 justify-content-center alert-danger col-xl-10" >
                        {{__('Cart is empty.')}}
                    </div>
                @endif

                {{-- <a href="{{ route('saveOrder') }}"
                   class="btn btn-secondary col-xl-10">{{__('Order')}}</a> --}}
                {{--                                <p><?php echo $qwerty; ?></p>--}}
            </div>

        </form>
    </div>
</div>

{{-- Footer --}}
@include('inc.footer')
</body>
</html>
