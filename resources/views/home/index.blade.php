@extends('layouts.admin')

@section('title', 'Dashboard - Rescate Animales')

@php
    // Datos para el dashboard
    $totalAnimales = 25;
    $animalesRescatados = 18;
    $animalesAdoptados = 12;
    $animalesEnTratamiento = 6;
    
    $estadosSalud = [
        'Muy Bueno' => 8,
        'Bueno' => 10,
        'Estable' => 4,
        'Malo' => 2,
        'Muy Malo' => 1
    ];
    
    $tiposAnimales = [
        'Domésticos' => 15,
        'Silvestres' => 10
    ];
    
    $rescatesPorMes = [
        'Enero' => 5,
        'Febrero' => 8,
        'Marzo' => 12,
        'Abril' => 7,
        'Mayo' => 9,
        'Junio' => 11
    ];
@endphp

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-tachometer-alt text-primary mr-2"></i>
                    Dashboard
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <!-- Info Boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalAnimales }}</h3>
                        <p>Total Animales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <a href="{{ route('animales.index') }}" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $animalesRescatados }}</h3>
                        <p>Rescatados Este Mes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $animalesAdoptados }}</h3>
                        <p>Adoptados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $animalesEnTratamiento }}</h3>
                        <p>En Tratamiento</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <!-- Estado de Salud Chart -->
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-2"></i>
                            Estado de Salud de los Animales
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="estadoSaludChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tipos de Animales Chart -->
            <div class="col-lg-6">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Distribución por Tipo
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="tiposAnimalesChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rescates por Mes Chart -->
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Rescates por Mes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="rescatesPorMesChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Adicionales -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Rescates Esta Semana
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-warning">8</h4>
                                    <small class="text-muted">Rescates</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-success">3</h4>
                                    <small class="text-muted">Adopciones</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Animales en Riesgo
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-danger">2</h4>
                                    <small class="text-muted">Estado Crítico</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-warning">5</h4>
                                    <small class="text-muted">Requieren Atención</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-2"></i>
                            Rescatistas Activos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-primary">12</h4>
                                    <small class="text-muted">Voluntarios</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-info">5</h4>
                                    <small class="text-muted">Veterinarios</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos Adicionales -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Adopciones por Mes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="adopcionesPorMesChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-2"></i>
                            Gastos por Categoría
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="gastosCategoriaChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Más Gráficos -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Eficiencia de Rescates
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="eficienciaRescatesChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-area mr-2"></i>
                            Tiempo de Recuperación
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="tiempoRecuperacionChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-radar mr-2"></i>
                            Distribución por Edad
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="distribucionEdadChart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards de Métricas Avanzadas -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-heartbeat mr-2"></i>
                            Tasa de Supervivencia
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="text-primary">94%</h2>
                                    <p class="text-muted mb-0">Animales recuperados</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-primary" style="width: 94%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-home mr-2"></i>
                            Tasa de Adopción
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="text-success">78%</h2>
                                    <p class="text-muted mb-0">Animales adoptados</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" style="width: 78%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clock mr-2"></i>
                            Tiempo Promedio
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="text-warning">15</h2>
                                    <p class="text-muted mb-0">Días hasta adopción</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Casos Urgentes
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="text-danger">7</h2>
                                    <p class="text-muted mb-0">Requieren atención</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-danger" style="width: 35%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards de Resumen por Especie -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-dog mr-2"></i>
                            Resumen Caninos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="text-info">12</h4>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="text-success">8</h4>
                                    <small class="text-muted">Adoptados</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="text-warning">4</h4>
                                    <small class="text-muted">En proceso</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-cat mr-2"></i>
                            Resumen Felinos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="text-warning">8</h4>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="text-success">5</h4>
                                    <small class="text-muted">Adoptados</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="text-info">3</h4>
                                    <small class="text-muted">En proceso</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clock mr-2"></i>
                            Actividad Reciente
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-red">Hoy</span>
                            </div>
                            <div>
                                <i class="fas fa-heart bg-red"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                    <h3 class="timeline-header">Nuevo rescate</h3>
                                    <div class="timeline-body">
                                        Se rescató un perro Labrador en el centro de la ciudad. Estado: Estable.
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-home bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 10:30</span>
                                    <h3 class="timeline-header">Adopción exitosa</h3>
                                    <div class="timeline-body">
                                        "Max" fue adoptado por la familia García. ¡Felicitaciones!
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-stethoscope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 09:15</span>
                                    <h3 class="timeline-header">Revisión médica</h3>
                                    <div class="timeline-body">
                                        "Luna" completó su tratamiento y está lista para adopción.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tasks mr-2"></i>
                            Tareas Pendientes
                        </h3>
                    </div>
                    <div class="card-body">
                        <ul class="todo-list">
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <span class="text">Revisar estado de "Rex"</span>
                                <small class="badge badge-danger"><i class="far fa-clock"></i> Urgente</small>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo2" id="todoCheck2">
                                    <label for="todoCheck2"></label>
                                </div>
                                <span class="text">Programar vacunación</span>
                                <small class="badge badge-info"><i class="far fa-clock"></i> Esta semana</small>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                </div>
                                <span class="text">Actualizar registros</span>
                                <small class="badge badge-warning"><i class="far fa-clock"></i> Hoy</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style>
    .timeline {
        position: relative;
        padding: 0 0 0 30px;
        list-style: none;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 15px;
        width: 2px;
        margin-left: -1.5px;
        background-color: #dee2e6;
    }
    
    .timeline > li {
        position: relative;
        margin-bottom: 15px;
        min-height: 50px;
    }
    
    .timeline > li:before,
    .timeline > li:after {
        content: "";
        display: table;
    }
    
    .timeline > li:after {
        clear: both;
    }
    
    .timeline > li > .timeline-item {
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: 3px;
        margin-top: 0;
        background: #fff;
        color: #444;
        margin-left: 60px;
        margin-right: 15px;
        padding: 0;
        position: relative;
    }
    
    .timeline > li > .timeline-item > .time {
        color: #999;
        font-size: 12px;
        padding: 10px;
        position: absolute;
        right: 0;
        top: 0;
    }
    
    .timeline > li > .timeline-item > .timeline-header {
        margin: 0;
        color: #555;
        border-bottom: 1px solid #f4f4f4;
        padding: 10px;
        font-size: 14px;
        line-height: 1.1;
    }
    
    .timeline > li > .timeline-item > .timeline-body,
    .timeline > li > .timeline-item > .timeline-footer {
        padding: 10px;
    }
    
    .timeline > li > .timeline-item > .timeline-body {
        font-size: 13px;
    }
    
    .timeline > li > i {
        width: 30px;
        height: 30px;
        font-size: 15px;
        line-height: 30px;
        position: absolute;
        color: #666;
        background: #d2d6de;
        border-radius: 50%;
        text-align: center;
        left: 15px;
        top: 0;
        margin-left: -15px;
    }
    
    .timeline .time-label > span {
        font-weight: 600;
        padding: 5px 10px;
        background-color: #f39c12;
        color: #fff;
        border-radius: 4px;
        font-size: 12px;
    }
    
    .todo-list {
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: auto;
    }
    
    .todo-list > li {
        border-radius: 2px;
        padding: 10px;
        background: #f4f4f4;
        margin-bottom: 2px;
        border-left: 2px solid #e6e7e8;
    }
    
    .todo-list > li .handle {
        display: inline-block;
        font-size: 11px;
        margin: 0 5px;
        color: #d5d5d5;
    }
    
    .todo-list > li .text {
        display: inline-block;
        margin-left: 5px;
        font-weight: 600;
    }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Estado de Salud Chart
    const estadoSaludCtx = document.getElementById('estadoSaludChart').getContext('2d');
    new Chart(estadoSaludCtx, {
        type: 'doughnut',
        data: {
            labels: ['Muy Bueno', 'Bueno', 'Estable', 'Malo', 'Muy Malo'],
            datasets: [{
                data: [{{ implode(',', array_values($estadosSalud)) }}],
                backgroundColor: [
                    '#28a745',
                    '#17a2b8',
                    '#ffc107',
                    '#fd7e14',
                    '#dc3545'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Tipos de Animales Chart
    const tiposAnimalesCtx = document.getElementById('tiposAnimalesChart').getContext('2d');
    new Chart(tiposAnimalesCtx, {
        type: 'bar',
        data: {
            labels: ['Domésticos', 'Silvestres'],
            datasets: [{
                label: 'Cantidad',
                data: [{{ implode(',', array_values($tiposAnimales)) }}],
                backgroundColor: [
                    '#28a745',
                    '#ffc107'
                ],
                borderColor: [
                    '#1e7e34',
                    '#e0a800'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Rescates por Mes Chart
    const rescatesPorMesCtx = document.getElementById('rescatesPorMesChart').getContext('2d');
    new Chart(rescatesPorMesCtx, {
        type: 'line',
        data: {
            labels: [{{ implode(',', array_map(function($mes) { return "'$mes'"; }, array_keys($rescatesPorMes))) }}],
            datasets: [{
                label: 'Rescates',
                data: [{{ implode(',', array_values($rescatesPorMes)) }}],
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Gráfico de Adopciones por Mes
    const adopcionesPorMesCtx = document.getElementById('adopcionesPorMesChart');
    if (adopcionesPorMesCtx) {
        new Chart(adopcionesPorMesCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [{
                    label: 'Adopciones',
                    data: [3, 5, 7, 4, 6, 8],
                    backgroundColor: '#28a745',
                    borderColor: '#1e7e34',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Gráfico de Gastos por Categoría
    const gastosCategoriaCtx = document.getElementById('gastosCategoriaChart');
    if (gastosCategoriaCtx) {
        new Chart(gastosCategoriaCtx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Veterinario', 'Alimentación', 'Medicamentos', 'Equipos', 'Otros'],
                datasets: [{
                    data: [40, 25, 15, 10, 10],
                    backgroundColor: [
                        '#dc3545',
                        '#28a745',
                        '#ffc107',
                        '#17a2b8',
                        '#6c757d'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Gráfico de Eficiencia de Rescates
    const eficienciaRescatesCtx = document.getElementById('eficienciaRescatesChart');
    if (eficienciaRescatesCtx) {
        new Chart(eficienciaRescatesCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Rescates Exitosos',
                    data: [85, 92, 88, 95, 90, 94],
                    borderColor: '#17a2b8',
                    backgroundColor: 'rgba(23, 162, 184, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Gráfico de Tiempo de Recuperación
    const tiempoRecuperacionCtx = document.getElementById('tiempoRecuperacionChart');
    if (tiempoRecuperacionCtx) {
        new Chart(tiempoRecuperacionCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['1-7 días', '8-14 días', '15-30 días', '31-60 días', '60+ días'],
                datasets: [{
                    label: 'Animales',
                    data: [8, 12, 15, 6, 2],
                    backgroundColor: [
                        '#28a745',
                        '#17a2b8',
                        '#ffc107',
                        '#fd7e14',
                        '#dc3545'
                    ],
                    borderColor: [
                        '#1e7e34',
                        '#138496',
                        '#e0a800',
                        '#d39e00',
                        '#c82333'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Gráfico de Distribución por Edad
    const distribucionEdadCtx = document.getElementById('distribucionEdadChart');
    if (distribucionEdadCtx) {
        new Chart(distribucionEdadCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Cachorros (0-1 año)', 'Jóvenes (1-3 años)', 'Adultos (3-7 años)', 'Senior (7+ años)'],
                datasets: [{
                    data: [8, 12, 15, 5],
                    backgroundColor: [
                        '#ffc107',
                        '#28a745',
                        '#17a2b8',
                        '#6c757d'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
</script>
@endsection
