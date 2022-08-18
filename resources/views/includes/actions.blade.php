<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if(isset($pagamento))
        <a class="dropdown-item" href="{{ route($route.'.pagamentos.index', $id) }}">Pagamentos</a>
        @endif
        @if($onibus == true)
        <a class="dropdown-item" href="{{ route($route.'.onibus.index', $id) }}">Ônibus</a>
        @endif
        @if(isset($msg))
        <a class="dropdown-item" href="{{$msg}}" target="_blank">Enviar Msg</a>
        @endif
        @if(!isset($edit))
        <a class="dropdown-item" href="{{ route($route.'.edit', $id) }}">Editar</a>
        @endif
        @if(!isset($delete))
        <button class="dropdown-item" href="#" onclick="deleteRegistro('{{ route($route.'.delete', $id) }}')">Apagar</button>
        @endif
        @if(isset($status))
        <a class="dropdown-item" href="{{ route($route.'.status', $id) }}">Status</a>
        @endif
    </div>
</div>