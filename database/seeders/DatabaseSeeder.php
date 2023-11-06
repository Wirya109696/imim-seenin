<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Listmov;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'I Komang Wiryadana',
            'username' => 'Wirya10969',
            'email' => 'mangwirya@gmail.com',
            'password' => bcrypt(12345)
        ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Goverment',
            'slug' => 'goverment'
        ]);

        Category::create([
            'name' => 'Industry',
            'slug' => 'industry'
        ]);

        Category::create([
            'name' => 'Accident',
            'slug' => 'accident'
        ]);

        Listmov::factory(20)->create();

        // Listmov::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
        //     Ullam ad tenetur minus inventore ducimus fugit natus corporis, doloribus praesentium reiciendis magnam,
        //     repellendus nihil maxime libero possimus facilis, totam aut necessitatibus debitis veniam rem provident.
        //     Mollitia possimus illo enim dolore.</p><p> Vero, accusantium odit fuga corrupti reprehenderit nihil dolor,
        //     sapiente tempora soluta amet deserunt. Laudantium numquam, doloribus odit doloremque aliquam praesentium accusantium
        //     voluptates adipisci? Nesciunt eum porro nobis labore excepturi voluptatem nulla?</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Listmov::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
        //     Ullam ad tenetur minus inventore ducimus fugit natus corporis, doloribus praesentium reiciendis magnam,
        //     repellendus nihil maxime libero possimus facilis, totam aut necessitatibus debitis veniam rem provident.
        //     Mollitia possimus illo enim dolore.</p><p> Vero, accusantium odit fuga corrupti reprehenderit nihil dolor,
        //     sapiente tempora soluta amet deserunt. Laudantium numquam, doloribus odit doloremque aliquam praesentium accusantium
        //     voluptates adipisci? Nesciunt eum porro nobis labore excepturi voluptatem nulla?</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Listmov::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
        //     Ullam ad tenetur minus inventore ducimus fugit natus corporis, doloribus praesentium reiciendis magnam,
        //     repellendus nihil maxime libero possimus facilis, totam aut necessitatibus debitis veniam rem provident.
        //     Mollitia possimus illo enim dolore.</p><p> Vero, accusantium odit fuga corrupti reprehenderit nihil dolor,
        //     sapiente tempora soluta amet deserunt. Laudantium numquam, doloribus odit doloremque aliquam praesentium accusantium
        //     voluptates adipisci? Nesciunt eum porro nobis labore excepturi voluptatem nulla?</p>',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

    }
}

