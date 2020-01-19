<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ admin_asset("vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ admin_asset("vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css") }}">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            /*align-items: center;*/
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
            color: #636b6f;
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
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            {{--<p>Jef</p>--}}
            <p>Test</p>
        </div>
        <div class="m-b-md">
            {{--<p>Email：chenxm0592@hotmail.com</p>--}}
            {{--<p>Wechat：czf0417</p>--}}
        </div>
        <div class="links">
            {{--<a href="https://my.oschina.net/u/3214063?tab=newest&catalogId=0" target="_blank">开源中国博客</a>--}}
        </div>
        <div class="box-body">
            <form pjax-container action="{{action('WelcomeController@messagePost')}}" method="post">
                <div class="form-group">
                    <label>昵称</label>
                    <input name="nickname" class="form-control" placeholder="请输入您的昵称:Tony" />
                </div>
                <div class="form-group">
                    <label>联系方式</label>
                    <select name="type" class="form-control">
                        <option value="email" selected>Email</option>
                        <option value="mobile">手机号</option>
                        <option value="wechat">微信</option>
                        <option value="qq">QQ</option>
                    </select>
                    <input name="contact" class="form-control" placeholder="请输入您的联系方式:10000@qq.com" />
                </div>
                <div class="form-group">
                    <label>留言</label>
                    <textarea name="content" class="form-control" cols="50" rows="10"></textarea>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
