@extends('layouts.app')
@section('title')
  Alunos
@endsection

@section('content')
  <table id="table_id" class="responsive-table striped">
    <thead>
    <tr>
      <th>Nome</th>
      <th class="center">Matricula</th>
      <th class="center">RG</th>
      <th class="center">CPF</th>
      <th class="center">Ações</th>
    </tr>
    </thead>
    
    <tbody>
    @forelse ($alunos as $aluno)
      <tr>
        <td>{{ $aluno->nome }}</td>
        <td class="center">{{ $aluno->matricula }}</td>
        <td class="center">{{ $aluno->rg }}</td>
        <td class="center">{{ $aluno->cpf }}</td>
        <td class="center">
          <a href="{{ route('aluno.show', $aluno->id) }}"
             class="btn-floating waves-effect waves-green">
            <i class="material-icons"> visibility </i>
          </a>
          
          <a href="{{ route('aluno.edit', $aluno->id) }}"
             class="btn-floating waves-effect waves-light green">
            <i class="material-icons"> edit </i>
          </a>
          
          <a href="{{ route('aluno.destroy', $aluno->id) }}"
             class="btn-floating waves-effect waves-light red"
             onclick="event.preventDefault(); document.getElementById('{{ $aluno->id }}').submit();">
            <i class="material-icons"> delete </i>
          </a>
          
          <form id="{{ $aluno->id }}" action="{{ route('aluno.destroy', $aluno->id) }}"
                method="POST" style="display: none;">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE"/>
            <input class="btn btn-danger" type="submit" value="Delete"/>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td>Não existem alunos cadastrados no sistema.</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    @endforelse
    </tbody>
  </table>
  <br>
  <a href="{{ route('aluno.create') }}" class="btn waves-effect waves-light red lighten-2">Cadastrar</a>
  
  @if(session('status'))
    <script type="text/javascript">
       $(document).ready(function () {
          M.toast({html: '<?= session('status') ?>'});
       });
    </script>
  @endif
  
  <script>
     $(document).ready(function () {
        $('#table_id').DataTable({
           "language": {
              "lengthMenu": "Mostrando _MENU_ registros por página",
              "zeroRecords": "Nenhum aluno encontrado",
              "info": "Mostrando página _PAGE_ de _PAGES_",
              "infoEmpty": "Nenhum aluno disponível",
              "infoFiltered": "(Filtrando de _MAX_ alunos no total)"
           }
        });
        $('select').select();
     });
  </script>
  <script type="text/javascript" charset="utf8"
          src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
@endsection