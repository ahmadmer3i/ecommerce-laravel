@extends('layouts.admin')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <livewire:backend.dashboard.statistics-component/>
    <livewire:backend.dashboard.chart-component/>
@endsection

