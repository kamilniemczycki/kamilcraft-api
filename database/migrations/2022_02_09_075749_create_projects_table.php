<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->json('categories')->nullable()->default(null);
            $table->string('author', 30);
            $table->json('images')->nullable()->default(null);
            $table->dateTimeTz('release_date')->nullable()->useCurrent();
            $table->dateTimeTz('update_date')->nullable()->default(null);
            $table->string('project_url', 255)->nullable()->default(null);
            $table->string('project_version', 20)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->boolean('visible')->nullable()->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }

}
