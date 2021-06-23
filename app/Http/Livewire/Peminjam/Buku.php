<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\Buku as ModelsBuku;
use Livewire\Component;
use Livewire\WithPagination;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.peminjam.buku', [
            'buku' => ModelsBuku::latest()->paginate(12)
        ]);
    }
}
