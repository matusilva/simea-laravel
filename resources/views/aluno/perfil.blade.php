@extends('layouts.app')

@section('title')
  Meu Pefil
@endsection

@section('content')
  <div class="section">
    <br>
    <div class="row">
      <div class="col s8">
        
        <table class="striped">
          <tbody>
          <tr>
            <td><span><b>Nome:</b></span></td>
            <td>{{ $aluno->nome }}</td>
            <td><span><b>Sexo:</b></span></td>
            <td>{{ $aluno->sexo }}</td>
          </tr>
          
          <tr>
            <td><span><b>RG:</b> </span></td>
            <td>{{ $aluno->rg }}</td>
            <td><span><b>CPF:</b></span></td>
            <td>{{ $aluno->cpf }}</td>
          </tr>
          
          <tr>
            <td><span><b>Matrícula:</b></span></td>
            <td>{{ $aluno->matricula }}</td>
            <td><span><b>Telefone:</b></span></td>
            <td>{{ $aluno->telefone }}</td>
          </tr>
          
          <tr>
            <td><span><b>Email:</b></span></td>
            <td>{{ $aluno->user->email }}</td>
            <td><span><b>Data de Nascimento:</b></span></td>
            <td>{{ $aluno->dataNascimento }}</td>
          </tr>
          
          <tr>
            <td><span><b>Estado Civil:</b></span></td>
            <td>{{ $aluno->estadoCivil }}</td>
            <td><span><b>Etnia:</b></span></td>
            <td>{{ $aluno->raca }}</td>
          </tr>
          
          <tr>
            @switch($aluno->renda)
              @case(1)
              <td><span><b>Renda Familiar:</b></span></td>
              <td>Até um salário mínimo</td>
              @break
              
              @case(2)
              <td><span><b>Renda Familiar:</b></span></td>
              <td>Dois salários mínimos</td>
              @break
              
              @case(3)
              <td><span><b>Renda Familiar:</b></span></td>
              <td>Três salários mínimos</td>
              @break
              
              @case(4)
              <td><span><b>Renda Familiar:</b></span></td>
              <td>Mais de quatro salários mínimos</td>
              @break
            @endswitch
            <td><span><b>Turma:</b></span></td>
            <td>{{ $aluno->turma->nome }}</td>
          </tr>
          </tbody>
        </table>
        <a href="{{ route('aluno.edit', $aluno->id) }}" class="btn btn-primary waves-effect waves-green">
          Editar
        </a>
      </div>
    </div>
  
  </div>
@endsection
