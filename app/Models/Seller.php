<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'person_id'
    ];

    /**
     * hidden
     *
     * @var array
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
