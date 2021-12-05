@inject('auth','\Illuminate\Support\Facades\Auth')
<header
    class="
                    d-flex
                    flex-wrap
                    align-items-center
                    justify-content-center
                    justify-content-md-between
                    py-3
                    mb-4
                    border-bottom
            "
>
    <a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span>Library</span>
    </a>
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('home')}}">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('categories')}}">
                Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('books.books')}}">
                Books
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#">
                About us
            </a>
        </li>
        <li class="nav-item">
            @if($auth::check())
                <a class="nav-link text-dark" href="{{route('auth.account')}}">
                    {{$auth::user()->name}}
                </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('auth.logout')}}">
                Logout
            </a>
        </li>
            @else
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('auth.login')}}">
                        Sign in
                    </a>
                </li>
            @endif
    </ul>
</header>
