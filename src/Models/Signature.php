<?php

namespace Tipoff\Waivers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Waivers\Database\Factories\SignatureFactory;

class Signature extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public function participant()
    {
        return $this->belongsTo(config('waivers.model_class.participant'), 'participant_id');
    }

    public function room()
    {
        return $this->belongsTo(config('waivers.model_class.room'), 'room_id');
    }
}
