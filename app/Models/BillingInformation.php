<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingInformation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cardholder_name',
        'card_number',
        'card_type',
        'expiration_month',
        'expiration_year',
        'cvc',
        'country',
        'is_default',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'card_number',
        'cvc',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_default' => 'boolean',
        'expiration_month' => 'integer',
        'expiration_year' => 'integer',
    ];

    /**
     * Get the user that owns the billing information.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 