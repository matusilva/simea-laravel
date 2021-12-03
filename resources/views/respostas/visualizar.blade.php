@extends('layouts.app')

@section('title')
  Respostas obtidas
@endsection

@section('content')
  <h4 class="light">{{$questionarios->titulo}}</h4>
  <table id="table_id" class="responsive-table striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
      <th>Matrícula</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($alunos as $aluno)
      @if ($resultados->contains('pessoa_id', $aluno->id))
        <tr>
          <td>{{ ++$count }}</td>
          <td>{{$aluno->nome}}</td>
          <td>{{$aluno->matricula}}</td>
        </tr>
      @endif
    @endforeach
    </tbody>
  </table>
  
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

