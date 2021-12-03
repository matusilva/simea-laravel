@extends('layouts.app')

@section('title')
  Questionário
@endsection

@section('content')
  <div class="section">
    <br>
    <div class="row">
      <div class="col s12 m8">
        <ul class="pagination">
          <li class="waves-effect"><a href="{{$questoes->previousPageUrl()}}"><i class="material-icons">chevron_left</i></a>
          </li>
          <li class="active" style="background-color:#66bb6a;"><a href="#!">{{$questoes->currentPage()}}</a></li>
          . . .
          <li class="waves-effect"><a href="#!">{{$questoes->lastPage()}}</a></li>
          <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
        </ul>
        <br>
        @foreach ($questoes as $questao)
          <form action="{{ route('quiz.resultado') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="questionario_id" value="{{ $questionario -> id}}">
            <input type="hidden" name="eixo_id" value="{{$questao->eixo_id}}">
            <input type="hidden" name="questao_id" value="{{ $questao -> id}}">
            <input type="hidden" name="resultado_id" value="{{ $resultado }}">
            <input type="hidden" name="last_question" value="{{ $lastQuestion }}">
            {{-- <blockquote>
              {{ $questao->eixo->nome}}
            </blockquote> --}}
            <blockquote><span><b>{{ $questao->titulo }}</b></span><br></blockquote>
            <br>
            @foreach ($questao->alternativas as $alternativa)
              <span><b> &bull; </b> {{ $alternativa->alternativa }}</span><br>
              <p>
                <label>
                  <input name="alternativa{{ $loop->index }}" value="1" type="radio" required/> <span>1°</span>
                </label>
                <label>
                  <input name="alternativa{{ $loop->index }}" value="2" type="radio" required/> <span>2°</span>
                </label>
                <label>
                  <input name="alternativa{{ $loop->index }}" value="3" type="radio" required/> <span>3°</span>
                </label>
                <label>
                  <input name="alternativa{{ $loop->index }}" value="4" type="radio" required/> <span>4°</span>
                </label>
              </p>
            @endforeach
            <br>
            @endforeach
            
            <input type="hidden" name="pagina" value="{{ $questoes->currentPage() }}">
            @if($questoes->hasMorePages())
              <input type="hidden" name="next_url" value="{{ $questoes->nextPageUrl() }}">
            @else
              <input type="hidden" name="next_url" value="/quiz/final/{{ $questionario->id }}">
            @endif
            {{-- <input class="btn btn-primary" type="submit" value="Continuar"/> --}}
            <button class="btn waves-effect waves-light" type="submit" name="action">Continuar
              <i class="material-icons right"></i>
            </button>
          </form>
      </div>
    </div>
    <br>
  </div>
  
  <script>
     $("input[value=1]").change(function () {
        $('input[value=1]').not(this).prop('checked', false);
     });
     $("input[value=2]").change(function () {
        $('input[value=2]').not(this).prop('checked', false);
     });
     $("input[value=3]").change(function () {
        $('input[value=3]').not(this).prop('checked', false);
     });
     $("input[value=4]").change(function () {
        $('input[value=4]').not(this).prop('checked', false);
     });
  </script>
@endsection
