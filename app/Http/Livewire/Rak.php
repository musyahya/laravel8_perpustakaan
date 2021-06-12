<?php

namespace App\Http\Livewire;

use App\Models\Kategori;
use App\Models\Rak as ModelsRak;
use Livewire\Component;
use Livewire\WithPagination;

class Rak extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create;
    public $rak, $baris, $kategori, $kategori_id;

    public function create()
    {
        $this->create = true;
        $this->kategori = Kategori::all();
    }

    public function store()
    {
        $rak_pilihan = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');
       
        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_pilihan,
            'kategori_id' => 'required|numeric|min:1',
        ]);
        
        ModelsRak::create([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'kategori_id' => $this->kategori_id,
            'slug' => $this->rak .'-' .$this->baris
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');

        $this->format();
    }

    public function render()
    {
        return view('livewire.rak', [
            'raks' => ModelsRak::latest()->paginate(3)
        ]);
    }

    public function format()
    {
        unset($this->create);
        unset($this->rak);
        unset($this->baris);
        unset($this->kategori_id);
        unset($this->kategori);
    }
}
