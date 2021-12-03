@extends('layouts.app')

@section('title')
  Questionário
@endsection

@section('content')
  <div class="section">
    <div class="row">
      <div class="col s12">
        <table class="responsive-table striped">
          <thead>
          <tr>
            <th>Titulo</th>
            <th class="center">Disponibilidade</th>
            <th class="center">Ações</th>
          </tr>
          </thead>
          
          <tbody>
          @forelse ($questionarios as $questionario)
            <tr>
              <td>{{ $questionario->titulo }}</td>
              <td class="center">{{ $questionario->disponivel == 1 ? 'Disponivel' : 'Indisponível' }}</td>
              <td class="center">
                <a href="{{ route('questionario.edit', $questionario->id) }}"
                   class="btn btn-flat waves-effect waves-green">
                  <i class="far fa-edit fa-lg"></i>
                </a>
                <a href="{{ route('questionario.destroy', $questionario->id) }}"
                   class="btn btn-flat waves-effect waves-green"
                   onclick="event.preventDefault(); document.getElementById('{{ $questionario->id }}').submit();">
                  <i class="far fa-trash-alt fa-lg"></i>
                </a>
                
                <form id="{{ $questionario->id }}" action="{{ route('questionario.destroy', $questionario->id) }}"
                      method="POST" style="display: none;">
                  {{ csrf_field() }}
                  <input name="_method" type="hidden" value="DELETE"/>
                  <input class="btn btn-danger" type="submit" value="Delete"/>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td>Não existem questionários cadastrados no sistema.</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          @endforelse
          </tbody>
        </table>
        <br>
        <a href="{{ route('questionario.create') }}" class="btn waves-effect waves-light green lighten-1">
          Cadastrar
        </a>
        <a href="/notificarQuestionario" class="btn waves-effect waves-light red lighten-2">Notificar Alunos</a>
      </div>
    </div>
  
  </div>
  
  @if(session('status'))
    <script type="text/javascript">
       $(document).ready(function () {
          M.toast({html: ' <?= session('status') ?> '});
       });
    </script>
  @endif

@endsection
