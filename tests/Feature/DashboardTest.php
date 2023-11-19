<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
  use RefreshDatabase;

  public function testItChecksIfUserIsAuthorizedToSee()
  {
    $this->get('/dashboard')
      ->assertRedirectToRoute('login');
  }

  public function testItShowsDashboardToLoggedInUser()
  {
    $this->actingAs(User::factory()->create())
      ->get('/dashboard')
      ->assertSee('<photo-favorite-view', false);
  }

  public function testItPassesUserFavorites()
  {
    $user = User::factory()->create();

    $favoriteIds = Favorite::factory()
      ->count(5)
      ->for($user)
      ->create()
      ->pluck('photo_id')
      ->implode(',');

    Favorite::factory()->count(3)->create();

    $this->actingAs($user)
      ->get('/dashboard')
      ->assertSee(":initial-ids=\"[$favoriteIds]\"", false);
  }
}
