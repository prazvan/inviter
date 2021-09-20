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
     * Otherwise, just update their details.
     *
     * @return $this
     * @throws \Exception
     */
    public function updateAffiliates(): self
    {
        try
        {
            // loop through the list of invitees and update database with new affiliates
            $this->invitees->each(function ($invitee)
            {
                // check if we need to update or create a new affiliate
                AffiliateRepository::make()->updateOrCreate($invitee);
            });
        }
        catch (\Exception $exception)
        {
            // TODO: some generic error Handling can be done here

            throw $exception;
        }

        return $this;
    }

    /**
     * Get a list with All the Eligible Invitees
     *
     * @return Collection
     * @throws \Exception
     */
    public function getAllEligibleInvitees(): ?Collection
    {
        return AffiliateRepository::make()->getAll(true);
    }

    /**
     * Get a list with All the Ineligible Invitees
     *
     * @return Collection
     * @throws \Exception
     */
    public function getAllIneligibleInvitees(): ?Collection
    {
        return AffiliateRepository::make()->getAll(false);
    }
}
