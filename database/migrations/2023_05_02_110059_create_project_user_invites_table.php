<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_user_invite', function (Blueprint $table) {
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('CASCADE');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_user_invite');
    }
};
