<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function __invoke(Request $request)
  {
    $starredIds = $request->user()
      ->favorites()
      ->get(['photo_id'])
      ->pluck('photo_id');

    return view('dashboard')
      ->with(compact('starredIds'));
  }
}
