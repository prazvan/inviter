<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Helpers\Traits\Singleton;
use App\Repositories\Eloquent\EloquentRepository;
use App\Models\Affiliate;

/**
 * Affiliate Repository
 */
final class AffiliateRepository extends EloquentRepository
{
    use Singleton;

    /**
     * Affiliate Model
     *
     * @var Affiliate
     */
    private Affiliate $affiliate;

    /**
     * Update or Create new Affiliate
     *
     * @param Collection $affiliate
     * @return Model
     */
    public function updateOrCreate(Collection $affiliate): Model
    {
        // search query
        $query = ['affiliate_id' => $affiliate->get('affiliate_id')];

        // new or updated attributes
        $fields = [
            'latitude' => $affiliate->get('latitude'),
            'longitude' => $affiliate->get('longitude'),
            'name' => $affiliate->get('name'),
        ];

        // update or create new affiliate
        return Affiliate::updateOrCreate($query, $fields);
    }


    /**
     * Get List with All eligible or ineligible Affiliates
     *
     * @param bool $eligible
     * @return Collection
     */
    public function getAll(bool $eligible = true): Collection
    {
        $cacheKey = ($eligible ? 'eligible_affiliates' : 'ineligible_affiliates');
        return $this->cacheQuery($cacheKey, function () use ($eligible)
        {
            return Affiliate::where('eligible_for_events', $eligible)
                ->orderBy('affiliate_id')
                ->get();
        });
    }

}
