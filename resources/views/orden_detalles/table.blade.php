<div class="row">
    {!! Form::open(['route' => 'ordenDetalles.store']) !!}

    @include('orden_detalles.fields')

    {!! Form::close() !!}
</div>
<table class="table table-responsive" id="ordenDetalles-table">
    <thead>
        <tr>
            <th style="width: 50%">Producto</th>
            <th style="width: 150px">Precio</th>
            <th style="width: 150px">Cantidad</th>
            <th style="width: 150px">Subtotal</th>
            <th style="width: 150px" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>

    @foreach($orden->ordenDetalles as $ordenDetalle)
        <tr>

            <td>{!! $ordenDetalle->producto->nombre !!}</td>
            <td>{!! $ordenDetalle->precio !!}</td>
            <td>{!! $ordenDetalle->cantidad !!}</td>
            <td>{!! $ordenDetalle->subtotal !!}</td>
            <td>
                {!! Form::open(['route' => ['ordenDetalles.destroy', $ordenDetalle->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>