<?php

namespace App\Models;


class Post
{
    private static $posts = [
        [
            'username' => 'Farrel ad',
            'slug' => 'judul-pt-1',
            'title' => 'judul pt 1',
            'content' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis illum pariatur nobis velit perferendis omnis blanditiis recusandae animi? Adipisci laudantium perspiciatis nihil accusamus quis iste distinctio sint laborum, reiciendis assumenda labore. Dolorem laborum esse quasi deserunt, necessitatibus repellendus magnam in inventore laboriosam, reprehenderit porro minima quisquam voluptate fuga perspiciatis omnis itaque qui quod! Expedita saepe culpa vel eius ipsum voluptate atque consectetur doloribus consequuntur nulla, sapiente in sit quidem soluta placeat est itaque. Dolorum harum, id quibusdam facere doloremque fugiat!'
        ],
        [
            'username' => 'Airani Iofi15',
            'slug' => 'judul-pt-2',
            'title' => 'judul pt 2',
            'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum expedita nobis sed itaque vitae similique eveniet ipsa ullam tempore deleniti. Incidunt dolores magni quisquam corporis fugiat at debitis, ex doloribus. Accusantium harum rem libero, exercitationem at nemo consequatur porro ratione molestiae iure laudantium recusandae inventore qui deleniti, corrupti ipsum voluptatibus, vero fugiat expedita id repellendus sapiente tenetur. Vel voluptatum autem adipisci quos inventore possimus architecto exercitationem est officiis. Hic, eveniet aspernatur eligendi nulla quis rerum.'
        ]
    ];

    public static function all()
    {
        // menggunakan keyword self karena nilai yang dikembalikan bersifat static
        return collect(self::$posts);
    }

    public static function detail_post($slug)
    {
        $posts = static::all();
        $detail_post = $posts->firstWhere('slug', $slug);

        return $detail_post;
    }
}
