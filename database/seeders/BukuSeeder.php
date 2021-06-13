<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'judul' => 'bintang',
            'slug' => Str::slug('bintang'),
            'sampul' => 'Sampul_novel_Bintang.jpeg',
            'penulis' => 'tere liye',
            'penerbit_id' => 1,
            'kategori_id' => 2,
            'rak_id' => 1,
            'stok' => 10
        ]);

        Buku::create([
            'judul' => 'matahari',
            'slug' => Str::slug('matahari'),
            'sampul' => 'Sampul_novel_Matahari.jpeg',
            'penulis' => 'tere liye',
            'penerbit_id' => 1,
            'kategori_id' => 2,
            'rak_id' => 1,
            'stok' => 10
        ]);
    }
}
