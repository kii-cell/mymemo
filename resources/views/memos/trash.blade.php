@extends('layouts.memosApp')

@section('content')
    <div class="container">
        <h1 class="mb-4">🗑️ ゴミ箱</h1>

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
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">{{ $memo->title }}</h5>
                                <p class="card-text text-muted mb-2">
                                    {{ Str::limit($memo->content, 150) }}
                                </p>
                                <div class="mb-3">
                                    @foreach ($memo->tags as $tag)
                                        <span class="badge bg-primary me-1 mb-1">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <small class="text-muted">削除日時: {{ $memo->deleted_at->format('Y年m月d日 H:i') }}</small>
                                <div class="d-flex flex-wrap gap-2">
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
