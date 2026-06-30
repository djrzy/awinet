<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Pengenal, contoh: "Router Pusat hAPlite", "Core OLT Sektor Utara"
            $table->string('host'); // IP Router / DDNS (Contoh: 192.168.88.1)
            $table->string('username');
            $table->string('password');
            $table->integer('port')->default(8728); // Port API standar Mikrotik
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routers');
    }
};
