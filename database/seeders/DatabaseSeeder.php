<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // User::create([
        //     'name' => 'Airani Iofi15',
        //     'email' => 'anj@gmail.com',
        //     'password' => bcrypt('123qwe')
        // ]);
        User::create([
            'name' => 'Farrel Aqeel Danendra',
            'username' => 'farrelad07',
            'email' => 'farrqeel@gmail.com',
            'password' => bcrypt('asd123')
        ]);

        User::factory(10)->create();

        Category::create([
            'name' => 'Programming',
            'slug' => 'programming'
        ]);
        Category::create([
            'name' => 'Anime',
            'slug' => 'anime'
        ]);
        Category::create([
            'name' => 'Genshin Impact',
            'slug' => 'genshin-impact'
        ]);


        Post::factory(30)->create();

        // Post::create([
        //     'title' => 'Title 1',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'title-1',
        //     'excerpt' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nisi molestiae, necessitatibus iusto inventore quas earum soluta numquam excepturi ',
        //     'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nisi molestiae, necessitatibus iusto inventore quas earum soluta numquam excepturi cumque porro esse laborum voluptatibus culpa temporibus, facere eius, minima molestias tempora tenetur fuga nostrum libero praesentium error. Et quia, nostrum, ipsum hic nulla ut a accusamus alias laboriosam earum minima quod. Praesentium dolorum quo, pariatur quisquam deleniti optio, odit deserunt eius id expedita, aspernatur quaerat! Facilis, excepturi nemo in reiciendis voluptas fugiat enim ab consequatur odit alias cupiditate delectus voluptatibus? Amet quaerat autem aperiam modi corporis consectetur veritatis non consequuntur asperiores adipisci natus facilis enim iste dolorem aspernatur, sequi, odio animi sunt velit. Qui, quasi. Pariatur earum illo recusandae doloremque! Fugit praesentium atque quam commodi mollitia facere accusamus molestias suscipit.'

        // ]);
        // Post::create([
        //     'title' => 'Title 2',
        //     'category_id' => 2,
        //     'user_id' => 1,
        //     'slug' => 'title-2',
        //     'excerpt' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nisi molestiae, necessitatibus iusto inventore quas earum soluta numquam excepturi ',
        //     'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nisi molestiae, necessitatibus iusto inventore quas earum soluta numquam excepturi cumque porro esse laborum voluptatibus culpa temporibus, facere eius, minima molestias tempora tenetur fuga nostrum libero praesentium error. Et quia, nostrum, ipsum hic nulla ut a accusamus alias laboriosam earum minima quod. Praesentium dolorum quo, pariatur quisquam deleniti optio, odit deserunt eius id expedita, aspernatur quaerat! Facilis, excepturi nemo in reiciendis voluptas fugiat enim ab consequatur odit alias cupiditate delectus voluptatibus? Amet quaerat autem aperiam modi corporis consectetur veritatis non consequuntur asperiores adipisci natus facilis enim iste dolorem aspernatur, sequi, odio animi sunt velit. Qui, quasi. Pariatur earum illo recusandae doloremque! Fugit praesentium atque quam commodi mollitia facere accusamus molestias suscipit.'

        // ]);
        // Post::create([
        //     'title' => 'Title 3',
        //     'category_id' => 3,
        //     'user_id' => 2,
        //     'slug' => 'title-3',
        //     'excerpt' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nisi molestiae, necessitatibus iusto inventore quas earum soluta numquam excepturi ',
        //     'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nisi molestiae, necessitatibus iusto inventore quas earum soluta numquam excepturi cumque porro esse laborum voluptatibus culpa temporibus, facere eius, minima molestias tempora tenetur fuga nostrum libero praesentium error. Et quia, nostrum, ipsum hic nulla ut a accusamus alias laboriosam earum minima quod. Praesentium dolorum quo, pariatur quisquam deleniti optio, odit deserunt eius id expedita, aspernatur quaerat! Facilis, excepturi nemo in reiciendis voluptas fugiat enim ab consequatur odit alias cupiditate delectus voluptatibus? Amet quaerat autem aperiam modi corporis consectetur veritatis non consequuntur asperiores adipisci natus facilis enim iste dolorem aspernatur, sequi, odio animi sunt velit. Qui, quasi. Pariatur earum illo recusandae doloremque! Fugit praesentium atque quam commodi mollitia facere accusamus molestias suscipit.'

        // ]);
    }
}
