<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Media;
use App\Models\Keyword;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('keyword_media')->truncate(); // Pivot table
        Media::truncate();
        User::truncate();
        Keyword::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        User::create([
            'login' => 'Artyom',
            'name' => 'Artyom',
            'theme_style' => 'dark',
            'density' => '10',
            'language' => 'en',
            'email' => 'artyom@example.com',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'login' => 'Yarik',
            'name' => 'Yarik',
            'theme_style' => 'dark',
            'density' => '10',
            'language' => 'en',
            'email' => 'yarik@example.com',
            'password' => bcrypt('secret'),
        ]);


        $k1 = Keyword::create(['name' => 'AI']);
        $k2 = Keyword::create(['name' => 'Laravel']);
        $k3 = Keyword::create(['name' => 'PHP']);
        $k4 = Keyword::create(['name' => 'Web']);
        $k5 = Keyword::create(['name' => 'Database']);


        $m1 = Media::create([
            'uuid' => Str::uuid(),
            'type' => 'image',
            'owner' => 'Artyom',
            'route' => 'uploads/PHP-logo-lossless.webp',
            'name' => 'PHP in 2025',
            'description' => 'This is PHP!',
        ]);
        $m2 = Media::create([
            'uuid' => Str::uuid(),
            'type' => 'text',
            'owner' => 'Yarik',
            'route' => 'uploads/text.txt',
            'name' => 'AI gone insane!',
            'description' => 'Oh no!!!'
        ]);

        // Привязываем keywords к media (многие ко многим)
        $m1->keywords()->attach([$k2->id, $k3->id, $k5->id]); // Laravel, PHP, Database
        $m2->keywords()->attach([$k1->id, $k4->id]);           // AI, Web
    }
}
