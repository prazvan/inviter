<?php

namespace App\Services\Invitation;

use App\Helpers\Traits\Singleton;
use App\Repositories\AffiliateRepository;
use Illuminate\Support\Collection;

/**
 * Invitation Service
 */
final class InvitationService
{
    use Singleton;

    /**
     * @var Collection
     */
    private Collection $invitees;

    /**
     * @param Collection $collection
     * @return $this
     */
    public function setInvitees(Collection $collection): self
    {
        $this->invitees = $collection;
        return $this;
    }

    /**
     * Check if we have new affiliates, if so save there credentials for later use.
     * Otherwise, just update there details.
     *
     * @return $this
     */
    public function updateAffiliates(): self
    {
        try
        {
            // loop through the list of invitees and update database with new affiliates
            $this->invitees->each(function ($invitee)
            {
                // check if we need to update or create a new affiliate
                AffiliateRepository::make()->createOrUpdate($invitee);
            });
        }
        catch (\Exception $exception)
        {
            dd($exception);
        }
    }

    /**
     *
     *
     * @return Collection
     */
    public function getListWithEligibleInvitees() : Collection
    {
        try
        {
            $whitelist = collect([]);

            // loop through the list of invitees and determinate which one is eligible for an invitation
            $this->invitees->each(function ($invitee, $index) use ($whitelist)
            {
                // save affiliate
                $affiliate = AffiliateRepository::make()->get($invitee);

                if ($affiliate->iseligibleForEvent())
                {
                    $whitelist->push($affiliate);
                }

            });

            dd($whitelist);

        }
        catch (\Exception $exception)
        {
            dd($exception);
        }

        return collect([]);
    }
}
