<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\BaseRepository;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version December 19, 2020, 1:56 pm UTC
*/

class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_or_merchant_id',
        'reciever_id',
        'amount',
        'type'
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
        return Transaction::class;
    }
}
