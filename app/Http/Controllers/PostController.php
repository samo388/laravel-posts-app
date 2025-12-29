<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // عرض كل البوستات للمستخدم الحالي
    public function index()
    {
        $posts = auth()->user()->posts()->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // صفحة إنشاء بوست جديد
    public function create()
    {
        return view('posts.create');
    }

    // حفظ بوست جديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        auth()->user()->posts()->create([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post created successfully');
    }

    // عرض بوست واحد
    public function show(Post $post)
    {
        // تأكيد إن البوست يخص المستخدم
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        return view('posts.show', compact('post'));
    }

    // صفحة التعديل
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    // تحديث البوست
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post updated successfully');
    }

    // حذف بوست
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully');
    }
}
