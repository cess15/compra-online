<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'per_name',
        'per_second_name',
        'per_lastname',
        'per_second_lastname',
        'pers_full_name',
        'pers_identification',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * booted
     *
     * @return void
     */
    public static function booted()
    {
        static::creating(function (Person $person) {
            $person->generateFullName($person);
        });

        static::updating(function (Person $person) {
            $person->generateFullName($person);
        });
    }

    /**
     * generateFullName
     *
     * @param  mixed $person
     * @return void
     */
    public function generateFullName(Person $person)
    {
        $person->pers_full_name = $person->per_name
            . ' ' . $person->pers_secondname
            . ' ' . $person->per_lastname
            . ' ' . $person->per_second_lastname;

    }

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * seller
     *
     * @return HasOne
     */
    public function seller() : HasOne
    {
        return $this->hasOne(Seller::class);
    }

    /**
     * buyer
     *
     * @return HasOne
     */
    public function buyer() : HasOne
    {
        return $this->hasOne(Buyer::class);
    }
}
