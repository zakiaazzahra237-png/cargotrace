<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentException extends Model
{
    use HasFactory;

    public const SEVERITY_LOW = 'LOW';
    public const SEVERITY_MEDIUM = 'MEDIUM';
    public const SEVERITY_HIGH = 'HIGH';

    public const STATUS_OPEN = 'OPEN';
    public const STATUS_INVESTIGATING = 'INVESTIGATING';
    public const STATUS_RESOLVED = 'RESOLVED';

    protected $fillable = [
        'shipment_id',
        'created_by',
        'resolved_by',
        'exception_type',
        'severity',
        'status',
        'title',
        'description',
        'resolution_notes',
        'detected_at',
        'resolved_at',
    ];

    protected $casts = [
        'detected_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}