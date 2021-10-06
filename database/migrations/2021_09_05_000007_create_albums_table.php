<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table): void {
            $table->increments('id');

            $table->string('spotify_id', 45)->index();
            $table->string('api_url', 191)->index();
            $table->string('spotify_uri', 191)->index();

            $table->unsignedInteger('artist_id');

            $table->string('name', 191)->index();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('artist_id', 'fk_albums_artists')
                ->references('id')->on('artists')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
}
