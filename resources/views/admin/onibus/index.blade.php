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
                    <span class="info-box-text">Total Pago</span>
                    <span class="info-box-number">R${{ $inscrito->total_pago_onibus }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Status do Onibus</span>
                    <span class="info-box-number">{{ $inscrito->confirmacaoOnibus()->exists() ? 'Confirmado' : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Tabela de Pagamentos do Ônibus de {{$inscrito->primeiro_nome}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('inscritos.onibus.create', $inscrito->id)}}" class="btn btn-secondary">Novo Pagamento</a>
                            <a href="{{route('inscritos.index')}}" class="btn btn-secondary">Voltar</a>
                            @if($inscrito->confirmacaoOnibus()->exists())
                            <a href="{{route('inscritos.onibus.cancelar', $inscrito->id)}}" class="btn btn-secondary">Cancelar Ônibus</a>
                            @endif
                        </div>
                    </div>
                    @if(! $inscrito->confirmacaoOnibus()->exists())
                    <div class="row mt-3">
                        <div class="col"> 
                            {!! Form::open(['method' => 'POST', 'url' => route('inscritos.onibus.confirmar')]) !!}
                            {!! Form::hidden('inscrito_id', $inscrito->id) !!}
                            <button type="submit" class="btn btn-success">Confirmar Ônibus</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive mt-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ação</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Criado em</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagamentos as $pagamento)
                                <tr>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                Ações
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('inscritos.onibus.status', ['inscrito' => $inscrito->id, 'pagamento' => $pagamento->id]) }}">Status</a>
                                                <button class="dropdown-item" href="#" onclick="deleteRegistro('{{ route('inscritos.onibus.delete', ['inscrito' => $inscrito->id, 'pagamento' => $pagamento->id]) }}')">Apagar</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>R$ {{$pagamento->valor}}</td>
                                    <td>{!! $pagamento->status_formatado !!}</td>
                                    <td>{{$pagamento->criado_em}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
