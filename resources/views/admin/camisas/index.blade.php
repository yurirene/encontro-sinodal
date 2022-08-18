@extends('template')

@section('title', 'Camisas')

@section('content_header')
    <h1>Camisas</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Camisas Confirmadas</span>
                <span class="info-box-number">{{ $total_confirmado }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                Tabela de Camisas
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
