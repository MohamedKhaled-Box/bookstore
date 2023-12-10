<?php

namespace Database\Seeders;

use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book1 = Book::create([
            'category_id' => Category::where('name', 'buissnes')->first()->id,
            'Publisher_id' => Publisher::where('name', 'Box')->first()->id,
            'title' => 'remote hiring',
            'description' => 'description test',
            'number_of_copies' => '300',
            'number_of_pages' => '288',
            'price' => '17',
            'isbn' => '100000000',
            'cover_image' => 'images/covers/1.png'

        ]);
        $book1->authors()->attach(Author::where('name', 'ahmed mohamed')->first());
        $book2 = Book::create([
            'category_id' => Category::where('name', 'buissnes2')->first()->id,
            'Publisher_id' => Publisher::where('name', 'Box')->first()->id,
            'title' => 'remote hirings',
            'description' => 'description testt',
            'number_of_copies' => '209',
            'number_of_pages' => '258',
            'price' => '12',
            'isbn' => '1000',
            'cover_image' => 'images/covers/2.png'


        ]);
        $book2->authors()->attach(Author::where('name', 'ahmed x')->first());
    }
}
