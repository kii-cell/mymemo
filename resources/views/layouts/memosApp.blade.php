<!DOCTYPE html>
<html lang = "ja">

<head>
    <meta charset = "UTF-8">
    <title>メモ管理アプリ</title>
</head>

<body>
    <header>
        <h1>メモ管理アプリ</h1>
        <nav>
            <a href = "{{ route('memos.index') }}">メモ一覧</a>
            <a href = "{{ route('memos.create') }}">メモ作成</a>
        </nav>
        <hr>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
