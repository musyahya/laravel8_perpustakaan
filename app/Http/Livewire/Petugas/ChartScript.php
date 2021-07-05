<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartScript extends Component
{
    public $bulan_tahun;

    public function mount()
    {
        $this->bulan_tahun = date('Y-m');
    }

    public function render()
    {
        $bulan = substr($this->bulan_tahun, -2);
        $tahun = substr($this->bulan_tahun, 0, 4);

        $selesai_dipinjam = Peminjaman::select(DB::raw('count(*) as count, tanggal_pengembalian'))
            ->groupBy('tanggal_pengembalian')
            ->whereMonth('tanggal_pengembalian', $bulan)
            ->whereYear('tanggal_pengembalian', $tahun)
            ->where('status', 3)
            ->get();
            
        $count = [];
        foreach ($selesai_dipinjam as $item) {
            $count[] = $item->count;
        }
            
        $tanggal_pengembalian = [];
        foreach ($selesai_dipinjam as $item) {
            $tanggal_pengembalian[] = substr($item->tanggal_pengembalian, -2);
        }

        return view('livewire.petugas.chart-script', compact('count', 'tanggal_pengembalian'));
    }
}
