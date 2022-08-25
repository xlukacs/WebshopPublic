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
<x-header />
<div class="container-md">
    {{-- SEARCH ROW --}}
    @include('inc.searchRow')
</div>
</body>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <section class="invoice">
                <div class="row mb-4">
                    <div class="col-6">
                        <h2 class="page-header"><i class="fa fa-globe"></i> {{ $order->id }}</h2>
                    </div>
                    <div class="col-6">
                        <h5 class="text-right">Date: {{ $order->created_at->toFormattedDateString() }}</h5>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-4">
                        <address><strong>{{ $order->user_id->name, $order->user_id->lastName }}</strong><br>Email: {{ $order->user_id->email }}</address>
                    </div>
                    <div class="col-4">Ship To
                        <address><strong>{{ $order->user_id->name }} {{ $order->user_id->last_name }}</strong><br>{{ $order->user_id->aptNumber }}<br>{{ $order->user_id->city }}, {{ $order->user_id->state }} {{ $order->user_id->postalCode }}<br>{{ $order->user_id->phone}}<br></address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</html>
