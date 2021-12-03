<?php

namespace SIMEA\Http\Controllers;

use SIMEA\Models\Resultados;
use SIMEA\Models\Pessoa;
use SIMEA\Models\Questionario;
use Illuminate\Http\Request;

class RespostasController extends Controller
{

  public function index()
  {
    return view('respostas.index', [
      'questionarios' => Questionario::all()
    ]);
  }

  public function visualizar(int $id)
  {
    return view('respostas.visualizar', [
      'alunos' => Pessoa::all(),
      'resultados' => Resultados::where('questionario_id', $id)->get(),
      'questionarios' => Questionario::findOrFail($id),
      'count' => null /*contador do foreach*/
    ]);
  }

  public function show()
  {

  }
}
