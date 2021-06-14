<?php

namespace App\Http\Livewire;

use App\Models\Penerbit as ModelsPenerbit;
use Livewire\Component;
use Livewire\WithPagination;

class Penerbit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.penerbit', [
            'penerbit' => ModelsPenerbit::latest()->paginate(1)
        ]);
    }
}
