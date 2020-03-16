<table class="table table-responsive" id="ordens-table">
    <thead>
        <tr>
            <th>Numero</th>
            <th>Fecha-Hora</th>
            <th>Cliente</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Total</th>
            <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ordens as $orden)
        <tr>
            <td>{!! $orden->id !!}</td>
            <td>{!! $orden->created_at !!}</td>
            <td>{!! $orden->user->name !!}</td>
            <td>{!! $orden->user->telefono !!}</td>
            <td>{!! $orden->direccion !!}</td>
            <td>{!! $orden->total !!}</td>
            <td>{!! $orden->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['ordens.destroy', $orden->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ordens.show', [$orden->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('ordens.edit', [$orden->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>