@extends('layouts.app')

@section('title')
  Inicio
@endsection

@section('content')
  <div class="section">
    @if(Auth::user()->tipo_id==1)
      <div class="row">
        <div class="col s12">
          <br>
          <blockquote><h4 class="light">Olá, {{ Auth::user()->name }}</h4></blockquote>
          <span>Para Responder o questionário, precisamos saber como está sua situação acadêmica:</span>
          <br><br>
          <form action="{{ route('vinculo.verificar') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
              <div class="input-field col s12 m6">
                <select id="vinculo" name="vinculo">
                  <option value="" disabled selected>Escolha uma opção</option>
                  <option value="1">Ativo - Cursando Regularmente</option>
                  <option value="2">Inativo - Matrícula Trancada ou Desistência do Curso</option>
                </select>
                <label>Vinculo</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12 m6">
                <input class="btn btn-primary" type="submit" value="Continuar"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    @endif
    
    @if(Auth::user()->tipo_id==2)
      <section class="section section-daily-stats center">
        <div class="row">
          <div class="col l3 m6 s12">
            <a href="{{ route('aluno.index') }}" style="color: inherit;">
              <div class="card-panel green lighten-1 white-text center">
                <i class="material-icons medium">people</i>
                <h5>Total de Alunos</h5>
                <h3 class="count">{{$alunos->count()}}</h3>
              </div>
            </a>
          </div>
          <div class="col l3 m6 s12">
            <a href="{{ route('feedbacksindex.index') }}" style="color: inherit;">
              <div class="card-panel green lighten-5 center">
                <i class="material-icons medium">comment</i>
                <h5>Feedbacks</h5>
                <h3 class="count">{{$feedbacks->count()}}</h3>
              </div>
            </a>
          </div>
          <div class="col l3 m6 s12">
            <a href="{{ route('questionario.index') }}" style="color: inherit;">
              <div class="card-panel green lighten-1 white-text center">
                <i class="material-icons medium">assignment</i>
                <h5>Questionários</h5>
                <h3 class="count">{{$questionarios->count()}}</h3>
              </div>
            </a>
          </div>
        </div>
      </section>
    @endif
  </div>
  
  @if(session('status'))
    <script type="text/javascript">
       $(document).ready(function () {
          M.toast({html: ' <?= session('status') ?> ', outDuration: 8000, classes: 'rounded'});
       });
    </script>
  @endif

@endsection
