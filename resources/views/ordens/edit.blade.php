@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Orden
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row" id="autoCliente">
                   {!! Form::model($orden, ['route' => ['ordens.update', $orden->id], 'method' => 'patch']) !!}

                        @include('ordens.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>

    <div class="box box-primary">
        <div class="box-body">
            @include('orden_detalles.table')
        </div>
    </div>

@endsection


