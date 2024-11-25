<?php

namespace Ellagiou\CustomSocialitePackage;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ellagiou\CustomSocialitePackage\Skeleton\SkeletonClass
 */
class CustomSocialitePackageFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'custom-socialite';
    }
}
