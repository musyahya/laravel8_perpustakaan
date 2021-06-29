<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak as ModelsRak;
use Livewire\Component;
use Livewire\WithPagination;

class Rak extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create, $edit, $delete;
    public $rak, $baris, $kategori, $kategori_id, $rak_id, $search;

    protected $validationAttributes = [
        'kategori_id' => 'kategori'
    ];

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

    public function edit(ModelsRak $rak)
    {
        $this->format();

        $this->edit = true;
        $this->rak_id = $rak->id;
        $this->rak = $rak->rak;
        $this->baris = $rak->baris;
        $this->kategori_id = $rak->kategori_id;
        $this->kategori = Kategori::all();
    }

    public function update(ModelsRak $rak)
    {
        $rak_lama = ModelsRak::find($this->rak_id);

        if ($rak_lama->rak == $this->rak) {
            $rak_baru = ModelsRak::select('baris')->where('rak', $this->rak)->where('baris', '!=', $rak_lama->baris)->get()->implode('baris', ',');
        } else {
            $rak_baru = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');
        }
        
        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_baru,
            'kategori_id' => 'required|numeric|min:1',
        ]);

        $rak->update(['rak' => $this->rak,
            'baris' => $this->baris,
            'kategori_id' => $this->kategori_id,
            'slug' => $this->rak . '-' . $this->baris
    ]);

        session()->flash('sukses', 'Data berhasil diubah.');

        $this->format();
    }

    public function delete(ModelsRak $rak)
    {
        $this->delete = true;
        $this->rak_id = $rak->id;
    }

    public function destroy(ModelsRak $rak)
    {
        $buku = Buku::where('rak_id', $rak->id)->get();
        foreach ($buku as $key => $value) {
            $value->update([
                'rak_id' => 1
            ]);
        }
        $rak->delete();

        session()->flash('sukses', 'Data berhasil dihapus.');

        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $raks = ModelsRak::latest()->where('rak', $this->search)->paginate(5);
        } else {
            $raks = ModelsRak::latest()->paginate(5);
        }
        $count = ModelsRak::select('rak')->distinct()->get();
        
        return view('livewire.petugas.rak', compact('raks', 'count'));
    }

    public function format()
    {
        unset($this->create);
        unset($this->edit);
        unset($this->delete);
        unset($this->rak_id);
        unset($this->rak);
        unset($this->baris);
        unset($this->kategori_id);
        unset($this->kategori);
    }

    public function formatSearch()
    {
        $this->search = false;
    }
}
