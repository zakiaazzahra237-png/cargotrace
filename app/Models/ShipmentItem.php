<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'sku',
        'item_name',
        'quantity',
        'unit_weight_kg',
        'unit_volume_cbm',
        'remarks',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_weight_kg' => 'decimal:2',
        'unit_volume_cbm' => 'decimal:3',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}