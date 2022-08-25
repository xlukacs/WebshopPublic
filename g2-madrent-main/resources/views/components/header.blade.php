@include('popups.login')
@include('popups.register')

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

<header class="navbar navbar-expand-lg navbar-dark bg-dark sticky" id="topNavBar">
    <section class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link px-3 no-padding-vertical anketaEnterButton" href="{{ route('anketaManager'); }}">Anketa manager</a>
                </li>
                @if (!Auth::guest())
                    <li class="nav-item profileHolder">
                        <a class="nav-link no-padding-vertical px-3 profileIcon separator-right" aria-current="page" href=" {{ route('profile'); }} ">{{Auth::user()->email}}</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link no-padding-vertical px-3 separator-left" aria-current="page" href="#">F.A.Q.</a>
                    </li> --}}
                    <li class="nav-item">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                    @if (Auth::user()->role == "admin")
                        @if (strpos($site, "adminPanel")  > -1)
                            <li class="nav-item">
                                <a class="nav-link no-padding-vertical px-3 adminPanelButton" aria-current="page" href="/">{{__('Leave Admin panel')}}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link no-padding-vertical px-3 adminPanelButton" aria-current="page" href="/adminPanel">{{__('Enter Admin panel')}}</a>
                            </li>
                        @endif
                    @endif
                @else
                    {{-- <li class="nav-item">
                        <a class="nav-link no-padding-vertical px-3" aria-current="page" href="#">F.A.Q.</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link separator-right px-3 no-padding-vertical" href="#" type="button"  data-toggle="modal" data-target="#registerPopup">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link no-padding-vertical px-3" href="#" type="button"  data-toggle="modal" data-target="#loginPopup">Log in</a>
                    </li>
                @endif
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle no-padding-vertical px-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (App::isLocale('en'))
                            <img src="/images/flags/UKflag.png" alt="UK flag">
                        @else
                            <img src="/images/flags/SKflag.png" alt="SK flag">
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="/setlang/en">
                                <img src="/images/flags/UKflag.png" alt="UK flag"> English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/setlang/sk">
                                <img src="/images/flags/SKflag.png" alt="SK flag"> Slovak
                            </a>
                        </li>   
                    </ul>
                </li>
            </ul>
        </div>
    </section>
</header>