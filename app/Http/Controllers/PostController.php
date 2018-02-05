<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $file_name = time() . '.' . $attachment->getClientOriginalExtension();
            $data['attachment'] = $file_name;
            $attachment->move("files/", $file_name);
        }
        $post = new Post;
        $post->fill($data)->save();
        return redirect()->route('post.index');
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $file_name = time() . '.' . $attachment->getClientOriginalExtension();
            $data['attachment'] = $file_name;
            $attachment->move("files/", $file_name);
        }
        $post = Post::find($id);
        $post->update($data);
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
}
