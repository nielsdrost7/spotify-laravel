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
            $table->string('name', 120);
            $table->string('uri', 120);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
}
