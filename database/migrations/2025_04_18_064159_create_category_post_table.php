<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_post', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->index();
            $table->foreignId('post_id')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_post');
    }
};
