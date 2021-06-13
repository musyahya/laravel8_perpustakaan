 @if ($edit)
        <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Edit Rak</h4>
                <span wire:click="format" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rak">Rak</label>
                        <input wire:model="rak" type="number" class="form-control" id="rak" min="1">
                        @error('rak') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="baris">Baris</label>
                        <input wire:model="baris" type="number" class="form-control" id="baris" min="1">
                        @error('baris') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select wire:model="kategori_id" class="form-control" id="kategori">
                            @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <span wire:click="format" type="button" class="btn btn-default" data-dismiss="modal">Batal</span>
                <span type="button" wire:click="update({{$rak_id}})" class="btn btn-success">Update</span>
                </div>
            </div>
            </div>
        </div>
    @endif