<?php

namespace App\Http\Livewire;

use App\Models\Penerbit as ModelsPenerbit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Penerbit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $create;
    public $nama;

    protected $rules = [
        'nama' => 'required',
    ];

    public function create()
    {
        $this->create = true;
    }

    public function store()
    {
        $this->validate();

        ModelsPenerbit::create([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data bserhasil ditambahkan.');
        $this->format();
    }

    public function render()
    {
        return view('livewire.penerbit', [
            'penerbit' => ModelsPenerbit::latest()->paginate(1)
        ]);
    }

    public function format()
    {
        unset($this->create);
        unset($this->nama);
    }
}
