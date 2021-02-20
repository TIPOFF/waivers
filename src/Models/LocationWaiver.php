<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Models;

use Tipoff\Locations\Models\Location;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class LocationWaiver extends BaseModel
{
    use HasPackageFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
