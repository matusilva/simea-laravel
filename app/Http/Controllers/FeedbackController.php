<?php

namespace SIMEA\Http\Controllers;

use SIMEA\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeedbackController extends Controller
{

  public function store(Request $request)
  {
    $feedback = new Feedback;
    $feedback->nota = $request->nota;
    $feedback->feedback = $request->feedback;
    $feedback->save();

    return Redirect::route('quiz.escolher')->with('status', 'Obrigado por nos dar seu feedback!');
  }
}
