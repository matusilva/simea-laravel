@extends('layouts.app')

@section('title')
  Login
@endsection

@section('content')
  <br>
  <div class="container">
    <div class="row">
      <form class="col s12" method="POST" action="{{ route('login') }}">
        <div class="row">
          {{ csrf_field() }}
          <div class="input-field col s12">
            <input id="email" type="email" name="email" required>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="password" type="password" name="password" required>
            <label for="password">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <label>
              <a class="cyan-text" href="{{'password/reset'}}"><b>Esqueceu sua senha?</b></a>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <p>
              <label>
                <input type="checkbox" name="remember"/>
                <span>Lembrar-me?</span>
              </label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn btn-primary">Entrar</button>
          </div>
        </div>
      </form>
    </div> <!-- row -->
  </div> <!-- container -->
  
  @if(session('status'))
    <script type="text/javascript">
       $(document).ready(function () {
          M.toast({html: ' <?= session('status') ?> ', outDuration: 8000});
       });
    </script>
  @endif

@endsection
