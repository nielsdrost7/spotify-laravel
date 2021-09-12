<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('spotify_id', 45)->index();
            $table->string('api_url', 191)->index();
            $table->string('slug', 191)->index();
            $table->string('name', 191)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
}
