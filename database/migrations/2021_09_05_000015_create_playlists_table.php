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
            $table->unsignedInteger('album_id');
            $table->string('type', 16);
            $table->char('color', 7);

            $table->index(['album_id'], 'artist_id');
            $table->foreign('album_id', 'fk_albums_palette_albums')
                ->references('id')->on('albums')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums_palette');
    }
}
