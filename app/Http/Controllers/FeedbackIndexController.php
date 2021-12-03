<?php

namespace SIMEA\Http\Controllers;

use SIMEA\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeedbackIndexController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
      $this->usuario = auth()->user();

      if ($this->usuario->tipo_id == 2) {
        return $next($request);
      } else {
        return redirect('board');
      }
    });
  }

  public function index()
  {
    return view('feedbacks.index',
      [
        'feedbacks' => Feedback::all()
      ]);
  }
}
