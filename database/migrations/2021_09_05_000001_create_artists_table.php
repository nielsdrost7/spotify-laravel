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
            $table->string('name', 70);
            $table->string('uri', 70);
            $table->text('biography')->nullable()->default(null);
            $table->unsignedInteger('listeners');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['uri'], 'uri');

            $table->index(['listeners'], 'listeners');

            $table->index(['name'], 'name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
}
