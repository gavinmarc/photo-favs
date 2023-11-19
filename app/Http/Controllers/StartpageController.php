<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class StartpageController extends Controller
{
  public function __invoke(Request $request)
  {
    $favorites = Favorite::latest()
      ->limit(12)
      ->with('user')
      ->get();

    return view('start-page')
      ->with(compact('favorites'));
  }
}
