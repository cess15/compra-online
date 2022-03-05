<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleProduct extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'buyer_id',
        'seller_id'
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * product
     *
     * @return BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * buyer
     *
     * @return BelongsTo
     */
    public function buyer() : BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }

    /**
     * seller
     *
     * @return BelongsTo
     */
    public function seller() : BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }


}
