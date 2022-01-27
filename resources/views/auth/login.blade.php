<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <title>Spectrum Rooster</title>
    </head>
    <body id="loginBody">
        <aside>

        </aside>
        <main id="loginMain" role="main">
            <article>
                <h2>Spectrum rooster</h2>
                <h3>INLOGGEN</h3>
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username">
                            <i class="fas fa-address-book"></i>
                            </label>
                                @if(!isset($_GET["username"]))
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Gebruikersnaam..." required  autofocus autocomplete="off">
                                @else
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$_GET["username"]}}" placeholder="Gebruikersnaam..." required  autofocus autocomplete="off">
                                @endif
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div>
                            <label for="password"></label>
                                @if(!isset($_GET["user_password"]))
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Wachtwoord..." required autocomplete="off">
                                @else
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Wachtwoord..." required autocomplete="off" value="{{$_GET["user_password"]}}">
                                @endif
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button id="loginBtn" type="submit" class="btn btn-primary">
                            {{ __('Inloggen') }}
                        </button>
                        
                        @if(isset($_GET["redirected"]))
                            <script>
                                document.getElementById("loginForm").submit();
                            </script>
                        @endif
                    </form>
                </article>
            <footer>
                <small>&copy; Copyright 2020 - Spectrum Multimedia & IT</small>
            </footer>
        </main>
    </body>
</html>