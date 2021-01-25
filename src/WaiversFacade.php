<?php

namespace Tipoff\Waivers;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tipoff\Waivers\Waivers
 */
class WaiversFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'waivers';
    }
}
