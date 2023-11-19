<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToggleFavoriteControllerTest extends TestCase
{
  use RefreshDatabase;

  public function testItAuthorizesRequest()
  {
    $body = [
      'photo_id' => 1,
      'photo_url' => 'http://example.test/photo/1'
    ];

    $this->postJson(route('favorites.toggle'), $body)
      ->assertStatus(401);
  }

  /** @dataProvider photoIdValidatorProvider */
  public function testItValidatesPhotoId(mixed $value, string $expected)
  {
    $body = [
      'photo_id' => $value,
      'photo_url' => 'http://example.test/photo/1'
    ];

    $user = User::factory()->create();
    $this->actingAs($user)
      ->postJson(route('favorites.toggle'), $body)
      ->assertStatus(422)
      ->assertJsonPath('message', $expected);
  }

  public static function photoIdValidatorProvider(): array
  {
    return [
      [null, 'The photo id field is required.'],
      ['string', 'The photo id field must be an integer.'],
      [-1, 'The photo id field must be at least 0.']
    ];
  }

  /** @dataProvider photoUrlValidatorProvider */
  public function testItValidatesPhotoUrl(mixed $value, string $expected)
  {
    $body = [
      'photo_id' => 1,
      'photo_url' => $value
    ];

    $user = User::factory()->create();
    $this->actingAs($user)
      ->postJson(route('favorites.toggle'), $body)
      ->assertStatus(422)
      ->assertJsonPath('message', $expected);
  }

  public static function photoUrlValidatorProvider(): array
  {
    return [
      [null, 'The photo url field is required.'],
      [
        'https://exampletest/photo/loremipsumdolorsitametconsecteturadipiscingelitseddoeiusmodtemporincididuntutlaboreetdoloremagnaaliquautenimadminimveniamquisnostrudexercitationullamcolaborisnisiutaliquipexeacommodoconsequatloremipsumdolorsitametconsecteturadipiscingelitseddoeiusmod',
        'The photo url field must not be greater than 255 characters.'
      ]
    ];
  }

  public function testItCreatesFavorite()
  {
    $user = User::factory()->create();

    Favorite::factory()
      ->for($user)
      ->state(['photo_id' => 1])
      ->create();

    $body = [
      'photo_id' => 2,
      'photo_url' => 'http://example.test/photo/2'
    ];

    $this->actingAs($user)
      ->postJson(route('favorites.toggle'), $body)
      ->assertSuccessful()
      ->assertJson(['message' => 'Favorite created']);

    $this->assertDatabaseCount('favorites', 2);

    $this->assertDatabaseHas('favorites', [
      'user_id' => $user->id,
      'photo_id' => 2,
      'photo_url' => 'http://example.test/photo/2'
    ]);
  }

  public function testItDeletesFavorite()
  {
    $user = User::factory()->create();

    $favorite = Favorite::factory()
      ->for($user)
      ->state(['photo_id' => 1])
      ->create();

    Favorite::factory()
      ->state(['photo_id' => 1])
      ->create();

    $body = [
      'photo_id' => 1,
      'photo_url' => 'http://example.test/photo/1'
    ];

    $this->assertDatabaseCount('favorites', 2);

    $this->actingAs($user)
      ->postJson(route('favorites.toggle'), $body)
      ->assertSuccessful()
      ->assertJson(['message' => 'Favorite deleted']);

    $this->assertDatabaseCount('favorites', 1);

    $this->assertModelMissing($favorite);
  }
}
