<?php

namespace App\Repositories\Eloquent;

use App\Helpers\Traits\Cacheable;

/**
 * Class EloquentRepository
 * @package App\Repositories\Eloquent
 */
abstract class EloquentRepository
{
    /**
     * Trait for caching queries
     */
    use Cacheable;

    /**
     * Create new instance of self statically.
     *
     * @return static|object
     */
    public static function make()
    {
        return new static;
    }
}
