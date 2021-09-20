<?php

namespace App\Models;

use App\Observers\AffiliateObserver;

use App\Services\AffiliateLocation\AffiliateLocationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Affiliate Model
 *
 * The affiliate model has an Observer for different events
 *
 *
 * @extends AffiliateObserver
 */
class Affiliate extends Model
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'affiliates';

    /**
     * Array with fillable attributes
     *
     * @var string[]
     */
    protected $fillable = [
        'affiliate_id',
        'latitude',
        'longitude',
        'distance',
        'name',
        'eligible_for_events',
        'created_at',
        'updated_at',
    ];
}
