@extends('layouts.imprimir')

@section('conteudo')
    @include('tipo_rota.listagem', ['imprimir' => true])
@endsection