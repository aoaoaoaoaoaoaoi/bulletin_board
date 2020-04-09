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
                /*height: 100vh;
                margin: 0;*/
            }

            div.fish{
                position: absolute;
                right: 100px;
                top: 100px;
            }

            div.fish-body {
                width: 100px;
                height: 100px;
                background: rgb(246, 156, 85);
                border-radius: 0% 100% 0% 100% / 0% 100% 0% 100%;
                transform: rotate( -45deg );
            }

            div.fish-tail {
                position: relative;
                right: -40px;
                top: 105px;
                border-top: 35px solid transparent;
                border-right: 40px solid #f6da69;
                border-bottom: 35px solid transparent;
            }

            div.fish-white-eye {
                position: relative;
                top: -63px;
                width: 17px;
                height: 17px;
                background: #FFFFFF;
                border-radius: 50%;
            }

            div.fish-black-eye {
                position: relative;
                right: -3px;
                top: 3px;
                width: 10px;
                height: 10px;
                background: #000000;
                border-radius: 50%;
            }

             div.fish-head-gills {
                position: relative;
                right: 50px;
                top: -77px;
                border-top: 10px solid transparent;
                border-right: 15px solid #f6da69;
                border-bottom: 10px solid transparent;
                height: 10px;
            }
            
            div.fish-dorsal-fin{
                position: relative;
                top: 24px;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 0 25px 20px 15px;
                border-color: transparent transparent #f6da69 transparent;
                right: -45px;
                transform: rotate(7deg);
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
                <div class = "fish">
                    <div class = "fish-tail">
                    </div>
                    <div class = "fish-dorsal-fin">
                    </div>
                    <div class = "fish-body">
                    </div>
                    <div class = "fish-head">
                        <div class = "fish-white-eye">
                            <div class = "fish-black-eye">
                            </div>
                        </div>
                        <div class = "fish-head-gills">

                        </div>
                    </div>
                <div>
            </div>
        </div>
    </body>
</html>
