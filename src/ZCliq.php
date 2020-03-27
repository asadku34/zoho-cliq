<?php

namespace Asad\ZohoCliq;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Asad\ZohoCliq\Skeleton\SkeletonClass
 */
class ZCliq extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zoho-cliq';
    }
}
