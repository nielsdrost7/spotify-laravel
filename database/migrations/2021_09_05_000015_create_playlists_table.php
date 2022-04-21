<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    public function up(): void
    {
        Schema::create('playlists', function (Blueprint $table): void {
            $table->increments('id');

            $table->string('spotify_id', 45)->index();
            $table->string('api_url', 191)->index();
            $table->string('spotify_uri', 191)->index();
            $table->string('name', 191)->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
}
