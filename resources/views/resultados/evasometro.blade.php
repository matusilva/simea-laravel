@extends('layouts.app')
@section('title')
  Evasometro
@endsection
@section('content')
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
@endsection