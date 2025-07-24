@extends('layouts.memosApp')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">📝 メモ作成</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('memos.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">タイトル <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}"
                    required maxlength="255" autofocus>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">内容 <span class="text-danger">*</span></label>
                <textarea id="content" name="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">保存する</button>
            <a href="{{ route('memos.index') }}" class="btn btn-secondary ms-2">キャンセル</a>
        </form>
    </div>
@endsection
