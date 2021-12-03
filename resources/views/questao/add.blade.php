@extends('layouts.app')
@section('title')
  Adicionar Questão
@endsection

@section('content')
  <div class="section">
    <br>
    <div class="row">
      <form class="col s12" action="{{ route('addupdate', $questoes->id)  }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
          <blockquote>{{$questoes->titulo}}</blockquote>
          <div class="input-field col s12 m4">
            <select id="questionario_id" name="questionario_id">
              <option value="" disabled selected>Escolha um questionario</option>
              @foreach ($questionarios as $questionario)
                <option
                  value="{{ $questionario->id }}" {{ $questionario->id == $questoes->questionario_id ? 'selected' : '' }}>
                  {{ $questionario->titulo }}
                </option>
              @endforeach
            </select>
            <label>Questionario</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m6">
            <input class="btn btn-primary" type="submit" value="Adicionar"/>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection