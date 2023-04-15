@extends('layouts.template')

@section('conteudo')
<div class="this-place">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li><a href="{{route('tipo_rota.index')}}">Tipo de Rota</a></li>
            <i class="fa fa-chevron-right"></i>
            <li>
                <span>Cadastrar</span>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <h1 class="page-title">Tipo de Rota</h1>
    <div class="clearfix"></div>
    <div class="row area">
                <div class="col-md-12">
                      <div class="tipo_rota form">
                            @include('partials.preenchimento_obrigatorio')
                            @include('tipo_rota.form')
                      </div>
            </div>
    </div>
</div>
@endsection