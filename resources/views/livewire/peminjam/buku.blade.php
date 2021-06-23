<div class="container">
    <div class="row">
        <h1>Semua Buku</h1>
    </div>

    <div class="row">
        @foreach ($buku as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4 shadow" style="cursor: pointer">
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
</div>