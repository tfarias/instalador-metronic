@extends('layouts.imprimir')

@section('conteudo')
    @include('aux_tipo_usuario.listagem', ['imprimir' => true])
@endsection