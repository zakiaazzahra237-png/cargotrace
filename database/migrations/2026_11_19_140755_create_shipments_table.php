<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_number', 50)->unique();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('carrier_id')->constrained('carriers')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('origin_location_id')->constrained('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('destination_location_id')->constrained('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('scenario_config_id')->constrained('shipment_scenario_configs')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('cargo_type', 100);
            $table->decimal('weight_kg', 12, 2)->default(0);
            $table->decimal('volume_cbm', 12, 3)->default(0);
            $table->string('current_status', 30)->default('CREATED');
            $table->timestamp('expected_departure_at')->nullable();
            $table->timestamp('expected_arrival_at')->nullable();
            $table->timestamp('estimated_arrival_at')->nullable();
            $table->timestamp('actual_arrival_at')->nullable();
            $table->decimal('delay_hours', 8, 2)->default(0);
            $table->boolean('is_delayed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('current_status');
            $table->index('is_delayed');
            $table->index(['origin_location_id', 'destination_location_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
};