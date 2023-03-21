<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link href="https://use.fontawesome.com/releases/v6.2.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="/top"><img src="{{ asset('images/Atlas.png') }}"></a></h1>
            <div class ="menu">
                <input id="acd-check" type="checkbox">
                <label for="acd-check">{{Auth::user()->username}}さん
                    <div class = "border border-left"></div>
                    <div class = "border border-right"></div>
                </label>
                <img src="images/icon1.png">
                <ul id ="links">
                    <li><a href="/top">HOME</a></li>
                    <li><a href="/profile" name="profile">プロフィール編集</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{Auth::user()->username}}さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>
                        @if (Auth::user()->followingCount() > 0)
                        {{ Auth::user()->followingCount() }}名
                        @else
                        0名
                        @endif
                    </p>
                </div>
                <p><a href="/followlist">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>
                        @if (Auth::user()->followersCount() > 0)
                        {{ Auth::user()->followersCount() }}名
                        @else
                        0名
                        @endif
                    </p>
                </div>
                <p><a href="/followerlist">フォロワーリスト</a></p>
            </div>
            <p><a href="/search" name="search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>
