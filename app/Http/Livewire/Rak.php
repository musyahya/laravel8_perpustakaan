<?php

namespace App\Http\Livewire;

use App\Models\Rak as ModelsRak;
use Livewire\Component;
use Livewire\WithPagination;

class Rak extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.rak', [
            'raks' => ModelsRak::latest()->paginate(3)
        ]);
    }
}
