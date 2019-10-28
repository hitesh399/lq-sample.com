<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Singsys\LQ\Lib\Media\Relations\Concerns\HasMediaRelationships;

class UserAddress extends Model
{
    use HasMediaRelationships;
    use Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'country_id', 'region_id', 'city_id', 'postal_code', 'landmark',
        'address_line_1', 'address_line_2',
    ];

    /**
     * Relation with media to access the address proof.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addressProof()
    {
        return $this->morphOneMedia(
            \Config::get('lq.media_model_instance'),
            'mediable',
            'address_proof',
            __FUNCTION__
        );
    }

    /**
     * Relation with user to get the information and may action,.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation with user to get the information and may action,.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Relation with user to get the information and may action,.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Relation with user to get the information and may action,.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
