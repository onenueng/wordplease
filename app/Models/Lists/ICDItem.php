<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Traits\ListQueryable;
use App\Traits\AutoIdInsertable;
use App\Models\Lists\DrugRegimen;
use Illuminate\Database\Eloquent\Model;

class ICDItem extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, ListQueryable;

    protected $table = 'icd_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description'
    ];
}
