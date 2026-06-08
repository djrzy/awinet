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
        Schema::create('customer_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('internet_plan_id')->constrained('internet_plans');
            $table->string('service_name');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->enum('status', ['pending', 'active', 'suspended', 'terminated'])->default('pending');
            $table->date('activation_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->date('deactivation_date')->nullable();
            $table->text('installation_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('router_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_services');
    }
};
