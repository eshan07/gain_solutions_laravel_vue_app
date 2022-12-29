<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'level' => 1,
            'name' => 'Tools and Home Improvement',
            'slug' => Str::slug('tools and home improvement'),
        ]);
        //2
        Category::create([
            'level' => 1,
            'name' => 'Beauty and personal care',
            'slug' => 'beauty-personal-care',
        ]);
        //3
        Category::create([
            'level' => 1,
            'name' => 'Clothing',
            'slug' => 'clothing',
        ]);
        //4
        Category::create([
            'level' => 1,
            'name' => 'Agriculture',
            'slug' => 'tools and home improvement',
        ]);

        DB::table('categories')->insert([
            //5
            [
                'level' => 2,
                'parent_id'=>1,
                'name' => 'Lighting',
                'slug' => 'lighting',
            ],
            //6
            [
                'level' => 2,
                'parent_id'=>1,
                'name' => 'Fan',
                'slug' => 'fan',
            ],
            //7
            [
                'level' => 2,
                'parent_id'=>1,
                'name' => 'Power and Hand Tools',
                'slug' => Str::slug('Power and Hand Tools'),
            ],
        ]);
    }
}
