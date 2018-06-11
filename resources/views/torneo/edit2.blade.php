@extends('layouts.base')
@section('contenido')
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Torneo</h2><h4>Nuevo Torneo (Paso 3) - Etapa de Grupos</h4>   
            </div>
        </div>              
         <!-- /. ROW  -->
         <hr />
        <div class="row">
                    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <div class="col-xs-12">
                <h5>Definicion de Fechas</h5>
                <div class="panel-group" id="accordion">
                    @foreach($torneo->grupos as $grupo)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $grupo->nombre }}" class="">Grupo "{{ $grupo->nombre }}"</a>
                            </h4>
                        </div>
                        <div id="collapse{{ $grupo->nombre }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Local</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Visitante</th>
                                            <th>Dia</th>
                                            <th>Fecha</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($torneo->encuentros as $encuentro)
                                            @if($encuentro->ident == $grupo->nombre)
                                                {!! Form::open(array(
                                                'route'=>['encuentro.update',$encuentro->id],
                                                'method'=>'PATCH',
                                                'autocomplete'=>'off'
                                                )) !!}
                                                {{ Form::token() }}
                                                <tr>
                                                    <th>{{ $encuentro->equipoL->nombre }}</th>
                                                    <th><div class="form-group"><input type="number" name="puntosL"class="form-control"  value="{{ $encuentro->puntosL }}"></div></th>
                                                    <th>vs</th>
                                                    <th><div class="form-group"><input type="number" name="puntosV" class="form-control"  value="{{ $encuentro->puntosV }}"></div></th>
                                                    <th>{{ $encuentro->equipoV->nombre }}</th>
                                                    <th><div class="form-group"><input type="date" name="dia"class="form-control"  value="{{ $encuentro->dia }}"></div></th>
                                                    <th><div class="form-group"><input type="number" name="fecha"class="form-control"  value="{{ $encuentro->fecha }}"></div></th>
                                                    <th><input type="submit" value="ok" class="btn btn-primary"></th>
                                                </tr>
                                                {!! Form::close() !!}
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {!! Form::open(array(
                'route'=>['torneo.update',$torneo->id],
                'method'=>'PATCH',
                'autocomplete'=>'off'
                )) !!}
                {{ Form::token() }}

                <input type="hidden" name="nombre" value="{{ $torneo->nombre}}">
                <input type="hidden" name="deporte" value="{{ $torneo->deporte}}">
                <input type="hidden" name="fechaInicio" value="{{ $torneo->fechaInicio}}">
                <input type="hidden" name="fechaFin" value="{{ $torneo->fechaFin}}">


                <a href="{{URL::action('TorneoController@back',$torneo->id)}}" class="btn btn-primary">Atras</a>
                <input type="hidden" name="siguiente" value="ok">
                <input type="submit" value="Siguiente" class="btn btn-primary">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection