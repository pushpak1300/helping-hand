<?php

namespace App\Repositories;

use App\Models\Merchant;
use App\Repositories\BaseRepository;

/**
 * Class MerchantRepository
 * @package App\Repositories
 * @version December 19, 2020, 1:30 pm UTC
*/

class MerchantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'shop_name',
        'city',
        'shop_type',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Merchant::class;
    }
}
