<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Waiver extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Waiver $waiver) {
            if (empty($waiver->released_at)) {
                $waiver->released_at = now();
            }
        });
    }

    public function location()
    {
        return $this->belongsTo(app('location'));
    }
}
