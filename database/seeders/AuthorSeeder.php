<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create(['name' => 'ahmed mohamed']);
        Author::create(['name' => 'ahmed c']);
        Author::create(['name' => 'ahmed s']);
        Author::create(['name' => 'ahmed v']);
        Author::create(['name' => 'ahmed moxhamed']);
        Author::create(['name' => 'ahmed s']);
    }
}