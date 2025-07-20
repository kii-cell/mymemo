@extends('layouts.memosApp')

@section('content')
    <h1>新しいメモを作成</h1>

    <form method="POST" action="{{ route('memos.store') }}">
        @csrf
        <div>
            <label for="title">タイトル</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="content">内容</><br>
                <textarea id="content" name="coontent">{{ old('content') }}</textarea>
                @error('content')
                    <div stule="color:red;">{{ $message }}</div>
                @enderror
        </div>

        <button type="submit">作成</button>
    </form>
@endsection
