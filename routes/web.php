<?php

Auth::routes();

Route::get('/', function () {
  return view('home');
})->name('home');
Route::get('/board', 'HomeController@dashboard')->name('dashboard');
Route::get('/perfil', 'PessoaController@perfil')->name('perfil');

// Adicionar Questões ao Questionário
Route::get('/inserir-questoes', 'QuestaoController@addquestoes')->name('addquestoes');
Route::get('/{id}/adicionar-questoes', 'QuestaoController@add')->name('add');
Route::post('/{id}/adicionar-questoes', 'QuestaoController@addupdate')->name('addupdate');

Route::resource('campus', 'CampusController');

Route::resource('diretoria', 'DiretoriaController');

Route::resource('curso', 'CursoController');

Route::resource('turma', 'TurmaController');

Route::resource('eixo', 'EixoController');

Route::resource('aluno', 'PessoaController');

Route::resource('questao', 'QuestaoController');

Route::resource('questionario', 'QuestionarioController');

Route::resource('feedbacksindex', 'FeedbackIndexController');

Route::resource('respostas', 'RespostasController');

// Vínculo
Route::get('/vinculo/status', 'HomeController@status')->name('vinculo.status');
Route::post('/vinculo/verificar', 'HomeController@verificar')->name('vinculo.verificar');

// Questionários
Route::get('/quiz/escolher', 'HomeController@escolher')->name('quiz.escolher');
Route::get('/quiz/{id}/checar/', 'HomeController@checar')->name('quiz.checar');
Route::get('/quiz/{id}/{questao}/iniciar/', 'HomeController@iniciar')->name('quiz.iniciar');
Route::post('/quiz/resultado', 'HomeController@resultado')->name('quiz.resultado');
Route::post('/quiz/resultadoInativo', 'HomeController@resultadoInativo')->name('quiz.resultadoInativo');
Route::get('/quiz/final/{qts}', 'HomeController@finalDoQuestionario')->name('quiz.final');
Route::post('/quiz/feedback', 'FeedbackController@store')->name('feedback');

// Email
Route::get('/notificarQuestionario', 'HomeController@notificarQuestionario');

// Respostas
Route::get('/respostas/{id}/visualizar/', 'RespostasController@visualizar')->name('respostas.visualizar');

// Evasometro
Route::get('/evasometro', 'ResultadosController@evasometro')->name('resultados.evasometro');

// Gráficos
Route::get('/consultar', 'ResultadosController@index')->name('consultar');
Route::post('/consultar', 'ResultadosController@consultarDados')->name('consultarDados');

// API
Route::get('/campus/diretorias/{id}', 'DiretoriaController@diretorias');
Route::get('/diretoria/cursos/{id}', 'CursoController@cursos');
Route::get('/curso/turmas/{id}', 'TurmaController@turmas');
Route::get('/turma/alunos/{id}', 'PessoaController@alunos');
