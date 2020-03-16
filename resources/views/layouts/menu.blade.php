
<li class="{{ Request::is('categorias*') ? 'active' : '' }}">
    <a href="{!! route('categorias.index') !!}"><i class="fa fa-edit"></i><span>Categorias</span></a>
</li>

<li class="{{ Request::is('productos*') ? 'active' : '' }}">
    <a href="{!! route('productos.index') !!}"><i class="fa fa-edit"></i><span>Productos</span></a>
</li>

<li class="{{ Request::is('ordens*') ? 'active' : '' }}">
    <a href="{!! route('ordens.index') !!}"><i class="fa fa-edit"></i><span>Ordenes</span></a>
</li>

