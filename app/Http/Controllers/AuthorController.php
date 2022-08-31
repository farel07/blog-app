<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function posts(User $user)
    {
        $author = $user->name;
        $data = [
            'title' => $author . ' Posts',
            'active' => 'Blog',
            'posts' => $user->posts->load('category', 'user'),
            'header' => $author . ' posts'
        ];

        return view('/blog', $data);
    }
}
