@extends('layouts.admin')

@section('title', 'Home - Rescate Animales')

@push('styles')
<style>
    /* Estilos personalizados para las tarjetas */
    .custom-card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease-in-out;
        border: none;
    }
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    .custom-card .card-body {
        padding: 1.5rem;
    }
    .custom-card .card-title {
        font-weight: 600;
        color: #333;
    }
    .custom-card .card-text {
        color: #666;
    }
    .custom-card .icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #007bff;
    }
</style>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Tarjetas estilo Google UI/UX -->
        <div class="row">
            <div class="col-lg-3 col-6"><div class="card custom-card"><div class="card-body text-center"><div class="icon"><i class="fas fa-dog"></i></div><h5 class="card-title">Animales Rescatados</h5><p class="card-text">150</p></div></div></div>
            <div class="col-lg-3 col-6"><div class="card custom-card"><div class="card-body text-center"><div class="icon"><i class="fas fa-hand-holding-heart"></i></div><h5 class="card-title">Adopciones</h5><p class="card-text">75</p></div></div></div>
            <div class="col-lg-3 col-6"><div class="card custom-card"><div class="card-body text-center"><div class="icon"><i class="fas fa-users"></i></div><h5 class="card-title">Voluntarios</h5><p class="card-text">30</p></div></div></div>
            <div class="col-lg-3 col-6"><div class="card custom-card"><div class="card-body text-center"><div class="icon"><i class="fas fa-dollar-sign"></i></div><h5 class="card-title">Donaciones</h5><p class="card-text">$5,200</p></div></div></div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection