@extends('layouts.memosApp')

@section('content')
    <div class = "container">
        <h1>メモ一覧</h1>

        @if ($memos->isEmpty())
            <p>メモがありません。</p>
        @else
            <ul>
                @foreach ($memos as $memo)
                    <li>
                        <a href = "{{ route('memos.show', $memo->id) }}">{{ $memo->title }}</a>
                        <small>(作成日: {{ $memo->created_at->format('Y-m-d') }})</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
