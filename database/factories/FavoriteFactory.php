<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
  protected $model = Favorite::class;

  public function definition(): array
  {
    return [
      'user_id' => User::factory()->lazy(),
      'photo_id' => $this->faker->randomNumber(),
      'photo_url' => $this->faker->url(),
    ];
  }
}
