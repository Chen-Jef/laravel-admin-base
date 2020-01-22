<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="CSRF-token" content="{{ csrf_token() }}">
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
<script src="{{admin_asset("vendor/laravel-admin/AdminLTE/plugins/jQuery/Jquery-2.1.4.min.js")}}"></script>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form pjax-container action="{{action('WelcomeController@messagePost')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>昵称</label>
                    <input id="nickname" name="nickname" type="text" class="@error('nickname') is-invalid @enderror form-control" value="{{old('nickname')}}">
                    @error('nickname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>联系方式</label>
                    <select name="type" class="form-control">
                        <option value="email" @if (old('type') == 'email') selected="selected" @endif>Email</option>
                        <option value="mobile" @if (old('type') == 'mobile') selected="selected" @endif>手机号</option>
                        <option value="wechat" @if (old('type') == 'wechat') selected="selected" @endif>微信</option>
                        <option value="qq" @if (old('type') == 'qq') selected="selected" @endif>QQ</option>
                    </select>
                    <input name="contact" required class="form-control @error('contact') is-invalid @enderror" placeholder="请输入您的联系方式" value="{{old('contact')}}" />
                    @error('contact')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>留言</label>
                    <textarea name="content" required class="form-control @error('content') is-invalid @enderror" cols="50" rows="10">{{old('content')}}</textarea>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="CSRF-token"]').attr('content')
        }
    });
</script>
