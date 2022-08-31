<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use  \App\Models\Post;
use  \App\Models\PostComment;
use App\Models\ReplyComment;
use  \App\Models\User;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->filter(request(['keyword', 'category', 'author']));

        $title = '';

        if (request('category')) {
            $title = ' in ' . Category::firstWhere('slug', request('category'))->name;
        }

        if (request('author')) {
            $title .= ' by ' . User::firstWhere('username', request('author'))->name;
        }

        $data = [
            'title' => 'All Posts',
            'active' => 'Blog',
            'posts' => $posts->paginate(7)->withQueryString(),
            'categories' => Category::get(),
            'header' => 'All Posts' . $title
        ];

        return view('blog', $data);
    }

    public function detail_post(Post $post)
    {
        $data = [
            'title' => $post->title,
            'active' => 'Blog',
            'post' => $post
        ];
        return view('post', $data);
    }

    public function comment(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required'
        ]);

        $validatedData['post_id'] = $request->post_id;
        $validatedData['user_id'] = auth()->user()->id;

        PostComment::create($validatedData);
        return redirect('/blog/' . $request->slug);
    }

    public function reply_comment(Request $request, PostComment $postComment)
    {
        $validatedData = $request->validate([
            'body' => 'required'
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['post_comment_id'] = $postComment->id;

        ReplyComment::create($validatedData);

        return redirect('/blog/' . $request->slug);
    }
}
