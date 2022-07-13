@extends('template')

@section('title', 'Inscritos')

@section('content_header')
    <h1>Inscritos</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Inscritos</span>
                <span class="info-box-number">{{ $totalizador['inscritos'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Inscritos Confirmados</span>
                <span class="info-box-number">{{$totalizador['inscritos_confirmados']}}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pag. Inscrição</span>
                <span class="info-box-number">R${{$totalizador['total_recebido']}}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pag. Onibus</span>
                <span class="info-box-number">R${{$totalizador['total_onibus_recebido']}}</span>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Tabela de Inscritos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
{!! $dataTable->scripts() !!}
@endpush
