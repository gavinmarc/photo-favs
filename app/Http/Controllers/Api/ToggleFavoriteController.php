<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToggleFavoriteRequest;

class ToggleFavoriteController extends Controller
{
  public function __invoke(ToggleFavoriteRequest $request)
  {
    $exists = $request->user()
      ->favorites()
      ->where('photo_id', $request->input('photo_id'))
      ->exists();

    return $exists
      ? $this->handleDelete($request)
      : $this->handleCreate($request);
  }

  private function handleDelete(ToggleFavoriteRequest $request)
  {
    $request->user()
      ->favorites()
      ->where('photo_id', $request->input('photo_id'))
      ->delete();

    return $this->defaultResponse('Favorite deleted');
  }

  private function handleCreate(ToggleFavoriteRequest $request)
  {
    $request->user()
      ->favorites()
      ->create($request->validated());

    return $this->defaultResponse('Favorite created');
  }
}
