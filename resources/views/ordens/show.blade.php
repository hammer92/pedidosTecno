@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Vista Impresion</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ordens.index') !!}">Atras</a>
            <a class="btn btn-inverse-light pull-left"  style="margin-top: -10px;margin-bottom: 5px; margin-right: 50px" href="{!! route('ordens.pdf',$orden->id) !!}">Descargar</a>
        </h1>
    </section>
    <div class="content" style="
    width: 389px;
">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('ordens.show_fields')

                </div>
            </div>
        </div>
    </div>
@endsection
