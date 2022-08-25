@include('popups.login')
@include('popups.register')

<header class="navbar navbar-expand-lg navbar-dark bg-dark sticky" id="topNavBar">
    <section class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @if ($showProfile == "true" || !Auth::guest())
                    <li class="nav-item profileHolder">
                        <a class="nav-link no-padding-vertical px-3 profileIcon" aria-current="page" href=" {{ route('profile'); }} ">{{Auth::user()->email}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link no-padding-vertical px-3 separator-left" aria-current="page" href="#">F.A.Q.</a>
                    </li>
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
                @else
                    <li class="nav-item">
                        <a class="nav-link no-padding-vertical px-3" aria-current="page" href="#">F.A.Q.</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link separator-left separator-right px-3 no-padding-vertical" href="#" type="button"  data-toggle="modal" data-target="#registerPopup">Register</a>
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