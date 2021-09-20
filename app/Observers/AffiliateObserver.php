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
     */
    public function creating(Affiliate &$affiliate): Affiliate
    {
        $service = self::getAffiliateLocationService($affiliate);

        $affiliate->setAttribute('eligible_for_events', $service->isEligible());
        $affiliate->setAttribute('distance', $service->getDistance());

        return $affiliate;
    }

    /**
     * Handle the Affiliate "updating" event.
     *
     * @param  Affiliate  $affiliate
     */
    public function updating(Affiliate &$affiliate): Affiliate
    {
        $service = self::getAffiliateLocationService($affiliate);

        $affiliate->setAttribute('eligible_for_events', $service->isEligible());
        $affiliate->setAttribute('distance', $service->getDistance());

        return $affiliate;
    }

    /**
     * Get Affiliate Service
     *
     * @param Affiliate $affiliate
     * @return AffiliateLocationService
     */
    private static function getAffiliateLocationService(Affiliate $affiliate) : AffiliateLocationService
    {
        return AffiliateLocationService::make()
            ->setCoordinates((float) $affiliate->getAttribute('latitude'), (float) $affiliate->getAttribute('longitude'));
    }
}
