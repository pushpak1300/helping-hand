<?php

namespace App\Repositories;

use App\Models\Receiver;
use App\Repositories\BaseRepository;

/**
 * Class ReceiverRepository
 * @package App\Repositories
 * @version December 19, 2020, 12:55 pm UTC
*/

class ReceiverRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'age'
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
        return Receiver::class;
    }
}
