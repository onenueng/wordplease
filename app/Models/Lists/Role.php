<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, ListQueryable;

    // protected $dateFormat = 'Y-m-d H:i:s.u';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'name_short',
    ];
}
