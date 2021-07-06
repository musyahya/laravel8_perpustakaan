@extends('admin-lte/app')
@section('title', 'Chart')
@section('active-chart', 'active')

@section('content')
    <livewire:petugas.chart></livewire:petugas.chart>
@endsection

@section('script')
    @include('admin-lte/script/chart')
@endsection

@section('chart-script')
    <livewire:petugas.chart-script></livewire:petugas.chart-script>
@endsection