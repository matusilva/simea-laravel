@extends('layouts.app')

@section('title')
  Escolha
@endsection

@section('content')
  <h4 class="light">Escolha o questionário que você deseja visualizar</h4>
  <table class="responsive-table striped">
    <thead>
    <tr>
      <th>Questionário</th>
      <th>Ações</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach ($questionarios as $questionario)
      <tr>
        <td>{{$questionario->titulo}}</td>
        <td><a href="{{ route('respostas.visualizar', $questionario->id) }}">Visualizar Respostas</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection