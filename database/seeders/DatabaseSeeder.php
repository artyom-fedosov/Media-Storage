<?php

namespace Database\Seeders;


use App\Models\Setting;
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
            'login' => 'User',
            'name' => 'User',
            'language' => 'en',
            'email' => 'user@example.com',
            'password' => bcrypt('secret'),
            'role' => 'simple'
        ]);
        User::create([
            'login' => 'Artyom',
            'name' => 'Artyom',
            'language' => 'en',
            'email' => 'artyom@example.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
        ]);
        User::create([
            'login' => 'Yarik',
            'name' => 'Yarik',
            'language' => 'en',
            'email' => 'yarik@example.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
        ]);

        Setting::create([
            'theme_style' => 'light',
            'density' => 'comfortable',
            'user_login' => 'User'
        ]);
        Setting::create([
            'theme_style' => 'light',
            'density' => 'comfortable',
            'user_login' => 'Artyom'
        ]);
        Setting::create([
            'theme_style' => 'dark',
            'density' => 'compact',
            'user_login' => 'Yarik'
        ]);
    }
}
