@extends('layouts.app')

@section('title')
  Quiz
@endsection

@section('content')
  <div class="section">
    <br>
    <div class="row">
      <div class="col s12 m10">
        <h3 class="light">Questionário Finalizado com Sucesso!</h3>
        <br><br>
        <form action="{{ route('feedback') }}" method="POST">
          {{ csrf_field() }}
          <h5>Dê uma nota para o site:</h5>
          <p>
            <label>
              <input name="nota" type="radio" value="0"/>
              <span>0</span>
            </label>
            <label>
              <input name="nota" type="radio" value="1"/>
              <span>1</span>
            </label>
            <label>
              <input name="nota" type="radio" value="2"/>
              <span>2</span>
            </label>
            <label>
              <input name="nota" type="radio" value="3"/>
              <span>3</span>
            </label>
            <label>
              <input name="nota" type="radio" value="4"/>
              <span>4</span>
            </label>
            <label>
              <input name="nota" type="radio" value="5"/>
              <span>5</span>
            </label>
          </p>
          <br>
          <h5>Deixe sua sugestão:</h5>
          <div class="row">
            <div class="input-field col s12">
              <textarea id="feedback" name="feedback" class="materialize-textarea"></textarea>
              <label for="feedback">Feedback</label>
            </div>
          </div>
          <input class="btn btn-primary" type="submit" value="Enviar"/>
          
          <button class="btn waves-effect waves-light red" type="submit" name="action">Não quero Responder</button>
        </form>
      </div>
    </div>
    <br>
  </div>
@endsection
