@extends('layouts.app')

@section('title')
  Aluno
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
            <td><span><b>Gênero:</b></span></td>
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
        
        {{-- <div class="col s12 m10 offset-m1">
          <span><b>Nome:</b> {{ $aluno->nome }} </span><br>
          <span><b>Sexo:</b> {{ $aluno->sexo }} </span><br>
          <span><b>RG:</b> {{ $aluno->rg }} </span><br>
          <span><b>CPF:</b> {{ $aluno->cpf }} </span><br>
          <span><b>Matrícula:</b> {{ $aluno->matricula }} </span><br>
          <span><b>Telefone:</b> {{ $aluno->telefone }} </span><br>
          <span><b>Email:</b> {{ $aluno->user->email }} </span><br>
          <span><b>Data de Nascimento:</b> {{ $aluno->dataNascimento }} </span><br>
          <span><b>Estado Civil:</b> {{ $aluno->estadoCivil }} </span><br>
          <span><b>Etnia:</b> {{ $aluno->raca }} </span><br>
          @switch($aluno->renda)
            @case(1)
              <span><b>Renda Familiar: </b>Até um salário mínimo</span><br>
              @break
            @case(2)
              <span><b>Renda Familiar: </b>Dois salários mínimos</span><br>
              @break
            @case(3)
              <span><b>Renda Familiar: </b>Três salários mínimos</span><br>
              @break
            @case(4)
              <span><b>Renda Familiar: </b>Mais de quatro salários mínimos</span><br>
              @break
          @endswitch
          <span><b>Turma: </b> {{ $aluno->turma->nome }} </span><br>
        </div> --}}
      </div>
    </div>
    <br>
  </div>
@endsection
