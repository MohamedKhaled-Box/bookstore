<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'buissnes']);
        Category::create(['name' => 'buissnes2']);
        Category::create(['name' => 'buissnes3']);
        Category::create(['name' => 'buissnes4']);
        Category::create(['name' => 'buissnes5']);
    }
}
