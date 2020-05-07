<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>けいじばん</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('bulletin_default.js') }}" defer></script>
    @yield('jssheet')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bulletin_default.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="nav-bar">
            <div class="head-container">
                <a class="navbar-brand link" href="{{ url('/') }}">
                    けいじばん
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="head-righit-link">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link link" href="{{ route('register') }}">アカウント作成</a>
                                </li>
                            @endif
                        @else
                            <li class="right-link">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div id=dropDown class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <table class="table-dropdown">
                                        <tr>
                                            <td class="align-left">
                                                <a class="dropdown-item" id="edit-profile" href="./edit_profile">
                                                    プロフィールの編集
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-left">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    ログアウト
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </li>
                            <li class="right-link">
                                <a class="dropdown-item" id="make-thread-index" href="./make_thread_index">
                                    スレを作成
                                </a>
                            </li>
                            <li class="right-link">
                                グループ
                                <div id=dropDown class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <table class="table-dropdown">
                                        <tr>
                                            <td class="align-left">
                                                <a class="dropdown-item" id="join-group" href="./join_group">
                                                    グループに参加する
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-left">
                                                <a class="dropdown-item" id="make-group" href="./make_group">
                                                    グループを作成する
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 200 100" preserveAspectRatio="none" id="svg-bg">
                <path d="M0,0 v3 q10,2 20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 t20,0 v-50 Z" fill="none" stroke="#2080C0" stroke-width="0.05"></path>
            </svg>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
    @yield('jquery')
</body>
</html>
