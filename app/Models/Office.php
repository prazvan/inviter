<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Office Model
 */
class Office extends Model
{
    use HasFactory;

    /**
     * Dublin Office ID
     */
    public const DUBLIN_OFFICE_ID = 1;

    /**
     * Allowed Distance
     */
    public const DUBLIN_ALLOWED_DISTANCE = 100; // 100 km radius;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offices';

    /**
     * Array with fillable attributes
     *
     * @var string[]
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'name',
        'created_at',
        'updated_at',
    ];
}
