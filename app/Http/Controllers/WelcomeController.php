<?php

namespace App\Http\Controllers;

use App\Models\Author;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ambil semua author + relasi book-nya
        return Author::with('books')->get();
    }
}
