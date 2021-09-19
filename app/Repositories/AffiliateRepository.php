<?php

namespace App\Repositories;

use App\Helpers\Traits\Cacheable;
use App\Helpers\Traits\Singleton;
use App\Models\Affiliate;
use App\Repositories\Eloquent\EloquentRepository;

use Illuminate\Support\Collection;

/**
 * Affiliate Repo
 */
final class AffiliateRepository extends EloquentRepository
{
    use Singleton, Cacheable;

    /**
     * Affiliate Model
     *
     * @var Affiliate
     */
    private Affiliate $affiliate;

    public function createOrUpdate(Collection $affiliate): self
    {
        /**
         * Find Affiliate by affiliate_id
         * @var Affiliate $affiliate;
         */
        $affiliateModel = Affiliate::find(8);

        $affiliateModel->update([
            'affiliate_id' => $affiliate->get('affiliate_id'),
            'latitude' => $affiliate->get('latitude'),
            'longitude' => $affiliate->get('longitude'),
            'name' => $affiliate->get('name'),
        ]);

        // update with new data


        dd($affiliateModel, $affiliate->toArray());

        // set affiliate
//        $this->affiliate = new Affiliate($affiliate->toArray());


        return $this;
    }

}
