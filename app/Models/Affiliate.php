<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Affiliate Model
 */
class Affiliate extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'affiliates';

    protected $fillable = [
        'affiliate_id',
        'latitude',
        'longitude',
        'name',
        'created_at',
        'updated_at',
    ];
}
