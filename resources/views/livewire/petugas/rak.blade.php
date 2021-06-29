<div class="row">
    <div class="col-12">

    @include('admin-lte/flash')

    @include('petugas/rak/create')
    @include('petugas/rak/edit')
    @include('petugas/rak/delete')

    <div class="card">
        <div class="card-header">
        <span wire:click="create" class="btn btn-sm btn-primary">Tambah</span>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                <select wire:model="search" class="form-control float-right" id="exampleFormControlSelect1">
                    @foreach ($count as $item)
                        <option value="{{$item->rak}}">{{$item->rak}}</option>
                    @endforeach
                </select>

                <div class="input-group-append">
                    <button wire:click="formatSearch" type="submit" class="btn btn-default">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
            <!-- /.card-header -->
            @if ($raks->isNotEmpty())
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th width="10%">No</th>
                    <th>Rak</th>
                    <th>Baris</th>
                    <th>Kategori</th>
                    <th width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($raks as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->rak}}</td>
                        <td>{{$item->baris}}</td>
                        <td>{{$item->kategori->nama}}</td>
                        <td>
                            <div class="btn-group">
                                <span wire:click="edit({{$item->id}})" class="btn btn-sm btn-primary mr-2">Edit</span>
                                <span wire:click="delete({{$item ->id}})" class="btn btn-sm btn-danger">Hapus</span>
                            </div>
                        </td>
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
        {{$raks->links()}}
    </div>

    @if ($raks->isEmpty())
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