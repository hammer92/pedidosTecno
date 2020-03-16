@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Ordenes</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ordens.create') !!}">Nueva Orden</a>
           <a class="btn btn-inverse-light pull-left" id="actualizar" style="margin-top: -10px;margin-bottom: 5px; margin-right: 50px" href="{!! route('ordens.index') !!}">Ver Ordenes Nuevas</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('ordens.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function(){
            database.child('Ordenes').on('value', function(snapshot) {
                if(snapshot.val()){
                    $('#actualizar').show();
                }else{
                    $('#actualizar').hide();
                }
            });
        });



    </script>
@endsection

