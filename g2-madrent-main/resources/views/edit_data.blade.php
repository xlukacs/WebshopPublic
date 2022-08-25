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
</head>
<body>
{{-- TOP NAVBAR --}}
@if((Auth::check()))
    @include('inc.topBar', ['showProfile' => 'true'])
@else
    @include('inc.topBar', ['showProfile' => 'false'])
@endif
<div class="container-md">
    {{-- SEARCH ROW --}}
    @include('inc.searchRow')
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{--            @if (session('status'))--}}
            {{--                <h6 class="alert alert-success">{{ session('status') }}</h6>--}}
            {{--            @endif--}}

            <div class="card">
                <div class="card-header">
                    <h4>{{__('Edit and Update')}}</h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('/profile/edit_data/'.$id = Auth::id()) }}" method="POST">
                        @csrf
{{--                        @method('PUT')--}}

                        <div class="form-group mb-3">
                            <label for="firstName" class="form-label no-margin">{{__('First name')}}</label>
                            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control">
                            @if ($errors->has('name'))
                                @foreach ($errors->get('name') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastName" class="form-label no-margin">{{__('Last name')}}</label>
                            <input type="text" name="lastName" value="{{Auth::user()->lastName}}" class="form-control">
                            @if ($errors->has('lastName'))
                                @foreach ($errors->get('lastName') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label no-margin">{{__('Telephone number')}}</label>
                            <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control">
                            @if ($errors->has('phone'))
                                @foreach ($errors->get('phone') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="state" class="form-label no-margin">{{__('State')}}</label>
                            <input type="text" name="state" value="{{Auth::user()->state}}" class="form-control">
                            @if ($errors->has('state'))
                                @foreach ($errors->get('state') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="city" class="form-label no-margin">{{__('City')}}</label>
                            <input type="text" name="city" value="{{Auth::user()->city}}" class="form-control">
                            @if ($errors->has('city'))
                                @foreach ($errors->get('city') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="aptNumber" class="form-label no-margin">{{__('Street, house number')}}</label>
                            <input type="text" name="aptNumber" value="{{Auth::user()->aptNumber}}"
                                   class="form-control">
                            @if ($errors->has('aptNumber'))
                                @foreach ($errors->get('aptNumber') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="postalCode" class="form-label no-margin">{{__('Postal code')}}</label>
                            <input type="text" name="postalCode" value="{{Auth::user()->postalCode}}"
                                   class="form-control">
                            @if ($errors->has('postalCode'))
                                @foreach ($errors->get('postalCode') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="Card number" class="form-label no-margin">{{__('Credit card number')}}</label>
                            <input type="text" name="cardNo" value="{{Auth::user()->cardNo}}" class="form-control">
                            @if ($errors->has('cardNo'))
                                @foreach ($errors->get('cardNo') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="Expiration date" class="form-label no-margin">{{__('Card expiration date')}}</label>
                            <input type="text" name="cardExp" value="{{Auth::user()->cardExp}}" class="form-control">
                            @if ($errors->has('cardExp'))
                                @foreach ($errors->get('cardExp') as $error)
                                    <span class="error_message">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-secondary">{{__('Update')}}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
