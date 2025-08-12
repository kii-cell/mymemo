<!DOCTYPE html>
<html lang = "ja">

<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモアプリ</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel = "stylesheet">
    <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('memos.index') }}">🗒️ メモアプリ</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('memos.index') }}"><i class="fas fa-list"></i> メモ一覧</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('memos.create') }}"><i class="fas fa-plus"></i> メモ作成</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('memos.trash') }}"><i class="fas fa-trash-alt"></i> ゴミ箱</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item me-3">
                            <span class="nav-link text-white">こんにちは,{{ Auth::user()->name }}さん</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light"> >ログアウト</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="text-center py-4 mt-5 text-muted">
        &copy; {{ date('Y') }} メモアプリ. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
