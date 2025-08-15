<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $tagId = $request->input('tag');
        $sort = $request->input('sort', 'latest');
        $query = Memo::where('user_id', Auth::id());

        if ($keyword) {
            //$keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%")
                    ->orWhereHas('tags', function ($q2) use ($keyword) {
                        $q2->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        if ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tag_id', $tagId);
            });
        }
        $query->orderByDesc('pinned');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $memos = $query->paginate(6);

        $activeTag = $tagId ? \App\Models\Tag::find($tagId) : null;

        return view('memos.index', compact('memos', 'keyword', 'sort', 'activeTag'));
    }

    //ゴミ箱
    public function trash()
    {
        $memos = Memo::onlyTrashed()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(6);
        return view('memos.trash', compact('memos'));
    }

    //論理削除
    public function destroy(string $id)
    {
        $memo = Memo::where('user_id', Auth::id())->findOrFail($id);
        $memo->delete();

        return redirect()->route('memos.index')->with('success', 'メモを削除しました');
    }

    //復元
    public function restore(string $id)
    {
        $memo = Memo::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);
        $memo->restore();

        return redirect()->route('memos.trash')->with('success', 'メモを復元しました');
    }

    //完全削除
    public function forceDelete(string $id)
    {
        $memo = Memo::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);
        $memo->forceDelete();

        return redirect()->route('memos.trash')->with('success', 'メモを完全に削除しました');
    }

    use AuthorizesRequests;

    //ピン留め
    public function togglePin(Memo $memo)
    {
        $this->authorize('update', $memo);
        $memo->pinned = !$memo->pinned;
        $memo->save();

        $message = $memo->pinned ? 'ピン留めしました' : 'ピン留め解除しました';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:50',
                'content' => 'required|string|max:1000',
                'tags' => 'nullable|string',
            ],
            [
                'title.required' => 'タイトルは必須です',
                'title.max' => 'タイトルは50文字以内で入力してください',
                'content.required' => '内容は必須です',
                'content.max' => '内容は1000文字以内で入力してください',
            ]
        );

        $memo = Memo::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        if (!empty($request->tags)) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            $tagId = [];
            foreach ($tagNames as $name) {
                if ($name === '') continue;
                $tag = Tag::firstOrCreate(['name' => $name]);
                $tagId[] = $tag->id;
            }
            $memo->tags()->sync($tagId);
        }

        return redirect()->route('memos.index')->with('success', 'メモを作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $memo = Memo::where('user_id', Auth::id())->findOrFail($id);
        return view('memos.show', compact('memo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $memo = Memo::where('user_id', Auth::id())->findOrFail($id);
        return view('memos.edit', compact('memo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:1000',
            'tags' => 'nullable|string',
        ], [
            'title.required' => 'タイトルは必須です',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'content.required' => '内容は必須です',
            'content.max' => '内容は1000文字以内で入力してください',
        ]);

        $memo = Memo::where('user_id', Auth::id())->findOrFail($id);
        $memo->update($request->only(['title', 'content']));

        if (!empty($request->tags)) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            $tagId = [];
            foreach ($tagNames as $name) {
                if ($name === '') continue;
                $tag = Tag::firstOrCreate(['name' => $name]);
                $tagId[] = $tag->id;
            }
            $memo->tags()->sync($tagId);
        } else {
            $memo->tags()->detach();
        }

        return redirect()->route('memos.show', $memo->id)->with('success', 'メモを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
}
