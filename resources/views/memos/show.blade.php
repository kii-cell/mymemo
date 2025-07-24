@extends('layouts.memosApp')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title">{{ $memo->title }}</h2>
                <p class="card-text mt-3" style="white-space: pre-wrap;">{{ $memo->content }}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">作成日: {{ $memo->created_at->format('Y年m月d日 H:i') }}</small>
                <div>
                    <a href="{{ route('memos.edit', $memo->id) }}" class="btn btn-sm btn-outline-secondary">編集</a>

                    <form action="{{ route('memos.destroy', $memo->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('本当に削除しますか?');">削除</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('memos.index') }}" class="btn btn-secondary">一覧に戻る</a>
        </div>
    </div>
@endsection
