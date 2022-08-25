<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.title') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css'); }}">
    <link rel="stylesheet" href="{{ asset('css/adminPanel.css'); }}">

    <script type="text/javascript" src="{{ asset('js/app.js'); }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js'); }}"></script>
</head>
<body>
    <article id="adminPopup" class="addRecordPopup">
        <div class="adminPopupWrapper">
            <h1>{{__('Add record')}}</h1>
            @if ($formName == "category_groups")
                <form action="/adminPanel/insertCategoryGroup" method="post">

                    <label for="categoryName">{{__('Name')}}</label>
                    <input type="text" name="categoryName">
                    <label for="categoryIcon">{{__('Icon')}}</label>
                    <input type="text" name="categoryIcon">
            @endif
            @if ($formName == "products")
                <form action="/adminPanel/insertProduct" method="post" enctype="multipart/form-data">
                    <label for="productName">{{__('Name')}}</label>
                    <input type="text" name="productName">
                    <label for="productDescription">{{__('Description')}}</label>
                    <input type="text" name="productDescription">
                    <label for="productPrice">{{__('Price')}}</label>
                    <input type="text" name="productPrice">
                    @if ($categoryList != "")
                        <label for="category">{{__('Choose a category:')}}</label>
                        <select name="category">
                            @foreach ($categoryList as $category)
                                <option value="{{$category->name}}">{{__($category->name)}}</option>
                            @endforeach
                        </select>
                    @endif
                    <label for="filePic">{{__('Pictures')}}</label>
                    <input type="file" name="filePic">
            @endif
            @if ($formName == "users")
                <form action="/adminPanel/insertUser" method="post">
                    <label for="userName">{{__('Name')}}</label>
                    <input type="text" name="userName">
                    <label for="userRole">{{__('Role')}}</label>
                    <input type="text" name="userRole">
            @endif

                <input class="btn" type="submit" value="{{__('Save')}}">

                {!! method_field('put') !!}
                {!! csrf_field() !!}
            </form>
        </div>
        <div class="adminPopupBG" onclick="closePopup('addRecordPopup')"></div>
    </article>

    {{-- TOP NAVBAR --}}
    <x-header />

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    @endif

    <section class="container-lg">
        {{-- Main section --}}
        <article class="row firstRow">
            <div class="categoryHeader">
                <h3>{{__('Categories')}}</h3>
            </div>
            <ul class="table">
                <li class="tableRecord row no-padding">
                    <div class="col-sm-1 tableHead separator-right separator-bottom border-black">ID</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Name')}}</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Icon')}}</div>
                    <div class="col tableHead separator-bottom border-black">{{__('Actions')}}</div>
                </li>
                @if ($categoryList != "")
                    @foreach ($categoryList as $category)
                        <li class="tableRecord row categoryDisplay">
                            <div class="col-sm-1 separator-right border-black">{{$category->id}}</div>
                            <div class="col separator-right border-black">{{$category->name}}</div>
                            <div class="col separator-right border-black">{{$category->picture}}</div>
                            <div class="col">
                                <form action="{{ url('/adminPanel/updateCategory', ['id' => $category->id]) }}" method="post" class="adminFormButton">
                                    <input class="btn btn-default" type="submit" value="{{__('Edit')}}">
                                    {!! method_field('patch') !!}
                                    {!! csrf_field() !!}
                                </form>
                                <form action="{{ url('/adminPanel/deleteCategory', ['id' => $category->id]) }}" method="post" class="adminFormButton">
                                    <input class="btn btn-default" type="submit" value="{{__('Delete')}}">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="tableRecord row">
                        {{__('No records.')}}
                    </li>
                @endif
            </ul>
            {{-- TODO paginator with JS --}}
        </article>
        <article class="row">
            <div class="categoryHeader">
                <h3>{{__('Products')}}</h3>
                <form action="/adminPanel/showSearchResult" method="get">
                    <input type="text" placeholder="{{__('Search here')}}..." name="searchQuery">
                    <input type="submit" value="{{__('Search')}}" id="categorySearchBtn" name="search">
                </form>
                <button onclick="window.location.href = '/adminPanel/addRecord/products'">{{__('Add record')}}</button>
            </div>
            <ul class="table">
                <li class="tableRecord row no-padding">
                    <div class="col-sm-1 tableHead separator-right separator-bottom border-black">ID</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Name')}}</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Description')}}</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Price')}}</div>
                    <div class="col tableHead separator-bottom border-black">{{__('Actions')}}</div>
                </li>
                @if ($productList != "")
                    @foreach ($productList as $product)
                        <li class="tableRecord row">
                            <div class="col-sm-1 separator-right border-black">{{$product->id}}</div>
                            <div class="col separator-right border-black">{{$product->name}}</div>
                            <div class="col separator-right border-black">{{__($product->description)}}</div>
                            <div class="col separator-right border-black">{{$product->price}}</div>
                            <div class="col">
                                <form action="{{ url('/adminPanel/updateProduct', ['id' => $product->id]) }}" method="post" class="adminFormButton">
                                    <input class="btn btn-default" type="submit" value="{{__('Edit')}}">
                                    {!! method_field('patch') !!}
                                    {!! csrf_field() !!}
                                </form>
                                <form action="{{ url('/adminPanel/deleteProduct', ['id' => $product->id]) }}" method="post" class="adminFormButton">
                                    <input class="btn btn-default" type="submit" value="{{__('Delete')}}">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="tableRecord row">
                        {{__('No records.')}}
                    </li>
                @endif
            </ul>
        </article>
        <article class="row">
            <div class="categoryHeader">
                <h3>{{__('Users')}}</h3>
            </div>
            <ul class="table">
                <li class="tableRecord row no-padding">
                    <div class="col-sm-1 tableHead separator-right separator-bottom border-black">ID</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Name')}}</div>
                    <div class="col tableHead separator-right separator-bottom border-black">{{__('Role')}}</div>
                    <div class="col tableHead separator-bottom border-black">{{__('Actions')}}</div>
                </li>
                @if ($userList != "")
                    @foreach ($userList as $user)
                        <li class="tableRecord row">
                            <div class="col-sm-1 separator-right border-black">{{$user->id}}</div>
                            <div class="col separator-right border-black">{{$user->name}}</div>
                            <div class="col separator-right border-black">{{$user->role}}</div>
                            <div class="col">
                                <form action="{{ url('/adminPanel/updateUser', ['id' => $user->id]) }}" method="post" class="adminFormButton">
                                    <input class="btn btn-default" type="submit" value="{{__('Edit')}}">
                                    {!! method_field('patch') !!}
                                    {!! csrf_field() !!}
                                </form>
                                <form action="{{ url('/adminPanel/deleteUser', ['id' => $user->id]) }}" method="post" class="adminFormButton">
                                    <input class="btn btn-default" type="submit" value="{{__('Delete')}}">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="tableRecord row">
                        {{__('No records.')}}
                    </li>
                @endif
            </ul>
        </article>
    </section>

    {{-- Footer --}}
    @include('inc.footer')
</body>
</html>

