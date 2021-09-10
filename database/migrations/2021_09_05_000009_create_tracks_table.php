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
            $table->unsignedInteger('album_id');
            $table->string('name', 120);
            $table->string('duration', 12);
            $table->unsignedInteger('rank');
            $table->string('href', 45)->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['album_id'], 'artist_id');

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
