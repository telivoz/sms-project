@extends('layouts.master')
@section('content')
<h1>Dashboard</h1>
<a>{{$statusOK}}
<canvas id="perDay"></canvas>
<script>
const ctx = document.getElementById('perDay');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Delivered', 'No Reply', 'Not Delivered', 'Rejected', 'Failure'],
        datasets: [{
            label: '# SMS Today - {{ \Carbon\Carbon::now()->toDateString() }}',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
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
<br><br>
<canvas id="perMonth"></canvas>
<script>
const ctx2 = document.getElementById('perMonth');
const myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Delivered', 'No Reply', 'Not Delivered', 'Rejected', 'Failure'],
        datasets: [{
            label: '# SMS Month - {{ \Carbon\Carbon::now()->toDateString() }}',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
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
@endsection
