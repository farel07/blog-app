<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class Dashboard_postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'active' => 'posts'
        ];
        return view('dashboard.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/posts/create', [
            'active' => '',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('image')->store('posts-image');

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'image' => 'image|file|max:2048',
            'content' => 'required'
        ]);

        // cek user upload gambar apopa tidak
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('posts-image');
        }

        $validatedData['category_id'] = $request['category_id'];
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['content']), 200, ' ...');



        // masukkan data ke dalam database
        Post::create($validatedData);
        // return ke halaman post sambil kirim flsah message
        return redirect('/dashboard/posts')->with('success', 'New post added <span data-feather="check" class="align-text-bottom"></span>');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // cek post user
        if ($post->user->id !== auth()->user()->id) {
            abort(403);
        }

        $data = [
            'post' => $post,
            'active' => 'posts'
        ];

        return view('dashboard.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // cek post user
        if ($post->user->id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|file|max:2048'
        ];

        // cek apakah slug yang diubah (jika ya maka eri validasi)
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        // validasi data
        $validatedData = $request->validate($rules);

        // cek jika 
        if ($request->removeImage == 1) {
            Storage::delete($request->oldImage);
            $validatedData['image'] = '';
        }
        // cek user upload gambar apopa tidak
        if ($request->file('image')) {
            // cek apakah ada gambar lama 
            if ($request->oldImage) {
                // jika ada hapus gambar lama 
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('posts-image');
        }

        $validatedData['category_id'] = $request['category_id'];
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['content']), 200, ' ...');

        // update data pad database
        Post::where('id', $post->id)->update($validatedData);
        // rediect ke halaman posts dengan mengirimkan flash message
        return redirect('/dashboard/posts')->with('success', 'Post successfully updated <span data-feather="check" class="align-text-bottom"></span>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // hapus gambar jika ada
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post successfully deleted <span data-feather="check" class="align-text-bottom"></span>');
    }

    public function create_slug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
