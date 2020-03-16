<!-- Numero Field -->

<!-- Cliente Id Field -->
@if(empty($orden))
    <auto-cliente></auto-cliente>

@else

<auto-cliente
        name="{{ $orden->user->name }}"
        id="{{ $orden->cliente_id }}"
        email="{{ $orden->user->email}}"
        telefono="{{ $orden->user->telefono }}"
        direccion="{{ $orden->direccion }}"
></auto-cliente>
@endif

<div class="col-sm-12">
    <!-- Categoria Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('estado', 'Estado Pedido:') !!}

        {!! Form::select('estado',  array('pendiente' => 'pendiente', 'cocina' => 'cocina', 'enviado' => 'enviado', 'cancelado' => 'cancelado', 'facturado' => 'facturado'),(!empty($orden->total))?$orden->total :null , array('class' => 'form-control') ) !!}
    </div>
    <!-- Submit Field -->
    <div class=" col-sm-4">
        <h2>
            {!! Form::submit('Guardar', ['class' => ' btn btn-primary']) !!}
            <a href="{!! route('ordens.index') !!}" class=" btn btn-default">Cerrar</a>
        </h2>

    </div>

    <div class=" col-sm-4">

        <h2>Total: @if(!empty($orden->total)){{ $orden->total }}@else 0 @endif</h2>
    </div>
</div>

