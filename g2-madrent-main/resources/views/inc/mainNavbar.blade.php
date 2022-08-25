<nav class="row" id="fullWidthNavbar">
    <div class="col no-padding-horizontal">
        <ul class="nav upperNavBar">
            <li class="nav-item text-center navTab">
                @if ($active == "main")
                    <a class="nav-link active" aria-current="page" href="{{ route('index'); }}">PC <div class="categoryIcon" style="background-image: url('/images/pcIcon.png')"></div></a>
                @else
                    <a class="nav-link" aria-current="page" href="{{ route('index'); }}">PC <div class="categoryIcon" style="background-image: url('/images/pcIcon.png')"></div></a>
                @endif
            </li>
            <li class="nav-item navTab text-center">
                @if ($active == "products")
                    <a class="nav-link active" href="{{ route('products'); }}">Products <div class="categoryIcon"></div></a>
                @else
                    <a class="nav-link" href="{{ route('products'); }}">Products <div class="categoryIcon"></div></a>
                @endif
            </li>
            <li class="nav-item navTab text-center">
                @if ($active == "tab1")
                    <a class="nav-link active" href="#">Pets <div class="categoryIcon"></div></a>
                @else
                    <a class="nav-link" href="#">Pets <div class="categoryIcon"></div></a>
                @endif
            </li>
            <li class="nav-item navTab text-center">
                @if ($active == "tab2")
                    <a class="nav-link active" href="{{ route('profile'); }}" tabindex="-1" aria-disabled="true">Profile <div class="categoryIcon"></div></a>
                @else
                    <a class="nav-link" href="{{ route('profile'); }}" tabindex="-1" aria-disabled="true">Profile <div class="categoryIcon"></div></a>
                @endif
            </li>
            <li class="nav-item navTab text-center">
                @if ($active == "tab3")
                    <a class="nav-link active" aria-current="page" href="#">Category <div class="categoryIcon"></div></a>
                @else
                    <a class="nav-link" aria-current="page" href="#">Category <div class="categoryIcon"></div></a>
                @endif
            </li>
            <li class="nav-item navTab text-center">
                @if ($active == "tab4")
                    <a class="nav-link active" aria-current="page" href="#">Category <div class="categoryIcon"></div></a>
                @else
                    <a class="nav-link" aria-current="page" href="#">Category <div class="categoryIcon"></div></a>
                @endif
            </li>
        </ul>
    </div>
</nav>