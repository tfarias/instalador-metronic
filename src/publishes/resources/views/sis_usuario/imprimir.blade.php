@extends('layouts.imprimir')

@section('conteudo')
    @include('sis_usuario.listagem', ['imprimir' => true])
@endsection