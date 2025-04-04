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
@if(session('message'))
	<div>
		{{ session('message') }}
	</div>
@endif
<font color=red>@foreach ($errors->all() as $error)
    {{$error}}
@endforeach </font>
<a href="/account/touroku">→会員登録</a>
<form action="/account/auth" method="post">
@csrf
    <p><label for="exampleFormControlInput1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" value="{{ old('email') }}"id="exampleFormControlInput1" placeholder="name@example.com"></p>
    <p><label for="exampleFormControlInput1" class="form-label">password</label>
    <input type="password" class="form-control" name="password"></p>
    <p><input type="submit" class="Form-Btn" value="ログイン"></p>
    </div>
</body>
</html>