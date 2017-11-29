<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\RuntimeMaintainable;

class MaritalStatus extends Model implements AutoId
{
    use AutoIdInsertable, RuntimeMaintainable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * Get Id type of the model.
     *
     * @return stirng
     */
    public static function getIdType()
    {
        return 'id';
    }
    
}