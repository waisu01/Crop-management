<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ユーザー編集</title>
</head>
<body>
    <div class="container">
        <a href="/user/index"> 戻る </a>
    </div>
    <div class="container">
        <h2 class="text-center">ユーザー編集 ユーザーID : {{ $user->id }} </h2>
            <div>
                <form action="/user/update/{{$user->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                
                    <div class="mt-4">
                        <label for="name" class="form-label">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                        @if ($errors->has('name'))
                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                        @if ($errors->has('email'))
                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="radio" id="role1" name="role" Value="1"{{ old ('role', $user->role) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="role1">管理者</label>
                    </div> 
                    
                    <div class="form-check mt-4">
                        @if (Auth::id() != $user->id)
                        <input class="form-check-input" type="radio" id="role0" name="role" Value="0"{{ old ('role', $user->role) == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="role0">一般ユーザー</label>
                        <br class="text-start">
                        @else
                        <p class="text-danger">管理者である自分のIDは権限を変更できません。<br>管理者権限をもっている他のユーザーへ変更依頼をしてください。</p>
                        @endif
                    </div>
                    <div>
                        @if ($errors->has('role'))
                            <small class="form-text text-danger">{{ $errors->first('role') }}</small>
                        @endif
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary" type="submit">保存する</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    @if (Auth::id() != $user->id)
                    <form action="/user/delete/{{ $user->id }}" method="POST">
                    @csrf
                        <button class="btn btn-danger" type="submit" onclick='return confirm("本当にユーザーID {{ $user->id }} を削除しますか？")'>削除する</button>
                    </form>
                    @else
                    <p class="text-danger">管理者である自分のIDを削除することはできません。<br>管理者権限をもっている他のユーザーへ削除依頼をしてください。</p>
                    @endif
                </div>
            </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>