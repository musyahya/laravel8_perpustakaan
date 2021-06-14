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

    public $create, $edit, $delete;
    public $nama, $penerbit_id;

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

        session()->flash('sukses', 'Data berhasil ditambahkan.');
        $this->format();
    }

    public function edit(ModelsPenerbit $penerbit)
    {
        $this->format();

        $this->edit = true;
        $this->nama = $penerbit->nama;
        $this->penerbit_id = $penerbit->id;
    }

    public function update(ModelsPenerbit $penerbit)
    {
        $this->validate();

        $penerbit->update([
            'nama' => $this->nama,
            'slug' => Str::slug($this->nama)
        ]);

        session()->flash('sukses', 'Data berhasil diubah.');
        $this->format();
    }

    public function delete(ModelsPenerbit $penerbit)
    {
        $this->delete = true;
        $this->penerbit_id = $penerbit->id;
    }

    public function destroy(ModelsPenerbit $penerbit)
    {
        $penerbit->delete();

        session()->flash('sukses', 'Data berhasil dihapus.');
        $this->format();
    }

    public function render()
    {
        return view('livewire.penerbit', [
            'penerbit' => ModelsPenerbit::latest()->paginate(5)
        ]);
    }

    public function format()
    {
        unset($this->create);
        unset($this->edit);
        unset($this->delete);
        unset($this->nama);
        unset($this->penerbit_id);
    }
}
