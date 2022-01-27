<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Michiel van Ginhoven" />
    <title>Spectrum Rooster</title>
    {{-- bootstrap etc. --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- eigen css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layoutstyle.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >
    {{-- favicons --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @stack('styles')
    {{-- csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header id="header">
        <div class="content">
            <h1>
                <a href="/" id="a_logo">
                    <img src="{{ asset('images/spectrum-logo-small.svg') }}" alt="Spectrum Roosters logo" id="logo">
                    Spectrum Roosters
                </a>
            </h1>
            <nav id="header_nav" class="nav">
                <ul>
                    <li>
                        <a href="/tracks" class="btn btn_round btn_yellow btn_menu {{Request::is("tracks") || Request::is("track/*")? 'current_page' : ''}}"> 
                            <img src="{{ asset('images/rooster-icon.svg') }}" alt="roosters" class="icon">
                        </a>
                    </li>
                    <li>
                        <a href="/rooms" class="btn btn_round btn_yellow btn_menu {{Request::is("rooms") ||  Request::is("room/*")? 'current_page' : ''}}">
                            <img src="{{ asset('images/settings-icon.svg') }}" alt="" class="icon">
                        </a>
                    </li>
                    <li>
                        <button class="btn btn_squar btn_red" formaction="{{route('logout')}}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="far fa-clock icon"></i>
                            Uitklokken
                        </button>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </ul>    
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>


<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
