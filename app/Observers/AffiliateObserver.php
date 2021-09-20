<?php

namespace App\Observers;

use App\Models\Affiliate;
use App\Services\AffiliateLocation\AffiliateLocationService;

/**
 * Affiliate Model Observer
 */
final class AffiliateObserver
{
    /**
     * Handle the Affiliate "creating" event.
     *
     * @param  Affiliate  $affiliate
     * @return void
     */
    public function creating(Affiliate $affiliate)
    {
        $affiliate->setAttribute('eligible_for_events', $this->isEligible($affiliate));
    }

    /**
     * Handle the Affiliate "updating" event.
     *
     * @param  Affiliate  $affiliate
     * @return void
     */
    public function updating(Affiliate $affiliate)
    {
        $affiliate->setAttribute('eligible_for_events', $this->isEligible($affiliate));
    }

    /**
     * is Affiliate Eligible?
     *
     * @param Affiliate $affiliate
     * @return bool
     */
    private function isEligible(Affiliate $affiliate): bool
    {
        return AffiliateLocationService::make()
            ->setCoordinates($affiliate->getAttribute('latitude'), $affiliate->getAttribute('longitude'))
            ->isEligible();
    }
}
