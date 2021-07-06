<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['kode_pinjam', 'peminjam_id', 'petugas_pinjam', 'petugas_kembali', 'status', 'denda', 'tanggal_pinjam', 'tanggal_kembali', 'tanggal_pengembalian'];

    // relation
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // accesor
    public function getDendaAttribute($value)
    {
        return $value ? "Rp. {$value}" : '-' ;
    }
   
    public function getTanggalPinjamAttribute($value)
    {
        return Carbon::create($value)->format('d-M-Y');
    }
   
    public function getTanggalKembaliAttribute($value)
    {
        return Carbon::create($value)->format('d-M-Y');
    }
   
    public function getTanggalPengembalianAttribute($value)
    {
        return Carbon::create($value)->format('d-M-Y');
    }
}
