@extends('layouts.memosApp')

@section('content')
    <div class = "container">
        <h1 class="mb-4">📓 メモ一覧</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3 text-end">
            <a href="{{ route('memos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> メモ作成
            </a>
        </div>

        <div class="row">
            @forelse ($memos as $memo)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $memo->title }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($memo->content, 100) }}
                            </p>
                            <div>
                                @foreach ($memo->tags as $tag)
                                    <span class="badge bg-primary">{{ $tag->name }}</span>
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
                <p>メモがありません</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $memos->links() }}
        </div>
    </div>
@endsection
