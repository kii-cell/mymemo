<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memos = Memo::where('user_id',Auth::id())->get();
        return view('memos.index',compact('memos'));
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
        $memo->user_id = auth()->id();
        $memo->save();

        return redirect9()->route('memos.index')->with('success','メモを作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
