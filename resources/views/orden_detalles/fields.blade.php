<!-- Orden Id Field -->
    {!! Form::hidden('orden_id', $orden->id) !!}
    {!! Form::hidden('total_actual', $orden->total) !!}
<auto-producto></auto-producto>
<!-- Submit Field -->
<div class="form-group col-sm-2">
    {!! Form::label('action', 'Action') !!}
    {!! Form::submit('Save', ['class' => 'form-control btn btn-primary']) !!}
</div>
