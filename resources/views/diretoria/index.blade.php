@extends('layouts.app')

@section('title')
  Diretoria
@endsection

@section('content')
  <div class="section">
    
    <div class="row">
      <div class="col s12">
        <table class="responsive-table striped">
          <thead>
          <tr>
            <th style="width: 25%;">Nome</th>
            <th class="center">Campus</th>
            <th class="center">Ações</th>
          </tr>
          </thead>
          
          <tbody>
          @forelse ($diretorias as $diretoria)
            <tr>
              <td>{{ $diretoria->nome }}</td>
              <td class="center">{{ $diretoria->campus->nome }}</td>
              <td class="center">
                <a href="{{ route('diretoria.edit', $diretoria->id) }}" class="btn btn-flat waves-effect waves-green">
                  <i class="far fa-edit fa-lg"></i>
                </a>
                <a href="{{ route('diretoria.destroy', $diretoria->id) }}" class="btn btn-flat waves-effect waves-green"
                   onclick="event.preventDefault(); document.getElementById('{{ $diretoria->id }}').submit();">
                  <i class="far fa-trash-alt fa-lg"></i>
                </a>
                
                <form id="{{ $diretoria->id }}" action="{{ route('diretoria.destroy', $diretoria->id) }}" method="POST"
                      style="display: none;">
                  {{ csrf_field() }}
                  <input name="_method" type="hidden" value="DELETE"/>
                  <input class="btn btn-danger" type="submit" value="Delete"/>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td>Não existem diretorias cadastradas no sistema.</td>
              <td></td>
              <td></td>
            </tr>
          @endforelse
          </tbody>
        </table>
        <br>
        <a href="{{ route('diretoria.create') }}" class="btn btn-primary waves-effect waves-green">
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
