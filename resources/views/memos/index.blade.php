@php
    function highlight($text, $keyword)
    {
        if (!$keyword) {
            return e($text);
        }
        return preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<mark>$1</mark>', e($text));
    }
@endphp

@extends('layouts.memosApp')

@section('content')
    <div class = "container">
        <h1 class="mb-4">📓 メモ一覧</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- 検索フォーム -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <form action="{{ route('memos.index') }}" method="GET" class="d-flex flex-grow-1 me-3" role="search">
                <input type="text" name="keyword" class="form-control" placeholder="キーワードで検索"
                    value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-success ms-2">検索</button>
            </form>
            @if ($memos->count() > 0)
                <a href="{{ route('memos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> メモ作成
                </a>
            @endif
        </div>

        <div class="row">
            @forelse ($memos as $memo)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{!! highlight($memo->title, $keyword) !!}</h5>
                            <p class="card-text text-muted">
                                {!! highlight(Str::limit($memo->content, 100), $keyword) !!}
                            </p>
                            <div>
                                @foreach ($memo->tags as $tag)
                                    <span class="badge bg-primary">
                                        @if ($keyword && stripos($tag->name, $keyword) !== false)
                                            #{!! preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<mark>$1</mark>', e($tag->name)) !!}
                                        @else
                                            #{{ $tag->name }}
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $memo->created_at->format('Y年m月d日 H:i') }}</small>
                            <a href="{{ route('memos.show', $memo->id) }}" class="btn btn-sm btn-outline-primary">詳細</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning w-100 text-center">
                    該当するメモが見つかりませんでした
                </div>
                <div class="text-center my-4">
                    <a href="{{ route('memos.create') }}" class="btn btn-lg btn-primary">
                        <i class="fas fa-plus"></i> 新規メモを作成する
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $memos->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
