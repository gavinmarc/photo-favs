<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartpageController extends Controller
{
  public function __invoke(Request $request)
  {
    return view('start-page');
  }
}
