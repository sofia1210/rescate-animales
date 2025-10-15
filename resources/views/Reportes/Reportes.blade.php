@extends('layouts.admin')

@section('title', 'Reportes - Rescate Animales')

@push('styles')
<style>
    /* Estilos personalizados para el gráfico de barras verticales */
    .chart-bar {
        width: 50px;
        border-radius: 5px 5px 0 0; /* Bordes superiores redondeados */
    }
    .bar-chart-container {
        height: 180px; /* Un poco más de altura para el gráfico */
        text-align: center;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
    }
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="m-0">Tablero de reportes</h1>
                <p class="text-muted mb-0">Periodo: 1/9/2025 - 5/10/2025</p>
            </div>
            <a href="#" class="btn btn-primary mt-2 mt-md-0">
                <i class="fas fa-file-pdf mr-2"></i> Exportar PDF
            </a>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6"><div class="small-box bg-primary"><div class="inner"><h3>2</h3><p>Animales en Total</p></div><div class="icon"><i class="fas fa-paw"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3>1</h3><p>Con evaluaciones</p></div><div class="icon"><i class="fas fa-stethoscope"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3>1</h3><p>Buena salud</p></div><div class="icon"><i class="fas fa-heart"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3>1</h3><p>Mala salud</p></div><div class="icon"><i class="fas fa-heart-broken"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-teal"><div class="inner"><h3>1</h3><p>Domésticos</p></div><div class="icon"><i class="fas fa-cat"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3>1</h3><p>Silvestres</p></div><div class="icon"><i class="fas fa-kiwi-bird"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-secondary"><div class="inner"><h3>3</h3><p>Rescatistas</p></div><div class="icon"><i class="fas fa-users"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-purple"><div class="inner"><h3>1</h3><p>Veterinarios</p></div><div class="icon"><i class="fas fa-user-md"></i></div></div></div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-success card-outline">
                    <div class="card-header"><h3 class="card-title"><i class="far fa-chart-bar"></i> Rescates últimos 6 meses</h3></div>
                    <div class="card-body">
                        <div class="bar-chart-container d-flex align-items-end justify-content-around">
                            <div>
                                <div class="chart-bar bg-gradient-success" style="height: 100%;"></div>
                                <p class="text-center mt-2 font-weight-bold">sept</p>
                            </div>
                            <div>
                                <div class="chart-bar bg-gradient-success" style="height: 100%;"></div>
                                <p class="text-center mt-2 font-weight-bold">oct</p>
                            </div>
                        </div>
                        <p class="text-center text-muted mt-3 mb-0">Total: 2 animales rescatados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-tag"></i> Especies más registradas</h3></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between"><span>Jaguarcito</span><span>1</span></div>
                            <div class="progress" style="height: 20px;"><div class="progress-bar bg-info" role="progressbar" style="width: 100%;"></div></div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between"><span>Felino</span><span>1</span></div>
                            <div class="progress" style="height: 20px;"><div class="progress-bar bg-primary" role="progressbar" style="width: 100%;"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header"><h3 class="card-title">Distribución del Estado de Salud</h3></div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 50%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2"><b>50%</b></div>
                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 50%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2"><b>50%</b></div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span class="font-weight-bold"><i class="fas fa-check-circle text-success"></i> Buena salud: 1</span>
                            <span class="font-weight-bold"><i class="fas fa-times-circle text-danger"></i> Mala salud: 1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection