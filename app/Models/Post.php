<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;
    // $fillable : field yang boleh diisi
    // $guarded : field yang tidak boleh diisi
    protected $fillable = ['title', 'excerpt', 'content', 'slug', 'category_id', 'user_id', 'image'];
    protected $with = ['user', 'category'];

    public function category()
    {
        // belongsTo : haya memiliki satu id dari tabel yang berelasi
        // hasMany : satu tabel memiliki banya relasi
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(PostComment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function scopeFilter($query, $filters)
    {
        // query untuk mencari berdaasarkan keyword
        $query->when($filters['keyword'] ?? false, function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        });

        // query untuk mecari berdasarkan kategori
        $query->when($filters['category'] ?? false, function ($query, $category) {
            // whereHas : query mempunyai relasi terhadap apa....
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        // query untuk mencari berdasarkan author
        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas('user', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }
}
