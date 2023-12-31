<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToggleFavoriteRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'photo_id' => ['required', 'integer', 'min:0'],
      'photo_url' => ['required', 'string', 'max:255'],
    ];
  }
}
