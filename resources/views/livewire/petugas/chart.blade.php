<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input wire:model="bulan_tahun" type="month" class="form-control" max="{{date('Y-m')}}">
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart" height="125"></canvas>
            </div>
        </div>
    </div>
</div>