<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserAddressFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * Address filter by user.
     *
     * @param mixed $user_id [User Table primary key]
     *
     * @return void|
     */
    public function user($user_id)
    {
        $this->where('user_addresses.user_id', $user_id);
    }

    /**
     * Address filter by country.
     *
     * @param mixed $country_id [Country Table primary key]
     *
     * @return void|
     */
    public function country($country_id)
    {
        $this->where('user_addresses.country_id', $user_id);
    }
}
