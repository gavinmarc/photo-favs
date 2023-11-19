<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StartpageTest extends TestCase
{
  use RefreshDatabase;

  public function testItRendersPageToGuests()
  {
    $this->get('/')
      ->assertStatus(200);
  }

  public function testItShowsLatestFavorites()
  {
    $this->travelTo('2023-11-01 12:00:00');
    Favorite::factory()
      ->for(User::factory()->state(['name' => 'Max']))
      ->create();

    $this->travelTo('2023-11-01 12:00:01');
    Favorite::factory()->count(11)->create();

    $this->travelTo('2023-11-01 12:00:02');
    Favorite::factory()
      ->for(User::factory()->state(['name' => 'Luna']))
      ->create();

    $this->get('/')
      ->assertStatus(200)
      ->assertSee('Liked by Luna')
      ->assertDontSee('Liked by Max');
  }

  public function testItShowsMessageIfNoFavoritesSet()
  {
    $this->get('/')
      ->assertStatus(200)
      ->assertSee('No photos have been marked as favorites yet. Register and be the first!');
  }
}
