<?php

namespace SIMEA\Http\Controllers;

use SIMEA\User;
use SIMEA\Models\Pessoa;
use SIMEA\Models\Questao;
use SIMEA\Models\Motivo;
use SIMEA\Models\Resultados;
use SIMEA\Models\Questionario;
use SIMEA\Models\Eixo;
use SIMEA\Models\Campus;
use SIMEA\Models\Diretoria;
use SIMEA\Models\Curso;
use SIMEA\Models\Feedback;
use SIMEA\Mail\NotificarQuestionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function dashboard()
  {
    return view('dashboard',
      [
        'alunos' => Pessoa::all(),
        'campuses' => Campus::all(),
        'diretorias' => Diretoria::all(),
        'questionarios' => Questionario::all(),
        'cursos' => Curso::all(),
        'feedbacks' => Feedback::all(),
        'resultados' => Resultados::all()
      ]);
    // $this->usuario = auth()->user();
    // if($this->usuario->tipo_id == 2) {
    //   return view('dashboard');
    // } else {
    //   return view('dashboardAluno');
    // }
  }

  public function inicio()
  {
    return view('inicio',
      [
        'alunos' => Pessoa::all(),
        'campuses' => Campus::all(),
        'diretorias' => Diretoria::all(),
        'questionarios' => Questionario::all(),
        'cursos' => Curso::all(),
        'feedbacks' => Feedback::all(),
        'resultados' => Resultados::all()
      ]);
  }

  /**
   * Mostra a view de atualização de vínculo
   *
   * @return \Illuminate\Http\Response
   */
  public function status()
  {
    return view('quiz.status');
  }

  /**
   * Atualiza o vínculo do aluno com a instituição.
   *
   * @return \Illuminate\Http\Response
   */
  public function verificar(Request $request)
  {
    $aluno = Pessoa::where('user_id', Auth::user()->id)->first();
    $aluno->vinculo = $request->vinculo;
    $aluno->save();

    return Redirect::route('quiz.escolher');
  }

  /**
   * De acordo com sua situação atual o redireciona para o questionário recomendado.
   *
   * @return \Illuminate\Http\Response
   */

  public function escolher()
  {
    $aluno = Pessoa::where('user_id', Auth::user()->id)->first();
    if ($aluno->vinculo == 1) {
      return view('quiz.questionarioAtivo', [
        'questionarios' => Questionario::where('disponivel', 1)->get(),
        'resultados' => Resultados::where('pessoa_id', Auth::user()->pessoa->id)->get()
      ]);
    } else if ($aluno->vinculo == 2) {
      return view('quiz.questionarioInativo');
    }
  }

  /* Função checar
 *	Objetivo: checar em qual questão o usuário parou ao responder
 *   incompletamente o questionário e redirecionar à pergunta *posterior.
  */

  public function checar(int $id)
  {
    $last_result = Resultados::where('questionario_id', $id)->orderBy('questao_id', 'desc')->first();
    error_log("last_result: " . $last_result['questao_id']);

    if ($last_result['questao_id'] == null) {
      $last_result['questao_id'] = 0;
    }

    return redirect('/quiz/' . $id . '/' . $last_result['questao_id'] . '/iniciar'); //redireciona para o Inicar questionário com os indices do primeira e ultima questao
  }

  /**
   * Inicia o questionário e recebe o $id do questionário como parâmetro.
   *
   * @return \Illuminate\Http\Response
   */
  public function iniciar(int $id, int $questao)
  {
    //Descobre se o usuário já havia respondido alguma pergunta referente a aquele questionário.
    //$resultado = Resultados::where('pessoa_id', Auth::user()->pessoa->id)->where('questionario_id', $id)->first();
    //Parâmetros:
    //$id : id do questionário
    //$questao : id da questao em que se parou de responder

    //DESCRIÇÃO DO ERRO
    //Primeira iteração $resultado = 0;
    //Segunda iteração $resultado != 0;
    //A partir da segunda iteração $resultado = 0;

    $questao++; //Proxima questão a ser respondida;

    $resultado = Resultados::where('pessoa_id', Auth::user()->pessoa->id)->where('questao_id', $id)->first();
    if ($resultado == null) {
      $resultado_id = 0; // Caso não é enviado valor '0' para a view.
    } else {
      $resultado_id = $resultado->id; // Caso sim é enviado o id do resultado para aquele usuário.
    }
    return view('quiz.perguntas', [
      'questoes' => Questao::where('questionario_id', $id)->paginate(1), //1 questão por página
      //'questoes'=>Questao::where('questionario_id', $id)->paginate($countQuest), //mostra o questionário completo
      'lastQuestion' => $questao,
      'questionario' => Questionario::findOrFail($id),
      'eixo' => Eixo::findOrFail($id),
      'resultado' => $resultado_id,
    ]);
  }

  /**
   * Calcula a pontuação do usuário para questionários ativos.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function resultado(Request $request)
  {
    //Alterações recentes 25/02/2019
    $pontos = 0;

    // Caso o resultado_id seja valor '0' deve-se criar um novo resultado.
    // Caso não, então se atualiza o resultado já existente.
    // ERRO: Atualizar que está sobrescrevendo o primeiro resultado do questionario

    //$update = Resultados::select('select id FROM resultados ORDER BY id DESC LIMIT 1')

    // $update = Resultados::select('select * FROM resultados WHERE id = ?', [$request->resultado_id]);
    // if(empty($update)){
    //   $resultado = new Resultados;
    // }
    // else{
    //   $resultado = Resultados::findOrFail($request->resultado_id);
    // }

    // if($request->resultado_id == 0) {
    //   $resultado = new Resultados;
    // } else {
    //   $resultado = new Resultados;
    //   //$resultado = Resultados::findOrFail($request->resultado_id);
    // }

    $resultado = new Resultados;

    //Solução: Use o codigo abaixo para contornar o erro e comente o código acima;
    // $ultimoid = Resultados::getPdo()->lastInsertId();

    // if($request->questao_id == ultimoid){
    //   $resultado = Resultados::findOrFail($request->resultado_id);
    // }
    // $idLast = DB::connection('mysql')->pdo->lastInsertId();

    $pontos += $request->alternativa0 * 1;
    $pontos += $request->alternativa1 * 2;
    $pontos += $request->alternativa2 * 3;
    $pontos += $request->alternativa3 * 4;

    $pontos %= 20;
    //$pontos -=20;

    // Para acumular os pontos das questões passadas
    $pontos += $resultado->pontos;

    // Fazer a média com os pontos já existentes, caso existam.
    if ($resultado->pontos != 0) {
      $pontos /= 2;
    }

    $resultado->pontos = $pontos;
    $resultado->pessoa_id = Auth::user()->pessoa->id;
    $resultado->questionario_id = $request->questionario_id;
    $resultado->questao_id = $request->questao_id;
    $resultado->eixo_id = $request->eixo_id;

    //error_log("Questão: ".$request->questao_id);

    $resultado->save();

    $query = Resultados::where('pessoa_id', Auth::user()->pessoa->id)
      ->where('questao_id', $request->questao_id)
      ->where('questionario_id', $request->questionario_id)
      ->count();

    $questoes = Resultados::where('questao_id', $request->questao_id)
      ->where('questionario_id', $request->questionario_id)
      ->get();

    $qt = Resultados::where('questao_id', $request->questao_id)
      ->where('questionario_id', $request->questionario_id)
      ->orderBy('id', 'desc')
      ->first();

    error_log("Resps p/Questão: " . $query);
    //error_log("Questao : ".$questao);
    error_log("Questões : " . $questoes);
    error_log("Questão + antiga: " . $qt->id);

    //sobrescrita do resultdo -> se o aluno responder a mesma pergunta duas vezes isso irá atualizar apagando o resultado anterior
    if ($query > 1) {
      Resultados::where('pessoa_id', Auth::user()->pessoa->id)
        ->where('questao_id', $request->questao_id)
        ->where('questionario_id', $request->questionario_id)
        ->where('id', '<', $qt['id'])
        ->delete();
    }

    return redirect($request->next_url);
  }

  /**
   * Salva os motivos do aluno inativo em evadir da instituição.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function resultadoInativo(Request $request)
  {
    $motivos = new Motivo;
    foreach ($request->motivos as $motivo) {
      $motivos->motivos .= $motivo . "<br>";
    }
    //$motivos->motivos .= $request->outro . "<br>";
    $motivos->resposta = $request->outro;

    $motivos->pessoa_id = Auth::user()->pessoa->id;

    $motivos->save();

    return Redirect::route('home');
  }

  public function finalDoQuestionario(int $questionario)
  {
    error_log("TESTE: " . $questionario);
    $resp_qtde = Resultados::where('questionario_id', $questionario)
      ->count();

    $quest_qtde = Questao::where('questionario_id', $questionario)
      ->count();

    error_log("resp_qtde = " . $resp_qtde);
    error_log("quest_qtde = " . $quest_qtde);

    /*UPDATE no questionário, tornando-o indisponível, pois presume-se que todo o questionário foi respondido.*/

    // $quest = Questionario::where('id', $questionario)
    // 				       ->update(['respondido' => 0]);


    error_log("UPLOAD feito com sucesso!");


    return view('quiz.final');
  }

  public function notificarQuestionario()
  {
    $output = new \Symfony\Component\Console\Output\ConsoleOutput();
    $users = User::all();

    foreach ($users as $user) {
      $output->writeln("<info>print 1</info>");
      $user = User::where('id', $user->id)->first();

      $output->writeln("<info>print 2</info>");

      Mail::to($user)->send(new NotificarQuestionario($user));
      $output->writeln("<info>print 3</info>");
    }

    return Redirect::route('questionario.index')->with('status', 'Notificação enviada com Sucesso!');
  }
}
