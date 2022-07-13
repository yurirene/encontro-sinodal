<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route($route.'.pagamentos.index', $id) }}">Pagamentos</a>
        @if($onibus == true)
        <a class="dropdown-item" href="{{ route($route.'.onibus.index', $id) }}">Ônibus</a>
        @endif
        @if(isset($msg))
        <a class="dropdown-item" href="{{$msg}}" target="_blank">Enviar Msg</a>
        @endif
        <a class="dropdown-item" href="{{ route($route.'.edit', $id) }}">Editar</a>
        <button class="dropdown-item" href="#" onclick="deleteRegistro('{{ route($route.'.delete', $id) }}')">Apagar</button>
    </div>
</div>