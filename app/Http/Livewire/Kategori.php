<?php

namespace App\Http\Livewire;

use App\Models\Kategori as ModelsKategori;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Kategori extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create, $edit, $nama, $kategori_id;

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

    public function render()
    {
        return view('livewire.kategori', [
            'kategori' => ModelsKategori::latest()->paginate(3)
        ]);
    }

    public function format()
    {
        unset($this->kategori_id);
        unset($this->nama);
        unset($this->create);
        unset($this->edit);
    }
}
