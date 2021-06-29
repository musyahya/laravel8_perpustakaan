<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use App\Models\Kategori as ModelsKategori;
use App\Models\Rak;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Kategori extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create, $edit, $delete, $nama, $kategori_id, $search;

    protected $rules = [
        'nama' => 'required|min:5',
    ];

    public function create()
    {
        $this->format();

        $this->create = true;
    }

    public function store()
    {
        $this->validate();

        ModelsKategori::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan');

        $this->format();
    }

    public function edit(ModelsKategori $kategori)
    {
        $this->format();

        $this->edit = true;
        $this->nama = $kategori->nama;
        $this->kategori_id = $kategori->id;
    }

    public function update(ModelsKategori $kategori)
    {
        $this->validate();

        $kategori->update([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil diubah');

        $this->format();
    }

    public function delete($id)
    {
        $this->format();

        $this->delete = true;
        $this->kategori_id = $id;
    }

    public function destroy(ModelsKategori $kategori)
    {
        $rak = Rak::where('kategori_id', $kategori->id)->get();
        foreach ($rak as $key => $value) {
            $value->update([
                'kategori_id' => 1
            ]);
        }

        $buku = Buku::where('kategori_id', $kategori->id)->get();
        foreach ($buku as $key => $value) {
            $value->update([
                'kategori_id' => 1
            ]);
        }

        $kategori->delete();

        session()->flash('sukses', 'Data berhasil dihapus');

        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $kategori = ModelsKategori::latest()->where('nama', 'like', '%'. $this->search .'%')->paginate(5);
        } else {
            $kategori = ModelsKategori::latest()->paginate(5);
        }
        
        return view('livewire.petugas.kategori', [
            'kategori' => $kategori
        ]);
    }

    public function format()
    {
        unset($this->kategori_id);
        unset($this->nama);
        unset($this->create);
        unset($this->edit);
        unset($this->delete);
    }
}
