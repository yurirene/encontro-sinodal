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
                    <span class="info-box-number">R${{ $inscrito->total_pago }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Status da Inscrição</span>
                    <span class="info-box-number">{{$inscrito->status_inscricao}}</span>
                </div>
            </div>
        </div>
        @if($inscrito->criancas == 'S')
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Crianças</span>
                    <span class="info-box-number">
                        {!! $inscrito->cat1 > 0 ? '2 a 5 anos: ' . $inscrito->cat1 . '<br>' : '' !!}
                        {!! $inscrito->cat2 > 0 ? '6 a 10 anos: ' . $inscrito->cat2 . '<br>' : '' !!}                        
                        {!! $inscrito->cat3 > 0 ? '11 a 12 anos: ' . $inscrito->cat3 : '' !!}
                    </span>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Tabela de Pagamentos de {{$inscrito->primeiro_nome}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('inscritos.pagamentos.create', $inscrito->id)}}" class="btn btn-secondary">Novo Pagamento</a>
                            <a href="{{route('inscritos.status', $inscrito->id)}}" class="btn btn-success">Confirmar Inscrição</a>
                            <a href="{{route('inscritos.index')}}" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
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
                                                <a class="dropdown-item" href="{{ route('inscritos.pagamentos.status', ['inscrito' => $inscrito->id, 'pagamento' => $pagamento->id]) }}">Status</a>
                                                <a class="dropdown-item" href="{{ route('inscritos.pagamentos.edit', ['inscrito' => $inscrito->id, 'pagamento' => $pagamento->id]) }}">Editar Valor</a>
                                                <button class="dropdown-item" href="#" onclick="deleteRegistro('{{ route('inscritos.pagamentos.delete', ['inscrito' => $inscrito->id, 'pagamento' => $pagamento->id]) }}')">Apagar</button>
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
