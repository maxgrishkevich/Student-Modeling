<div>
    <header class="d-flex flex-wrap align-items-center studel-header border-bottom">
        <a href="/" class="studel-logo d-flex align-items-center pl-5 mb-md-0 text-dark text-decoration-none">
        <img width="50" height="50" src="{{ asset('img/welcome/logo.png') }}" alt="logo image">
        <img width="90" height="25" class="ml-2" src="{{ asset('img/welcome/logo_name.png') }}" alt="logo name">
        </a>
        <ul class="nav justify-content-center mb-md-0 m-0 studel-nav">
            <li><a href="#studel-intro" class="nav-link px-3">Вступ</a></li>
            <li><a href="#studel-info" class="nav-link px-3">Інфо</a></li>
            <li><a href="#studel-about" class="nav-link px-3">Про нас</a></li>
        </ul>


        @if (Route::has('login'))
            <div class="pr-5 text-end studel-login">
                @auth
                    <button type="button" onclick="location.href='/dashboard'" class="studel-button-login btn btn-outline-primary">Кабінет</button>
{{--                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>--}}
                @else
                    <button type="button" onclick="location.href='/login'" class="studel-button-login btn btn-outline-primary">Увійти</button>
{{--                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>--}}
{{--                    @endif--}}
                @endauth
            </div>
        @endif



{{--        <div class="pr-5 text-end studel-login">--}}
{{--            <button type="button" onclick="location.href='/login'" class="studel-button-login btn btn-outline-primary">Увійти</button>--}}
{{--        </div>--}}
    </header>
</div>
