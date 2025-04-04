<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4"
            aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">農作物管理サイト</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.home') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.list') }}">商品一覧</a>
                </li>
                @can('admin')
                <li class="nav-item">
                    <a class="nav-link" href="/user/index">ユーザー管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/item">商品管理</a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="/logout">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>