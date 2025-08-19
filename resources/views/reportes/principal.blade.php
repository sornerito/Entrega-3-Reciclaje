@extends('layouts.app')

@section('content')
<div class="content">
    <h1>Módulo de Reportes</h1>
    <div class="button-group">
        <a href="{{ route('reportes.usuario') }}" class="report-button">Reporte por Usuario</a>
        <a href="#" class="report-button">Reporte de Todos los Usuarios</a>
        <a href="#" class="report-button">Reporte por Empresa Recolectora</a>
    </div>
</div>

<style>
    /* Estilos específicos para esta vista */
    .button-group {
        display: flex;
        flex-direction: column;
        gap: 1em;
        margin-top: 2em;
    }
    .report-button {
        background-color: #6a994e;
        color: white;
        padding: 1em;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    .report-button:hover {
        background-color: #5d8344;
    }
</style>
@endsection
