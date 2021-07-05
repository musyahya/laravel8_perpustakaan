<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach ($tanggal_pengembalian as $item)
                {{$item}},
            @endforeach
        ],
        datasets: [{
            label: 'Selesai Dipinjam',
            data: [
                @foreach ($count as $item)
                    {{$item}},
                @endforeach
            ],
            backgroundColor: '#f012be',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
