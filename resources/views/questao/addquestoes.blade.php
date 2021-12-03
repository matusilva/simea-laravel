@extends('layouts.app')

@section('title')
  Questões
@endsection

@section('content')
  <div class="section">
    <div class="row">
      <div class="col s12">
        <table class="responsive-table striped">
          <thead>
          <tr>
            <th style="width:25%;">Titulo</th>
            <th class="center">Eixo</th>
            <th class="center">Questionário</th>
            <th class="center">Ações</th>
          </tr>
          </thead>
          <tbody>
          @forelse ($questoes as $questao)
            <tr>
              <td>{{ $questao->titulo }}</td>
              <td class="center">{{$questao->eixo->nome}}</td>
              @if ( $questao->questionario_id == null )
                {{-- se o questionário estiver vazio, então não aparece nada --}}
                <td class="center">Não adicionado</td>
              @else
                <td class="center">{{ $questao->questionario->titulo }}</td>
              @endif
              {{-- <td class="center">{{$questao->questionario->titulo}}</td>  --}}
              <td class="center">
                <a href="{{ route('add', $questao->id) }}"><input class="btn btn-primary" type="submit"
                                                                  value="Inserir Questionário"></a>
              
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
