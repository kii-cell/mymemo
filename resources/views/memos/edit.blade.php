@extends('layouts.memosApp')

@section('content')
    <div class="container">
        <h2 class="mb-4">📝 メモ編集</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('memos.update', $memo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{ old('title', $memo->title) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">内容</label>
                <textarea id="content" name="content" class="form-control" rows="6">{{ old('content', $memo->content) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('memos.show', $memo->id) }}" class="btn btn-secondary">キャンセル</a>
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
    </div>
@endsection
