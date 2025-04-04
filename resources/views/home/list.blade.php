<!DOCTYPE html>
<html lang="en">

<head>
    <!-- develop branch -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    @media(min-width: 992px) {
        .adjust-right {
            margin-right: 30px;
        }
    }
    </style>
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

        <h2>商品一覧</h2>

        <br>

        <form action="/home/list" method="get">
            <input type="text" name="search">
            <button class="btn btn-sm btn-primary">検索</button>
        </form>

        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>種別</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ config('types')[$item->type] }}</td>
                    <td class="text-end"><a href="/home/show/{{$item->id}}" class="btn btn-primary adjust-right">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links('pagination::bootstrap-5') }}
    </div>
</body>

</html>