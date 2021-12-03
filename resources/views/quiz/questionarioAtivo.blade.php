@extends('layouts.app')

@section('title')
  Escolher Questionario
@endsection

@section('content')
  <div class="section">
    <div class="col s12 m6">
      <div class="card green darken-1">
        <div class="card-content white-text">
          <span class="center card-title"><i class="material-icons small">info_outline</i></span>
          <h6 class="light">Informamos que as perguntas devem ser respondidas por ordem de prioridade.</h6>
          <br>
          <p class="light">Selecione:
            <br><b>4</b> para a primeira opção que você escolheria como resposta
            <br><b>3</b> para a segunda opção que você escolheria como resposta
            <br><b>2</b> para a terceira opção que você escolheria como resposta e
            <br><b>1</b> para a última opção que você escolheria.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <table class="responsive-table striped">
          <thead>
          <tr>
            <th>Titulo</th>
            <th class="center">Ações</th>
          </tr>
          </thead>
          <tbody>
          <div id="escolher_questionario">
            @forelse ($questionarios as $questionario)
              @if ( $questionario->questoes->isEmpty() )
                <tr>
                  {{-- se o questionário estiver vazio, então não aparece nada --}}
                  @else
                    <td>{{ $questionario->titulo }}</td>
                  @endif
                  
                  @if ( $resultados->contains('questionario_id', $questionario->id) )
                    <td class="center">Você já respondeu a este questionário.</td>
                  @elseif ( $questionario->questoes->isEmpty() )
                    {{-- se o questionário estiver vazio, então não aparece nada --}}
                  @else
                    <td class="center">
                      <a href="{{route('quiz.checar', $questionario->id)}}"><input class="btn btn-primary" type="submit"
                                                                                   value="Iniciar Questionario"/></a>
                    </td>
                  @endif
                </tr>
                @empty
                  <tr>
                    <td class="center">Não existem questionários disponíveis.</td>
                  </tr>
                @endforelse
          </div>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
