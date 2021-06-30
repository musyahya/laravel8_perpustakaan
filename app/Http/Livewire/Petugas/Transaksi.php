<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $belum_dipinjam, $sedang_dipinjam, $selesai_dipinjam, $search;

    public function belumDipinjam()
    {
        $this->format();
        $this->belum_dipinjam = true;
    }

    public function sedangDipinjam()
    {
        $this->format();
        $this->sedang_dipinjam = true;
    }

    public function selesaiDipinjam()
    {
        $this->format();
        $this->selesai_dipinjam = true;
    }

    public function pinjam(Peminjaman $peminjaman)
    {
        foreach ($peminjaman->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->buku->update([
                'stok' => $detail_peminjaman->buku->stok -1
            ]);
        }

        $peminjaman->update([
            'petugas_pinjam' => auth()->user()->id,
            'status' => 2
        ]);

        session()->flash('sukses', 'Buku berhasil dipinjam.');
    }

    public function kembali(Peminjaman $peminjaman)
    {
        $data = [
            'status' => 3,
            'petugas_kembali' => auth()->user()->id,
            'tanggal_pengembalian' => today(),
            'denda' => 0
        ];

        foreach ($peminjaman->detail_peminjaman as $detail_peminjaman) {
            $detail_peminjaman->buku->update([
                'stok' => $detail_peminjaman->buku->stok + 1
            ]);
        }

        if (Carbon::create($peminjaman->tanggal_kembali)->lessThan(today())) {
            $denda = Carbon::create($peminjaman->tanggal_kembali)->diffInDays(today());
            $denda *= 1000;
            $data['denda'] = $denda;
        }
        
        $peminjaman->update($data);
        session()->flash('sukses', 'Buku berhasil dikembalikan.');
    }

    public function render()
    {
        if ($this->search) {
            if ($this->belum_dipinjam) {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', 1)->paginate(5);
            } elseif ($this->sedang_dipinjam) {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', 2)->paginate(5);
            } elseif ($this->selesai_dipinjam) {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', 3)->paginate(5);
            } else {
                $transaksi = Peminjaman::latest()->where('kode_pinjam', 'like', '%'. $this->search .'%')->where('status', '!=', 0)->paginate(5);
            }
        } else {
            if ($this->belum_dipinjam) {
                $transaksi = Peminjaman::latest()->where('status', 1)->paginate(5);
            } elseif ($this->sedang_dipinjam) {
                $transaksi = Peminjaman::latest()->where('status', 2)->paginate(5);
            } elseif ($this->selesai_dipinjam) {
                $transaksi = Peminjaman::latest()->where('status', 3)->paginate(5);
            } else {
                $transaksi = Peminjaman::latest()->where('status', '!=', 0)->paginate(5);
            }
        }
    
        return view('livewire.petugas.transaksi', [
            'transaksi' => $transaksi
        ]);
    }

    public function format()
    {
        $this->sedang_dipinjam = false;
        $this->belum_dipinjam = false;
        $this->selesai_dipinjam = false;
    }
}
