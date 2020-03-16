
<!-- Numero Field -->
<div class="form-group col-md-4">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{!! $orden->id !!}</p>
</div>

<!-- Cliente Id Field -->
<div class="form-group col-md-4">
    {!! Form::label('cliente_id', 'Cliente') !!}
    <p>{!! $orden->user->name !!}</p>
</div>

<!-- Telefono Field -->
<div class="form-group col-md-4">
    {!! Form::label('telefono', 'Telefono:') !!}
    <p>{!! $orden->user->telefono !!}</p>
</div>

<!-- Direccion Field -->
<div class="form-group col-md-4">
    {!! Form::label('direccion', 'Direccion:') !!}
    <p>{!! $orden->direccion !!}</p>
</div>

<!-- Total Field -->
<div class="form-group col-md-4">
    {!! Form::label('total', 'Total:') !!}
    <p>{!! $orden->total !!}</p>
</div>

<div class="col-md-12">
    <table class="table table-responsive" id="ordenDetalles-table">
        <thead>
        <tr>
            <th style="width: 50%">Producto</th>
            <th style="width: 150px">Precio</th>
            <th style="width: 150px">Cantidad</th>
            <th style="width: 150px">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orden->ordenDetalles as $ordenDetalle)
            <tr>

                <td>{!! $ordenDetalle->producto->nombre !!}</td>
                <td>{!! $ordenDetalle->precio !!}</td>
                <td>{!! $ordenDetalle->cantidad !!}</td>
                <td>{!! $ordenDetalle->subtotal !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


