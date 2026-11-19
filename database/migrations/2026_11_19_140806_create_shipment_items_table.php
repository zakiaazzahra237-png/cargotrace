<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('sku', 60)->nullable();
            $table->string('item_name', 150);
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_weight_kg', 12, 2)->default(0);
            $table->decimal('unit_volume_cbm', 12, 3)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->index('sku');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipment_items');
    }
};