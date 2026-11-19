<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipment_exceptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->string('exception_type', 40); // CUSTOMS_HOLD, WEATHER_DELAY, PORT_CONGESTION, DAMAGED, MISROUTED, DOCUMENTATION_ISSUE
            $table->string('severity', 20)->default('MEDIUM'); // LOW, MEDIUM, HIGH
            $table->string('status', 20)->default('OPEN'); // OPEN, INVESTIGATING, RESOLVED
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->timestamp('detected_at');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index(['shipment_id', 'status']);
            $table->index('exception_type');
            $table->index('severity');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_exceptions');
    }
};