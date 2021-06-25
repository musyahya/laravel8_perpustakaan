<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h1>{{$title}}</h1>
        </div>
    </div>

    @if ($detail_buku)
        
        <div class="row">
            <div class="col-md-4">
                <img src="/storage/{{$buku->sampul}}" alt="{{$buku->judul}}" width="300" height="400">
            </div>
            <div class="col-md-8">
                 <table class="table">
                  <tbody>
                    <tr>
                      <th>Judul</th>
                      <td>:</td>
                      <td>{{$buku->judul}}</td>
                    </tr>
                    <tr>
                      <th>Penulis</th>
                      <td>:</td>
                      <td>{{$buku->penulis}}</td>
                    </tr>
                    <tr>
                      <th>Kategori</th>
                      <td>:</td>
                      <td>{{$buku->kategori->nama}}</td>
                    </tr>
                    <tr>
                      <th>Penerbit</th>
                      <td>:</td>
                      <td>{{$buku->penerbit->nama}}</td>
                    </tr>
                    <tr>
                      <th>Rak</th>
                      <td>:</td>
                      <td>{{$buku->rak->rak}}</td>
                    </tr>
                    <tr>
                      <th>Baris</th>
                      <td>:</td>
                      <td>{{$buku->rak->baris}}</td>
                    </tr>
                    <tr>
                      <th>Stok</th>
                      <td>:</td>
                      <td>{{$buku->stok}}</td>
                    </tr>
                  </tbody>
                </table>

                <button class="btn btn-success">Pinjam</button>
            </div>
        </div>

    @else
    
        @if ($buku->isNotEmpty())
    
            <div class="row">
                @foreach ($buku as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div wire:click="detailBuku({{$item->id}})" class="card mb-4 shadow" style="cursor: pointer">
                        <img src="/storage/{{$item->sampul}}" class="card-img-top" alt="{{$item->judul}}" width="200" height="300">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{$item->judul}}</strong></h5>
                            <p class="card-text">{{$item->penulis}}</p>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                {{$buku->links()}}
            </div>

        @else

            <div class="alert alert-danger">
                Data tidak ada
            </div>
        @endif

    @endif
    
</div>