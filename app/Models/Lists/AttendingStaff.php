<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\DataImportable;
use App\Traits\RuntimeMaintainable;

class AttendingStaff extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable, RuntimeMaintainable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'division_id',
        'licence_no',
        'active'
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
