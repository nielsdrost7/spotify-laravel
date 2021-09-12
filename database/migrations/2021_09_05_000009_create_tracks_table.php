<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('spotify_id', 45)->index();
            $table->string('api_url', 191)->index();
            $table->unsignedInteger('album_id', 45);
            $table->string('name', 191)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('album_id', 'fk_tracks_albums')
                ->references('id')->on('albums')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
}
