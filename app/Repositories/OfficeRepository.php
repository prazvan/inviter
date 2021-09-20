<?php

namespace App\Repositories;

use App\Helpers\Traits\Cacheable;
use App\Helpers\Traits\Singleton;
use App\Models\Office;
use App\Repositories\Eloquent\EloquentRepository;

/**
 * Office Repository
 */
final class OfficeRepository extends EloquentRepository
{
    use Singleton;

    /**
     * Get Office by ID
     *
     * @param int $id
     * @return Office
     */
    public function getById(int $id = 0): Office
    {
        return $this->cacheQuery('office_'.$id, function () use ($id)
        {
            return Office::find($id)->firstOrFail();
        });
    }
}
