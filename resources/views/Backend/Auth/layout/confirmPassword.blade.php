<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    <title>@yield('page_title') | Codewithalbab</title>
</head>

<body>
    <div class="container">
        <form class="form" method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form__text">
                New Password
            </div>
            <div class="form__group">
                <input type="password" name="password" class="form__input" placeholder="Password" id="password"
                    required>
                <label for="password" class="form__label">New Password</label>
            </div>
            <div class="form__group">
                <input type="password" name="password_confirmation" class="form__input" placeholder="Retype-Password"
                    id="password" required>
                <label for="password" class="form__label">Set Password</label>
            </div>

            <div class="form__button">
                <input type="submit" class="btn">
            </div>
        </form>
        @dd('password.store')
        <div class="from__bottom">
            <a href="{{ route('login') }}" class="sign">Login</a>
        </div>
    </div>

</body>

</html>
