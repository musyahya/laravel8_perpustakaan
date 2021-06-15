<?php

namespace App\Http\Livewire;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Rak;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $create;
    public $kategori, $rak, $penerbit;
    public $kategori_id, $rak_id, $penerbit_id;
    public $judul, $stok, $penulis, $sampul;

    protected $rules = [
        'judul' => 'required',
        'penulis' => 'required',
        'stok' => 'required|numeric|min:1',
        'sampul' => 'required|image|max:1024',
        'kategori_id' => 'required|numeric|min:1',
        'rak_id' => 'required|numeric|min:1',
        'penerbit_id' => 'required|numeric|min:1',
    ];

    protected $validationAttributes = [
        'kategori_id' => 'kategori',
        'rak_id' => 'rak',
        'penerbit_id' => 'penerbit',
    ];

    public function create()
    {
        $this->format();

        $this->create = true;
        $this->kategori = Kategori::all();
        $this->rak = Rak::all();
        $this->penerbit = Penerbit::all();
    }

    public function store()
    {
        $this->validate();

        $this->sampul = $this->sampul->store('buku', 'public');

        ModelsBuku::create([
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'stok' => $this->stok,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'penerbit_id' => $this->penerbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');
        $this->format();
    }

    public function render()
    {
        return view('livewire.buku', [
            'buku' => ModelsBuku::latest()->paginate(5)
        ]);
    }

    public function format()
    {
        unset($this->create);
        unset($this->judul);
        unset($this->sampul);
        unset($this->stok);
        unset($this->penulis);
        unset($this->kategori);
        unset($this->penerbit);
        unset($this->rak);
        unset($this->rak_id);
        unset($this->penerbit_id);
        unset($this->kategori_id);
    }
}
