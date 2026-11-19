<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tracking_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('location_id')->nullable()->constrained('locations')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->string('event_type', 40);
            $table->string('status_snapshot', 30)->nullable();
            $table->string('location_name', 150);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('description');
            $table->string('source_type', 30)->default('manual'); // manual, api, system
            $table->boolean('is_exception_event')->default(false);
            $table->timestamp('occurred_at');
            $table->timestamps();

            $table->index(['shipment_id', 'occurred_at']);
            $table->index('event_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tracking_events');
    }
};