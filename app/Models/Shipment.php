<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_CREATED = 'CREATED';
    public const STATUS_BOOKED = 'BOOKED';
    public const STATUS_PICKED_UP = 'PICKED_UP';
    public const STATUS_IN_TRANSIT = 'IN_TRANSIT';
    public const STATUS_DELIVERED = 'DELIVERED';

    protected $fillable = [
        'shipment_number',
        'customer_id',
        'carrier_id',
        'origin_location_id',
        'destination_location_id',
        'scenario_config_id',
        'cargo_type',
        'weight_kg',
        'volume_cbm',
        'current_status',
        'expected_departure_at',
        'expected_arrival_at',
        'estimated_arrival_at',
        'actual_arrival_at',
        'delay_hours',
        'is_delayed',
        'notes',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'volume_cbm' => 'decimal:3',
        'expected_departure_at' => 'datetime',
        'expected_arrival_at' => 'datetime',
        'estimated_arrival_at' => 'datetime',
        'actual_arrival_at' => 'datetime',
        'delay_hours' => 'decimal:2',
        'is_delayed' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'carrier_id');
    }

    public function originLocation()
    {
        return $this->belongsTo(Location::class, 'origin_location_id');
    }

    public function destinationLocation()
    {
        return $this->belongsTo(Location::class, 'destination_location_id');
    }

    public function scenarioConfig()
    {
        return $this->belongsTo(ShipmentScenarioConfig::class, 'scenario_config_id');
    }

    public function items()
    {
        return $this->hasMany(ShipmentItem::class, 'shipment_id');
    }

    public function trackingEvents()
    {
        return $this->hasMany(TrackingEvent::class, 'shipment_id')->orderBy('occurred_at');
    }

    public function exceptions()
    {
        return $this->hasMany(ShipmentException::class, 'shipment_id')->orderByDesc('detected_at');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'shipment_id');
    }
}