<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Page;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            ['name' => 'textblock'],
            ['name' => 'category'],
            ['name' => 'image'],
            ['name' => 'form'],
        ]);

        DB::table('templates')->insert([
            ['name' => 'homepage']
        ]);

        DB::table('textblock')->insert([
            ['title' => 'Test title', 'content' => 'content test here'],
            ['title' => 'Lorem ipsum dolor sit amet', 'content' => 'consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '],
            ['title' => 'Wilders ondermijnt parlementaire democratie', 'content' => 'DEN HAAG -
Dat PVV-leider Geert Wilders het parlement nep noemt, is een ondermijning van de parlementaire democratie. Dat stelde de voormalige voorzitter van de Tweede Kamer, Frans Weisglas, in het programma WNL op Zondag.'],
        ]);

        DB::table('category')->insert([
            ['title' => 'Category title'],
        ]);

        $root = Page::firstOrCreate([
            'title' => 'shell',
            'is_menu' => 0,
        ]);

        //make nl parts
        $child = $root->children()->create([
            'title' => 'menu',
            'is_menu' => 1,
            'template_id' => 1,
            'language' => 'nl'
        ]);
        $child->children()->create([
            'title' => 'home',
            'template_id' => 1,
        ]);
        $child->children()->create([
            'title' => 'gastenverblijven',
            'template_id' => 3,
        ]);
        $child->children()->create([
            'title' => 'omgeving',
            'template_id' => 2,
        ]);
        $child->children()->create([
            'title' => 'reserveren',
            'template_id' => 4,
        ]);
        $child->children()->create([
            'title' => 'reacties',
            'template_id' => 1,
        ]);
        $child->children()->create([
            'title' => 'prijzen',
            'template_id' => 1,
        ]);
        $child->children()->create([
            'title' => 'contact',
            'template_id' => 3,
        ]);


    }
}