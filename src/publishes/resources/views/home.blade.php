@extends('layouts.template')

@section('conteudo')

    <h4>Olá <strong>{{ auth()->user()->primeiroNome }}</strong></h4>
    <hr />

@endsection