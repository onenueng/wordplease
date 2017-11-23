<?php

namespace App\Models\Lists;

use App\Contracts\ListItem;
use App\Traits\DataImportable;
use App\Traits\ListQueryable;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model implements ListItem
{
    use DataImportable, ListQueryable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'generic_name',
        'trade_name',
        'synonyms',
        'key', // maybe should remove
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
        return ['name', 'generic_name', 'trade_name', 'synonyms'];
    }
    
}
