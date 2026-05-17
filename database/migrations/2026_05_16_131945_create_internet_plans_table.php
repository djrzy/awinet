<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('download_speed');
            $table->unsignedInteger('upload_speed');
            $table->decimal('price');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internet_plans');
    }
};
