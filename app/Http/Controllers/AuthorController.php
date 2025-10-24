<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // Ambil semua author beserta buku-bukunya
        $authors = Author::with('books')->get();
        return response()->json($authors);
    }
}