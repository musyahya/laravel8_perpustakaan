<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['judul', 'stok', 'sampul', 'slug', 'penulis', 'kategori_id', 'rak_id', 'penerbit_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
