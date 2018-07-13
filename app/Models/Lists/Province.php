<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\DataImportable;
use App\Traits\RuntimeMaintainable;

class Province extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable, RuntimeMaintainable;

    // protected $dateFormat = 'Y-m-d H:i:s.u';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'region',
        'name'
    ];
    
}
