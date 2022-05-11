@extends('template')

@section('title', 'Inscritos')

@section('content_header')
    <h1>Inscritos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Formulário
                </div>
                <div class="card-body">
                    {!! Form::model($inscrito, ['route' => ['inscritos.update', $inscrito->id], 'method' => 'PUT']) !!}
                    <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('nome') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                    {!! Form::label('celular', 'Celular') !!}
                    {!! Form::text('celular', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('celular') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('federacao') ? ' has-error' : '' }}">
                    {!! Form::label('federacao', 'Federação') !!}
                    {!! Form::select('federacao',['FAMP' => 'FAMP', 'FEPAM' => 'FEPAM', 'FMS' => 'FMS', 'FMRR' => 'FMRR', 'FPSAM' => 'FPSAM', 'FPMAN' => 'FPMAN'], null, ['id' => 'federacao', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('federacao') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('igreja') ? ' has-error' : '' }}">
                    {!! Form::label('igreja', 'Igreja') !!}
                    {!! Form::text('igreja', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('igreja') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('onibus') ? ' has-error' : '' }}">
                    {!! Form::label('onibus', 'Ônibus') !!}
                    {!! Form::select('onibus',['SIM' => 'SIM', 'NAO' => 'NÃO'], null, ['id' => 'onibus', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('onibus') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('tipo_pagamento') ? ' has-error' : '' }}">
                    {!! Form::label('tipo_pagamento', 'Pagamento') !!}
                    {!! Form::select('tipo_pagamento',['PIX' => 'PIX', 'PIX_PARCELADO' => 'Parcelado (PIX)', 'BOLETO_PARCELADO' => 'Parcelado (BOLETO)'], null, ['id' => 'tipo_pagamento', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('tipo_pagamento') }}</small>
                    </div>
                    <div id="parcelas">
                        <div class="form-group{{ $errors->has('quantidade_parcelas') ? ' has-error' : '' }}">
                            {!! Form::label('quantidade_parcelas', 'Parcelas') !!}
                            {!! Form::select('quantidade_parcelas',[2 => '2', 3 => '3', 4 => '4', 5 => '5'], null, ['id' => 'quantidade_parcelas', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('quantidade_parcelas') }}</small>
                        </div>
                    </div>
                    {!! Form::submit("Salvar", ['class' => 'btn btn-success']) !!}
                    <a href="{{route('inscritos.index')}}" class="btn btn-secondary">Voltar</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
$('#tipo_pagamento').on('change', function() {
    if (this.value == 'BOLETO_PARCELADO') {
        $('#parcelas').show();
    } else {
        $('#parcelas').hide();
    }
});
</script>
@endpush
