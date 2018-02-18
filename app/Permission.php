<?php

namespace App;

use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Traits\DataImportable;
use App\Traits\AutoIdInsertable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, DataImportable, ListQueryable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];
}
