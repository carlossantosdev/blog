<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up() : void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->string('serp_title')->nullable();
        });
    }

    public function down() : void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->dropColumn('serp_title');
        });
    }
};
