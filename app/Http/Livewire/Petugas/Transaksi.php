<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.petugas.transaksi', [
            'transaksi' => Peminjaman::latest()->where('status', '!=', 0)->paginate(5)
        ]);
    }
}
