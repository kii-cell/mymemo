@extends('layouts.memosApp')

@section('content')
    <div class="container">
        <h1 class="mb-4">🗑️ ゴミ箱 - 削除済みメモ一覧</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($memos->isEmpty())
            <div class="alert alert-info">削除済みのメモはありません</div>
        @else
            <div class="row">
                @foreach ($memos as $memo)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $memo->title }}</h5>
                                <p class="card-text text-muted" style="white-space: pre-wrap;">
                                    {{ Str::limit($memo->content, 150) }}
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <small class="text-muted">削除日時: {{ $memo->deleted_at->format('Y年m月d日 H:i') }}</small>
                                <div>
                                    <form action="{{ route('memos.restore', $memo->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success me-2">復元</button>
                                    </form>
                                    <form action="{{ route('memos.forceDelete', $memo->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('完全に削除しますか?');">完全に削除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $memos->links() }}
            </div>
        @endif

        <a href="{{ route('memos.index') }}" class="btn btn-secondary mt-3">メモ一覧に戻る</a>
    </div>
@endsection
