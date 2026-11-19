<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'city',
        'country',
        'region',
        'location_type',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function originShipments()
    {
        return $this->hasMany(Shipment::class, 'origin_location_id');
    }

    public function destinationShipments()
    {
        return $this->hasMany(Shipment::class, 'destination_location_id');
    }

    public function trackingEvents()
    {
        return $this->hasMany(TrackingEvent::class, 'location_id');
    }
}