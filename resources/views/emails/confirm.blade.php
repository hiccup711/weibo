<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>感谢您注册WeiboApp</title>
</head>
<body>
<h1>感谢您注册WeiboApp</h1>
<p>请点击下方链接注册 <br>
    <a href="{{ route('confirm_email', $user->activation_token) }}">
        {{ route('confirm_email', $user->activation_token) }}
    </a>
</p>
<p>如果不是您本人的操作，请忽略此邮件</p>
</body>
</html>
