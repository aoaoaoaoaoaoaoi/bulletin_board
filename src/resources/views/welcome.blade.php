<!DOCTYPE html>
<html lang="ja">
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
                width: 100%;
                height: 100vh;
            }

            div.fish{
                position: absolute;
                right: 100px;
                top: 100px;
            }

            @keyframes move {
                0% {
                    transform: translateX(300px);
                }

                50% {
                    transform: translateY(300px);
                }

                100% {
                    transform: translateX(10px);
                }
            }

            div.fish-body {
                width: 100px;
                height: 100px;
                background: rgb(246, 156, 85);
                border-radius: 0% 100% 0% 100% / 0% 100% 0% 100%;
                transform: rotate( -45deg );
            }

            div.fish-tail-fin {
                position: relative;
                right: -40px;
                top: 130px;
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

             div.fish-pectoral-fin {
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
                top: 49px;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 0 25px 20px 15px;
                border-color: transparent transparent #f6da69 transparent;
                right: -45px;
                transform: rotate(8deg);
            }

            div.fish-pelvic-fin{
                position: relative;
                top: 102px;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 10px 10px 0 17px;
                border-color: #f6da69 transparent transparent transparent;
                right: -20px;
                transform: rotate(10deg);
            }

            div.fish-anal-fin{
                position: relative;
                top: 84px;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 15px 20px 0 25px;
                border-color: #f6da69 transparent transparent transparent;
                right: -65px;
                transform: rotate(-20deg);
            }

            .bubbles {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                top: 0;
                left: 0;
            }
            
            .bubble {
                position: absolute;
                bottom: 0;
                width: 40px;
                height: 40px;
                overflow: hidden;
                background-color: transparent;
                border: 1px solid #fff;
                border-radius: 50%;
                animation: bubble 10s ease-in infinite;
            }
            
            .bubble:nth-child(1) {
                width: 20px;
                height: 20px;
                left: 30%;
                animation-duration: 6s;
            }
            
            .bubble:nth-child(2) {
                left: 20%;
                animation-duration: 3.5s;
            }
            
            .bubble:nth-child(3) {
                width: 30px;
                height: 30px;
                left: 30%;
                animation-duration: 7s;
            }
            
            .bubble:nth-child(4) {
                width: 50px;
                height: 50px;
                left: 67%;
                animation-duration: 6s;
            }
            
            .bubble:nth-child(5) {
                width: 20px;
                height: 20px;
                left: 70%;
                animation-duration: 4.5s;
            }
            
            @keyframes bubble {
                0% {
                    bottom: -100px;
                    transform: translateX(0);
                }
                50% {
                    transform: translateX(100px);
                }
                100% {
                    bottom: 1000px;
                }
            }

            .flex-center {
                width: 100%;
                height: 100%;
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
                z-index: 1;
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
            .link:hover{
                color: #6fb5e3;
	            text-shadow: 0px 2px 10px rgba(111, 181, 227, 0.8),
                0px 5px 50px rgba(111, 181, 227, 0.8),
                0px 8px 80px rgba(111, 181, 227, 0.6),
                0px 8px 120px rgba(111, 181, 227, 0.6);
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .head{
                position: relative;
                width:100%;
                height:100%;
            }

            #svg-bg {
                position: absolute;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class = "head">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class = "link" href="{{ url('/home') }}">ホーム</a>
                    @else
                        <a class = "link" href="{{ route('login') }}">ログイン</a>

                        @if (Route::has('register'))
                            <a class = "link" href="{{ route('register') }}">アカウント作成</a>
                        @endif
                    @endauth
                </div>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 200 100" preserveAspectRatio="none" id="svg-bg">
                <path d="M0,0 v10 q10,5 20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="none" stroke="#2080C0" stroke-width="0.05"></path>
            </svg>
            </div>

            <div class="content">
                <div class = "fish">
                    <div class = "fish-tail-fin">
                    </div>
                    <div class = "fish-dorsal-fin">
                    </div>
                    <div class = "fish-pelvic-fin">
                    </div>
                    <div class = "fish-anal-fin">
                    </div>
                    <div class = "fish-body">
                    </div>
                    <div class = "fish-head">
                        <div class = "fish-white-eye">
                            <div class = "fish-black-eye">
                            </div>
                        </div>
                        <div class = "fish-pectoral-fin">
                        </div>
                    </div>
                </div>
                <div class="bubbles">
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                </div>
            </div>
        </div>
    </body>
</html>
