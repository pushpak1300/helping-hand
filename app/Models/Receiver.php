<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Receiver",
 *      required={"age"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="age",
 *          description="age",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Receiver extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'receivers';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'age',
        'created_by',
        'user_id',
        'merchants_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'age' => 'integer',
        'created_by' => 'integer',
        'user_id' => 'integer'
    ];

    public function toArray()
    {
        return [
            'id' => $this->user->id,
            'age' => $this->age,
            'city' => $this->merchant->city,
            'name' => $this->user->name,
            'avtar' => 'https://i.pravatar.cc/300'
        ];
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'age' => 'required numeric'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchants_by');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
