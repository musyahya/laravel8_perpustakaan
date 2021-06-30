<div class="row">
    <div class="col-12">

    @include('admin-lte/flash')

    <div class="btn-group mb-3">
        <button wire:click="format" class="btn btn-sm bg-teal mr-2">Semua</button>
        <button wire:click="belumDipinjam" class="btn btn-sm bg-indigo mr-2">Belum Dipinjam</button>
        <button wire:click="sedangDipinjam" class="btn btn-sm bg-olive mr-2">Sedang Dipinjam</button>
        <button wire:click="selesaiDipinjam" class="btn btn-sm bg-fuchsia mr-2">Selesai Dipinjam</button>
    </div>

    <div class="card">
        <div class="card-header">
        <span wire:click="create" class="btn btn-sm btn-primary">Tambah</span>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <input wire:model="search" type="search" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
            <!-- /.card-header -->
            @if ($transaksi->isNotEmpty())
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th width="10%">No</th>
                    <th>Kode Pinjam</th>
                    <th>Buku</th>
                    <th>Lokasi</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                   @if (!$selesai_dipinjam)
                        <th width="15%">Aksi</th>
                   @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kode_pinjam}}</td>
                        <td>
                            <ul>
                                @foreach ($item->detail_peminjaman as $detail_peminjaman)
                                <li>{{$detail_peminjaman->buku->judul}}</li>
                                @endforeach
                            </ul>
                        </td>
                       <td>
                            <ul>
                                @foreach ($item->detail_peminjaman as $detail_peminjaman)
                                <li>{{$detail_peminjaman->buku->rak->lokasi}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$item->tanggal_pinjam}}</td>
                        <td>{{$item->tanggal_kembali}}</td>
                        <td>{{$item->denda}}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge bg-indigo">Belum Dipinjam</span>
                            @elseif ($item->status == 2)
                                <span class="badge bg-olive">Sedang Dipinjam</span>
                            @else
                                <span class="badge bg-fuchsia">Selesai Dipinjam</span>
                            @endif
                        </td>
                       @if (!$selesai_dipinjam)
                            <td>
                                @if ($item->status == 1)
                                    <span wire:click="pinjam({{$item->id}})" class="btn btn-sm btn-success mr-2">Pinjam</span>
                                @elseif ($item->status == 2)
                                    <span wire:click="kembali({{$item->id}})" class="btn btn-sm btn-primary mr-2">Kembali</span>
                                @endif
                            </td>
                       @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      @endif
    </div>
    <!-- /.card -->

     <div class="row justify-content-center">
        {{$transaksi->links()}}
    </div>

    @if ($transaksi->isEmpty())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning">
                    Anda tidak memiliki data
                </div>
            </div>
        </div>
    @endif

    </div>
</div>
<!-- /.row -->