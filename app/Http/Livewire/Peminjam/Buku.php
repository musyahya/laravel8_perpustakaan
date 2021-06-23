<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['pilihKategori', 'semuaKategori'];

    public $kategori_id, $pilih_kategori;

    public function pilihKategori($id)
    {
        $this->kategori_id = $id;
        $this->pilih_kategori = true;
        $this->updatingSearch();
    }

    public function semuaKategori()
    {
        $this->pilih_kategori = false;
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->pilih_kategori) {
            $buku = ModelsBuku::latest()->where('kategori_id', $this->kategori_id)->paginate(12);
            $title = Kategori::find($this->kategori_id)->nama;
        } else {
            $buku = ModelsBuku::latest()->paginate(12);
            $title = 'Semua Buku';
        }
        
        return view('livewire.peminjam.buku', compact('buku', 'title'));
    }
}
