<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'published_year',
        'author_id',
    ];

    // Relasi: Buku dimiliki oleh 1 penulis
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}