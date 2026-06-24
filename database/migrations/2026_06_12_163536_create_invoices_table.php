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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->ulid('uuid')->unique();
            $table->foreignId('tenant_id')->nullable();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('service_id')->nullable()->references('id')->on('customer_services');
            $table->char('billing_period', 7);
            $table->string('billing_generation_type');
            $table->string('invoice_number')->unique();
            $table->decimal('subtotal', 15, 0);
            $table->decimal('tax', 15, 0)->nullable();
            $table->decimal('discount', 15, 0)->nullable();
            $table->decimal('grand_total', 15, 0);
            $table->date('issue_date');
            $table->date('due_date');
            $table->timestamp('paid_at')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->unique(['service_id', 'billing_period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
