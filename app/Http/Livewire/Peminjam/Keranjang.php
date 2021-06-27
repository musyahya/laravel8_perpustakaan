<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\Peminjaman;
use Livewire\Component;

class Keranjang extends Component
{
    public function render()
    {
        return view('livewire.peminjam.keranjang', [
            'keranjang' => Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first()
        ]);
    }
}
