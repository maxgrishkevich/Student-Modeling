<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img width="40" height="40" src="{{ asset('img/welcome/logo.png') }}" alt="logo image">
            <img width="90" height="25" class="ml-2" src="{{ asset('img/welcome/logo_name.png') }}" alt="logo name">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link " href="#studel-intro" role="button">
                        {{ __('Інтро') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#studel-info" role="button">
                        {{ __('Інфо') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#studel-about" role="button">
                        {{ __('Про нас') }}
                    </a>
                </li>
            </ul>


            <ul class="navbar-nav justify-content-between">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Увійти') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.general') }}">
                        {{ __('Кабінет') }}
                    </a>
                </li>
            </ul>
            @endguest

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link " href="{{ route('dashboard.general') }}" role="button">--}}
{{--                        {{ __('Кабінет') }}--}}
{{--                    </a>--}}
{{--                </li>--}}

        </div>
    </div>
</nav>
