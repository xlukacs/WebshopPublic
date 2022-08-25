<nav class="row navbar navbar-expand-md navbar-dark" id="fullWidthNavbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavBarDropDown" aria-controls="mainNavBarDropDown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="col no-padding-horizontal collapse navbar-collapse" id="mainNavBarDropDown">
        <ul class="nav upperNavBar">
            <li class="nav-item text-center navTab">
                @if ($activeTab == "home" || ($activeTab != "GPUs" && $activeTab != "CPUs" && $activeTab != "SSDs" && $activeTab != "ASICs"))
                    <a class="nav-link active" aria-current="page" href="/">{{__('Home')}} <div class="categoryIcon" style="background-image: url('/images/icons/homeIcon.png')"></div></a>
                @else
                    <a class="nav-link" aria-current="page" href="/">{{__('Home')}} <div class="categoryIcon" style="background-image: url('/images/icons/homeIcon.png')"></div></a>
                @endif
            </li>            
            @foreach ($tabs as $tab)
                <li class="nav-item text-center navTab">
                    @if ($activeTab == $tab->name)
                        <a class="nav-link active" aria-current="page" href="/category/{{$tab->name}}">{{__($tab->name)}} <div class="categoryIcon" style="background-image: url('/images/{{$tab->picture}}')"></div></a>
                    @else
                        <a class="nav-link" aria-current="page" href="/category/{{$tab->name}}">{{__($tab->name)}} <div class="categoryIcon" style="background-image: url('/images/{{$tab->picture}}')"></div></a>
                    @endif
                </li>    
            @endforeach
        </ul>
    </div>
</nav>