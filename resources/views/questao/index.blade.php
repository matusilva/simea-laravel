@extends('layouts.app')

@section('title')
  Questão
@endsection

@section('content')
  <div class="section">
    <div class="row">
      <div class="col s12">
        <table class="responsive-table striped">
          <thead>
          <tr>
            <th style="width:25%;">Titulo</th>
            <th class="center">Questionario</th>
            <th class="center">Eixo</th>
            <th class="center">Ações</th>
          </tr>
          </thead>
          <tbody>
          @forelse ($questoes as $questao)
            <tr>
              <td>{{ $questao->titulo }}</td>
              @if ( $questao->questionario_id == null )
                {{-- se o questionário estiver vazio, então não aparece nada --}}
                <td class="center">Não adicionado</td>
              @else
                <td class="center">{{ $questao->questionario->titulo }}</td>
              @endif
              {{-- <td class="center">{{$questao->questionario->titulo}}</td>  --}}
              <td class="center">{{$questao->eixo->nome}}</td>
              <td class="center">
                <a href="{{ route('questao.show', $questao->id) }}" class="btn btn-flat waves-effect waves-green">
                  <i class="fas fa-eye fa-lg"></i>
                </a>
                <a href="{{ route('questao.edit', $questao->id) }}" class="btn btn-flat waves-effect waves-green">
                  <i class="far fa-edit fa-lg"></i>
                </a>
                <a href="{{ route('questao.destroy', $questao->id) }}" class="btn btn-flat waves-effect waves-green"
                   onclick="event.preventDefault(); document.getElementById('{{ $questao->id }}').submit();">
                  <i class="far fa-trash-alt fa-lg"></i>
                </a>
                <form id="{{ $questao->id }}" action="{{ route('questao.destroy', $questao->id) }}" method="POST"
                      style="display: none;">
                  {{ csrf_field() }}
                  <input name="_method" type="hidden" value="DELETE"/>
                  <input class="btn btn-danger" type="submit" value="Delete"/>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td>Não existem questões cadastradas no sistema.</td>
              <td></td>
              <td></td>
            </tr>
          @endforelse
          </tbody>
        </table>
        <br>
        <a href="{{ route('questao.create') }}" class="btn btn-primary waves-effect waves-green">
          Cadastrar
        </a>
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
