<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Traits\AutoIdInsertable;
use App\Traits\DataImportable;
use App\Traits\ListQueryable;
use App\Traits\RuntimeMaintainable;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, DataImportable, RuntimeMaintainable, ListQueryable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'name_short',
        'active',
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

    /**
     * Get fields whiches selected for query.
     *
     * @return array
     */
    public static function selectFields()
    {
        return ['id as data', 'name as value'];
    }

    /**
     * Get fields whiches make where(or) in the query.
     *
     * @return array
     */
    public static function whereFields()
    {
        return ['name', 'name_short'];
    }
}
