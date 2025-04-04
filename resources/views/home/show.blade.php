<!DOCTYPE html>
<html lang="en">

<head>
    <!-- develop branch -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    @include('parts.navi')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <div class="p-2">

        <br>

        <h2>詳細画面</h2>

        <br>

        <form action="/home/list" method="get"> </form>
        <table class="table">

            <tr>
                <th>ID</th>
                <td>{{$item->id}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$item->name}}</td>
            </tr>
            <tr>
                <th>種別</th>
                <td>{{ config('types')[$item->type] }}</td>
            </tr>
            <tr>
                <th>更新日時</th>
                <td>{{$item->updated_at}}</td>
            </tr>

        </table>

        <br>
        <h5><strong>詳細情報</strong></h5>
        <div class="card">
            <p>{!! nl2br(e($item->detail)) !!}</p>
        </div>

        <br>
        <button class="btn btn-primary" type="button" onClick="history.back()">戻る</button>
    </div>
</body>

</html>