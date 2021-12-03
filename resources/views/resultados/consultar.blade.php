@extends('layouts.app')

@section('title')
  Consultar
@endsection

@section('content')
  <br>
  <div class="row">
    <form class="col s12" action="{{ route('consultarDados') }}" method="POST">
      {{ csrf_field() }}
      <br>
      <div class="row" id="select_campus">
        <div class="input-field col s12 m10">
          <select id="campus_id" name="campus_id" required>
            <option value="" disabled selected>Escolha uma opção</option>
            @foreach ($campuses as $campus)
              <option value="{{ $campus->id }}">{{ $campus->nome }}</option>
            @endforeach
          </select>
          <label>Campus</label>
        </div>
      </div>
      <div class="row" id="select_diretoria">
        <div class="input-field col s12 m10">
          <select id="diretoria_id" name="diretoria_id" disabled>
            <option value="" disabled selected>Escolha uma opção</option>
          </select>
          <label>Diretoria</label>
        </div>
      </div>
      <div class="row" id="select_curso">
        <div class="input-field col s12 m10">
          <select id="curso_id" name="curso_id" disabled>
            <option value="" disabled selected>Escolha uma opção</option>
          </select>
          <label>Curso</label>
        </div>
      </div>
      <div class="row" id="select_turma">
        <div class="input-field col s12 m10">
          <select id="turma_id" name="turma_id" disabled>
            <option value="" disabled selected>Escolha uma opção</option>
          </select>
          <label>Turma</label>
        </div>
      </div>
      <div class="row" id="select_aluno">
        <div class="input-field col s12 m10">
          <select id="aluno_id" name="aluno_id" disabled>
            <option value="" disabled selected>Escolha uma opção</option>
          </select>
          <label>Aluno</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m6">
          <input class="btn btn-primary" type="submit" value="Consultar"/>
        </div>
      </div>
    </form>
  </div>

  <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
      Gráfico mostrando os evasometros de cada aluno, coletados através dos questionários.
    </p>
  </figure>

  <style>
    .highcharts-figure, .highcharts-data-table table {
      min-width: auto; /*310px*/
      max-width: auto; /*800px*/
      margin: 1em auto;
    }

    #container {
      height: 400px;
    }

    .highcharts-data-table table {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #EBEBEB;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }

    .highcharts-data-table th {
      font-weight: 600;
      padding: 0.5em;
    }

    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
      padding: 0.5em;
    }

    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }
  </style>

  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <script>
    Highcharts.chart('container', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Gráfico de Evasometro'
      },
      subtitle: {
        text: 'Clique nas colunas para visualizar mais detalhes'
      },
      accessibility: {
        announceNewData: {
          enabled: true
        }
      },
      xAxis: {
        type: 'category'
      },
      yAxis: {
        title: {
          text: 'Total'
        }
      },
      credits: {
        enabled: false
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        series: {
          borderWidth: 0,
          dataLabels: {
            enabled: true,
            format: '{point.y:.1f}%'
          }
        }
      },

      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> total<br/>'
      },

      series: [
        {
          name: "Alunos",
          colorByPoint: true,
          data: [
              @foreach($alunos as $aluno)
              @if($resultados->contains('pessoa_id', $aluno->id))
            {
              name: '{{ $aluno->nome }}',
              y: {{ number_format($resultados->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('pessoa_id', $aluno->id)->count(), 2) }},
              drilldown: '{{ $aluno->id }}'
            },
            @endif
            @endforeach
          ]
        }
      ],
      drilldown: {
        series: [
            @foreach($alunos as $aluno)
            @if ($resultados->contains('pessoa_id', $aluno->id))
          {
            name: '{{ $aluno->nome }}',
            id: '{{ $aluno->id }}',
            data: [
              [
                "Individual",
                {{ $resultados->where('eixo_id', 1)->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('eixo_id', 1)->where('pessoa_id', $aluno->id)->count() }}
              ],
              [
                "Familiar",
                {{ $resultados->where('eixo_id', 2)->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('eixo_id', 2)->where('pessoa_id', $aluno->id)->count() }}
              ],
              [
                "Intraescolar",
                {{ $resultados->where('eixo_id', 3)->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('eixo_id', 3)->where('pessoa_id', $aluno->id)->count() }}
              ],
              [
                "Carreira Profissional",
                {{ $resultados->where('eixo_id', 4)->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('eixo_id', 4)->where('pessoa_id', $aluno->id)->count() }}
              ],
              [
                "Área de Formação",
                {{ $resultados->where('eixo_id', 5)->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('eixo_id', 5)->where('pessoa_id', $aluno->id)->count() }}
              ],
              [
                "Institucional",
                {{ $resultados->where('eixo_id', 6)->where('pessoa_id', $aluno->id)->sum('pontos') / $resultados->where('eixo_id', 6)->where('pessoa_id', $aluno->id)->count() }}
              ],
            ]
          },
          @endif
          @endforeach
        ]
      }
    });
  </script>
  
  <script>
     $('#select_campus').change(function () {
        $('#diretoria_id').prop("disabled", false);
        $("#diretoria_id").html('<option value="" disabled selected>Escolha uma opção</option>');
        $.get('/campus/diretorias/' + $('#campus_id').val(), function (diretorias) {
           if (diretorias.length === 0) {
              $('#diretoria_id').prop("disabled", true);
              $("#diretoria_id").html('<option value="" disabled selected>Escolha uma opção</option>');
              $('select').select();
           } else {
              $.each(diretorias, function (key, value) {
                 $('#diretoria_id').append('<option value="' + value + '">' + key + '</option>');
                 $('select').select();
              });
           }
           $('#curso_id').prop("disabled", true);
           $("#curso_id").html('<option value="" disabled selected>Escolha uma opção</option>');
           $('#turma_id').prop("disabled", true);
           $("#turma_id").html('<option value="" disabled selected>Escolha uma opção</option>');
           $('#aluno_id').prop("disabled", true);
           $("#aluno_id").html('<option value="" disabled selected>Escolha uma opção</option>');
           $('select').select();
        });
     });
     $('#select_diretoria').change(function () {
        $('#curso_id').prop("disabled", false);
        $("#curso_id").html('<option value="" disabled selected>Escolha uma opção</option>');
        $.get('/diretoria/cursos/' + $('#diretoria_id').val(), function (cursos) {
           if (cursos.length === 0) {
              $('#curso_id').prop("disabled", true);
              $("#curso_id").html('<option value="" disabled selected>Escolha uma opção</option>');
              $('select').select();
           } else {
              $.each(cursos, function (key, value) {
                 $('#curso_id').append('<option value="' + value + '">' + key + '</option>');
                 $('select').select();
              });
           }
           $('#turma_id').prop("disabled", true);
           $("#turma_id").html('<option value="" disabled selected>Escolha uma opção</option>');
           $('#aluno_id').prop("disabled", true);
           $("#aluno_id").html('<option value="" disabled selected>Escolha uma opção</option>');
           $('select').select();
        });
     });
     $('#select_curso').change(function () {
        $('#turma_id').prop("disabled", false);
        $("#turma_id").html('<option value="" disabled selected>Escolha uma opção</option>');
        $.get('/curso/turmas/' + $('#curso_id').val(), function (turmas) {
           if (turmas.length === 0) {
              $('#turma_id').prop("disabled", true);
              $("#turma_id").html('<option value="" disabled selected>Escolha uma opção</option>');
              $('select').select();
           } else {
              $.each(turmas, function (key, value) {
                 $('#turma_id').append('<option value="' + value + '">' + key + '</option>');
                 $('select').select();
              });
           }
           $('#aluno_id').prop("disabled", true);
           $("#aluno_id").html('<option value="" disabled selected>Escolha uma opção</option>');
           $('select').select();
        });
     });
     $('#select_turma').change(function () {
        $('#aluno_id').prop("disabled", false);
        $("#aluno_id").html('<option value="" disabled selected>Escolha uma opção</option>');
        $.get('/turma/alunos/' + $('#turma_id').val(), function (alunos) {
           if (alunos.length === 0) {
              $('#aluno_id').prop("disabled", true);
              $("#aluno_id").html('<option value="" disabled selected>Escolha uma opção</option>');
              $('select').select();
           } else {
              $.each(alunos, function (key, value) {
                 $('#aluno_id').append('<option value="' + value + '">' + key + '</option>');
                 $('select').select();
              });
           }
        });
     });
  </script>
  <br>
  {{-- <div class="row">
    <div class="col s12">
      <div id="evasometro" style="height: 200px;"></div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m6">
      <div id="graficoRenda" style="height: 400px;"></div>
    </div>
    <div class="col s12 m6">
      <div id="graficoEstadoCivil" style="height: 400px;"></div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m6">
      <div id="graficoSexo" style="height: 400px;"></div>
    </div>
    <div class="col s12 m6">
      <div id="graficoEtnia" style="height: 400px;"></div>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <div id="graficoEixos" style="height: 400px;"></div>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <div id="graficoIdade" style="height: 400px;"></div>
    </div>
  </div>
  <br> --}}
  
  <script type="text/javascript" src="{{ asset('js/graficos.js') }}"></script>
  
  @if(session('status'))
    <script type="text/javascript">
       $(document).ready(function () {
          M.toast({html: ' <?= session('status') ?> '});
       });
    </script>
  @endif

@endsection