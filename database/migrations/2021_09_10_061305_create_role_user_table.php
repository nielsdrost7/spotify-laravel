<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table): void {
            $table->unsignedInteger('user_id')->index('fk_role_user_user_id');
            $table->unsignedInteger('role_id')->index('fk_role_user_role_id');
            $table->foreign('role_id', 'role_user_roles')->references('id')->on('roles')->onDelete('CASCADE');
            $table->foreign('user_id', 'role_user_users')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
}
