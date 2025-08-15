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
        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
            <form action="{{ route('memos.index') }}" method="GET" class="d-flex flex-column flex-sm-row flex-grow-1 me-3"
                role="search">
                <input type="text" name="keyword" class="form-control mb-2 mb-sm-0 me-sm-2" placeholder="キーワードで検索"
                    value="{{ request('keyword') }}">
                <select name="sort" class="form-select mb-2 mb-sm-0 me-sm-2" style="width: 160px;">
                    <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>新しい順</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>古い順</option>
                    <option value="title" {{ $sort === 'title' ? 'selected' : '' }}>タイトル順</option>
                </select>
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
                    <div class="card h-100 shadow-sm {{ $memo->pinned ? ' border-warning border-3' : '' }}">
                        @if ($memo->pinned)
                            <div class="pin-icon">
                                <i class="fas fa-thumbtack"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{!! highlight($memo->title, $keyword) !!}</h5>
                            <p class="card-text text-muted mb-2">
                                {!! highlight(Str::limit($memo->content, 100), $keyword) !!}
                            </p>
                            <div class="mb-2">
                                @foreach ($memo->tags as $tag)
                                    <a href="{{ route('memos.index', ['tag' => $tag->id]) }}"
                                        class="badge bg-primary text-decoration-none me-1 mb-1">
                                        @if ($activeTag && $tag->id === $activeTag->id)
                                            <mark>#{{ $tag->name }}</mark>
                                        @else
                                            {!! highlight('#' . $tag->name, $keyword) !!}
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <small class="text-muted"><i class="fas fa-calendar-alt"></i>
                                {{ $memo->created_at->format('Y年m月d日 H:i') }}</small>
                            <div class="d-flex flex-wrap gap-2">
                                <form action="{{ route('memos.togglePin', $memo->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm {{ $memo->pinned ? 'btn-warning' : 'btn-outline-secondary' }}">
                                        {{ $memo->pinned ? '📌 解除' : '📌 ピン留め' }}
                                    </button>
                                </form>
                                <a href="{{ route('memos.show', $memo->id) }}"
                                    class="btn btn-sm btn-outline-primary">詳細</a>
                            </div>
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
    </div>
    <div class="justify-content-center mt-4 mb-5">
        {{ $memos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

@endsection
