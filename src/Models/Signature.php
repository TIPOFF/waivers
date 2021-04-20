<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Models;

use Carbon\Carbon;
use Tipoff\Support\Contracts\Authorization\EmailAddressInterface;
use Tipoff\Support\Contracts\Booking\BookingParticipantInterface;
use Tipoff\Support\Contracts\Locations\LocationInterface;
use Tipoff\Support\Contracts\Waivers\SignatureInterface;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Waivers\Database\Factories\SignatureFactory;

class Signature extends BaseModel implements SignatureInterface
{
    use HasPackageFactory;

    protected $casts = [
        'emailed_at' => 'datetime',
        'minors_names' => 'array',
        'dob' => 'date',
    ];

    protected static function newFactory()
    {
        return SignatureFactory::new();
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($signature) {
            if (empty($signature->minors)) {
                $signature->minors = 0;
            }
        });
    }

    public function email()
    {
        return $this->hasOne(app('email_address'));
    }

    public function participant()
    {
        return $this->belongsTo(app('participant'));
    }

    public function location()
    {
        return $this->belongsTo(app('location'));
    }

    public function room()
    {
        return $this->belongsTo(app('room'));
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmailAddress(): EmailAddressInterface
    {
        return $this->email;
    }

    public function getLocation(): LocationInterface
    {
        return $this->location;
    }

    public function getParticipant(): BookingParticipantInterface
    {
        return $this->participant;
    }

    public function getDob(): Carbon
    {
        return $this->dob;
    }

    public function getSignatureDate(): Carbon
    {
        return $this->created_at;
    }
}
