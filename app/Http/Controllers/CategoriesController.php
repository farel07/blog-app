<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Categories',
            'active' => 'Categories',
            'categories' => Category::all()
        ];
        return view('categories', $data);
    }

    public function category(Category $category)
    {
        $data = [
            'title' => $category->name . ' posts',
            'active' => 'Blog',
            'posts' => $category->posts->load('user', 'category'),
            'header' => 'Post with <b>' . $category->name . '</b> category'
        ];
        return view('blog', $data);
    }
}
