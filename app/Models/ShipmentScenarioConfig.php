<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentScenarioConfig extends Model
{
    use HasFactory;

    protected $table = 'shipment_scenario_configs';

    protected $fillable = [
        'code',
        'name',
        'origin_region',
        'destination_region',
        'delay_threshold_hours',
        'primary_exception_type',
        'primary_kpi',
        'description',
        'is_active',
    ];

    protected $casts = [
        'delay_threshold_hours' => 'integer',
        'is_active' => 'boolean',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'scenario_config_id');
    }
}