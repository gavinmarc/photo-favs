<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('favorites', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained();
      $table->unsignedInteger('photo_id');
      $table->string('photo_url', 255);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('favorites');
  }
};
