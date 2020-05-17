<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Weibo App') - Laravel入门练习</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
@include('layout._header')
<div class="container mt-3">
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if(session()->has('activated'))
    <div class="alert alert-warning">
        您的账号还未激活，请查看您的邮箱激活账号 <a href="">重新发送激活邮件</a>
    </div>
@endif
@include('shared._message')
@yield('content')
@include('layout._footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
