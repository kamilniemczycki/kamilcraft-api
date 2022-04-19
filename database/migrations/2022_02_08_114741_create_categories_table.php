<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->char('name', 20)->nullable();
            $table->char('slug', 20)->unique();
            $table->integer('priority')->nullable()->default(0);
            $table->boolean('default')->nullable()->default(false);
            $table->boolean('visible')->nullable()->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
