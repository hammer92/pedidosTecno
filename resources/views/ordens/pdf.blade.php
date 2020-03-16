<html>
<head>
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;overflow:hidden;word-break:normal;}
        .tg .tg-yw4l{vertical-align:top;width: 33%}
    </style>
</head>
<body>
<table class="tg">
    <tr>
        <th class="tg-yw4l">Cliente:</th>
        <th class="tg-yw4l" style="width: 200px">{{ $orden->user->name }}</th>
        <th class="tg-yw4l">Telefono</th>
        <th class="tg-yw4l">{{ $orden->user->telefono }}</th>
    </tr>
    <tr>
        <td class="tg-yw4l">Direccion:</td>
        <td class="tg-yw4l">{{ $orden->direccion }}</td>
        <td class="tg-yw4l">Nº Pedido</td>
        <td class="tg-yw4l">{{ $orden->id }}</td>
    </tr>
</table>

<hr>
<table>
    <thead>
    <tr>
        <th style="width: 300px">Producto</th>
        <th style="width: 50px">Precio</th>
        <th style="width: 50px">Cantidad</th>
        <th style="width: 50px">Subtotal</th>
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
</body>
</html>