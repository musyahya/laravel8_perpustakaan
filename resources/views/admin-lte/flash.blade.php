@if (session('sukses'))
    <div class="alert alert-success">
        {{session('sukses')}}
    </div>
@endif
@if (session('gagal'))
    <div class="alert alert-danger">
        {{session('gagal')}}
    </div>
@endif