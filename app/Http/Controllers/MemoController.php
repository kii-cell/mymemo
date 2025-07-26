<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Illminate\Support\Str;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memos = Memo::where('user_id', Auth::id())
            ->latest()
            ->paginate(6);

        return view('memos.index', compact('memos'));
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
        $validated = $request->validate([
            'title' => 'required|',
            'content' => 'required',
        ]);

        $memo = new Memo();
        $memo->title = $validated['title'];
        $memo->content = $validated['content'];
        $memo->user_id = Auth::id();
        $memo->save();

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $memo = Memo::where('user_id', Auth::id())->findOrFail($id);
        $memo->title = $validated['title'];
        $memo->content = $validated['content'];
        $memo->save();

        return redirect()->route('memos.show', $memo->id)->with('success', 'メモを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $memo = Memo::where('user_id', Auth::id())->findOrFail($id);
        $memo->delete();

        return redirect()->route('memos.index')->with('success', 'メモを削除しました');
    }
}
