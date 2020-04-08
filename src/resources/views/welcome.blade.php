<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>けいじばん</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #040424;
                color: #2080C0;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            div.fish-body {
                position: absolute;
                right: 100px;
                top: 100px;
                width: 50px;
                height: 80px;
                background: rgb(246, 156, 85);
                border-radius: 50%;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #2080C0;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">ホーム</a>
                    @else
                        <a href="{{ route('login') }}">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">アカウント作成</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div id = "fish">
                    <div id = "fish-body">
                    </div>
                <div>
            </div>
        </div>
    </body>
</html>
