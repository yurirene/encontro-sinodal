@extends('template')

@section('title', 'Pagamentos')

@section('content_header')
    <h1>Pagamentos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Formulário
                </div>
                <div class="card-body">
                    {{-- {!! Form::model($inscrito, ['route' => ['inscritos.update', $inscrito->id], 'method' => 'PUT']) !!} --}}
                    {!! Form::open(['method' => 'POST', 'url' => route('inscritos.onibus.store', ['inscrito' => $inscrito->id])]) !!}
                    <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
                    {!! Form::label('valor', 'Valor') !!}
                    {!! Form::text('valor', null, ['class' => 'form-control isMoney', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('valor') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status',['PAGO' => 'PAGO', 'ABERTO' => 'A PAGAR'], null, ['id' => 'status', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('status') }}</small>
                    </div>
                    {!! Form::submit("Salvar", ['class' => 'btn btn-success']) !!}
                    <a href="{{route('inscritos.onibus.index', ['inscrito' => $inscrito->id])}}" class="btn btn-secondary">Voltar</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop