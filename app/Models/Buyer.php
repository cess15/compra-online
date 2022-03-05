<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'person_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * person
     *
     * @return BelongsTo
     */
    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * saleProducts
     *
     * @return HasMany
     */
    public function saleProducts() : HasMany
    {
        return $this->hasMany(SaleProduct::class);
    }
}
