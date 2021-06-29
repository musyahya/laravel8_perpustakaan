<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $belum_dipinjam, $sedang_dipinjam, $selesai_dipinjam;

    public function belumDipinjam()
    {
        $this->format();
        $this->belum_dipinjam = true;
    }

    public function sedangDipinjam()
    {
        $this->format();
        $this->sedang_dipinjam = true;
    }

    public function selesaiDipinjam()
    {
        $this->format();
        $this->selesai_dipinjam = true;
    }

    public function render()
    {
        if ($this->belum_dipinjam) {
            $transaksi = Peminjaman::latest()->where('status', 1)->paginate(5);
        }elseif ($this->sedang_dipinjam) {
            $transaksi = Peminjaman::latest()->where('status', 2)->paginate(5);
        }elseif ($this->selesai_dipinjam) {
            $transaksi = Peminjaman::latest()->where('status', 3)->paginate(5);
        } else {
            $transaksi = Peminjaman::latest()->where('status', '!=', 0)->paginate(5);
        }
        
        return view('livewire.petugas.transaksi', [
            'transaksi' => $transaksi
        ]);
    }

    public function format()
    {
        $this->sedang_dipinjam = false;
        $this->belum_dipinjam = false;
        $this->selesai_dipinjam = false;
    }
}
