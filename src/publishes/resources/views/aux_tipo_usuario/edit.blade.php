@extends('layouts.template')

@section('conteudo')
<div class="this-place">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li><a href="{{route('aux_tipo_usuario.index')}}">Tipo de Usuarios</a></li>
            <i class="fa fa-chevron-right"></i>
            <li>
                <span>Editar</span>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <h1 class="page-title">Tipo de Usuarios</h1>
    <div class="clearfix"></div>
    <div class="row area">
                <div class="col-md-12">
                            <div class="aux_tipo_usuario form">
                                    @include('partials.preenchimento_obrigatorio')
                                     @include('aux_tipo_usuario.form')
                            </div>
            </div>
    </div>
</div>
@endsection