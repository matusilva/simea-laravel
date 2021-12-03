<?php

namespace SIMEA\Http\Controllers;

use SIMEA\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CampusController extends Controller
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
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('campus.index', ['campuses' => Campus::all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('campus.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $campus = new Campus;
    $campus->nome = $request->nome;
    $campus->save();

    return Redirect::route('campus.index')->with('status', 'Campus cadastrado com sucesso!');
  }

  /**
   * Display the specified resource.
   *
   * @param \SIMEA\Campus $campus
   * @return \Illuminate\Http\Response
   */
  public function show(Campus $campus)
  {
    // Not used
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \SIMEA\Campus $campus
   * @return \Illuminate\Http\Response
   */
  public function edit(Campus $campus)
  {
    return view('campus.edit', ['campus' => $campus]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \SIMEA\Campus $campus
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Campus $campus)
  {
    $campus->nome = $request->nome;
    $campus->save();

    return Redirect::route('campus.index')->with('status', 'Campus atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \SIMEA\Campus $campus
   * @return \Illuminate\Http\Response
   */
  public function destroy(Campus $campus)
  {
    $campus->delete();

    return Redirect::route('campus.index')->with('status', 'Campus deletado com sucesso!');
  }
}
