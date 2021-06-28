<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Livewire\Component;

class Keranjang extends Component
{
    public $tanggal_pinjam;

    protected $rules = [
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
    ];

    public function hapus(Peminjaman $peminjaman, DetailPeminjaman $detail_peminjaman)
    {
        if ($peminjaman->detail_peminjaman->count() == 1) {
            $detail_peminjaman->delete();
            $peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            redirect('/');
        } else {
            $detail_peminjaman->delete();
            session()->flash('sukses', 'Data berhasil dihapus');
            $this->emit('kurangiKeranjang');
        }  
    }

    public function hapusMasal()
    {
        $keranjang = Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first();
        foreach ($keranjang->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->delete();
        }
        $keranjang->delete();
        session()->flash('sukses', 'Data berhasil dihapus');
        redirect('/');
    }

    public function pinjam(Peminjaman $keranjang)
    {
        $this->validate();

        $keranjang->update([
            'status' => 1,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => Carbon::create($this->tanggal_pinjam)->addDays(10)
        ]);

        session()->flash('sukses', 'Buku berhasil dipinjam');
    }

    public function render()
    {
        $keranjang = Peminjaman::latest()->where('peminjam_id', auth()->user()->id)->where('status', '!=', 3)->first();
        if (!$keranjang) {
            redirect('/');
        }
        return view('livewire.peminjam.keranjang', [
            'keranjang' => $keranjang
        ]);
    }
}
