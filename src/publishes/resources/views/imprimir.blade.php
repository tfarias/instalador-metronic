@extends('layouts.imprimir')

@section('conteudo')
    @include('listagem', ['imprimir' => true])
@endsection