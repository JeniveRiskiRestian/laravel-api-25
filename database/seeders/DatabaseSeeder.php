<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat beberapa penulis
        Author::factory()
            ->count(5)
            ->has(Book::factory()->count(2)) // setiap author punya 2 buku
            ->create();
    }
}