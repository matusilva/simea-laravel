@extends('layouts.app')

@section('title')
  Questionário
@endsection

@section('content')
  <div class="section">
    <br>
    <div class="row">
      <div class="col s12 m10">
        <p> Olá, {{ Auth::user()->name }}. <br> Sentimos sua falta. <br> Gostaríamos de saber, dentre as alternativas
          abaixo, as ações que descrevem, da melhor maneira possível, a razão de sua desvinculação com o Instituto.</p>
        <br>
        <form action="{{ route('quiz.resultadoInativo') }}" method="POST">
          {{ csrf_field() }}
          
          <div class="row">
            <div class="input-field col s12 m8">
              <textarea id="outro" name="outro" class="materialize-textarea"></textarea>
              <label for="outro">Descreva aqui!</label>
            </div>
          </div>
          
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Não era o curso que desejava"/>
              <span>Não era o curso que desejava</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Durante o curso me interessei por outra area"/>
              <span>Durante o curso me interessei por outra area</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Faltou-me incentivo familiar"/>
              <span>Faltou-me incentivo familiar</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Tive problemas familiares e acabei ficando desestimulado"/>
              <span>Tive problemas familiares e acabei ficando desestimulado</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Precisei optar entre trabalho e estudos"/>
              <span>Precisei optar entre trabalho e estudos</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Nao consegui nenhum auxilio economico"/>
              <span>Não consegui nenhum auxílio econômico</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]"
                     value="Não consegui acompanhar os conteudos devido a complexidade"/>
              <span>Não consegui acompanhar os conteúdos devido a complexidade</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="A didatica dos professores me prejudicou academicamente"/>
              <span>A didática dos professores me prejudicou academicamente</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Faltou-me perspectiva profissional"/>
              <span>Faltou-me perspectiva profissional</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]"
                     value="Não considerei lucrativa a area profissional referente ao curso"/>
              <span>Não considerei lucrativa a área profissional referente ao curso</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Nao me identifiquei com a estrutura do Instituto"/>
              <span>Não me identifiquei com a estrutura do Instituto</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]"
                     value="Consegui ingressar em outra instituicao com melhor estrutura"/>
              <span>Consegui ingressar em outra instituição com melhor estrutura</span>
            </label>
          </p>
          <p>
            <label>
              <input type="checkbox" name="motivos[]" value="Fui para outra Universidade">
              <span>Fui pra outra Universidade</span>
            </label>
          </p>
          <br>
          <input class="btn btn-primary" type="submit" value="Enviar"/>
        </form>
      </div>
    </div>
    <br>
  </div>
@endsection
