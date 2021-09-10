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
            $table->unsignedInteger('artist_id');
            $table->string('name', 120);
            $table->string('uri', 120);
            $table->unsignedInteger('rank');
            $table->unsignedInteger('playcount');
            $table->string('release_date', 32)->nullable()->default(null);
            $table->text('summary')->nullable()->default(null);
            $table->string('href', 45)->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['artist_id'], 'artist_id');

            $table->index(['playcount'], 'playcount');

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
