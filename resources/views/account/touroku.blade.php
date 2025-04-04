<!-- Bootstrap CSS -->
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
<h1>農作物管理システム</h1>
<a href="/">→ログイン</a>
<font color=red>@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif </font>
<form action="/account/tourokujikkou" method="post">
@csrf
    <p><label for="exampleFormControlInput1" class="form-label">Email address</label>
    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"></p>
    <p><label for="exampleFormControlInput1" class="form-label">name</label>
    <input type="name" name="name" value="{{ old('name') }}" class="form-control" id="exampleFormControlInput1" placeholder="テック太郎"></p>
    <p><label for="exampleFormControlInput1" class="form-label">password（6文字以上）</label>
    <input type="password" name="password" class="form-control"></p>
    <p><label for="exampleFormControlInput1" class="form-label">password（確認）</label>
    <input type="password" name="password_confirmation" class="form-control"></p>
    <p><input type="submit" class="Form-Btn" value="登録"></p>
    </div>
</body>
</html>
