<?php

namespace App\Models\Lists;

use App\Contracts\ListItem;
use App\Models\Lists\DrugRegimen;
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
    ];

    /**
     * Get fields whiches make where(or) in the query.
     *
     * @return array
     */
    public static function whereFields()
    {
        return ['name', 'generic_name', 'trade_name', 'synonyms'];
    }

    /**
     * Specific procedure for specific list class
     *
     * @return string
     */
    protected static function extraProcedure($keyWord)
    {
        // min drug name = 11 as of 2017-11-23
        if (strlen($keyWord) >= 11) {
            
            // check if there are regimens of the drug then return them
            $regimens = DrugRegimen::getList(trim($keyWord));
            if (count($regimens) > 0) {
                return $regimens;
            }

            // check if $keyWord is exact matched any drug then generate regimens
            $drugs = static::where('name', trim($keyWord))->get();
            if (count($drugs) == 1) {
                $regimens = DrugRegimen::getList(trim($keyWord));
                if (count($regimens) > 0) {
                    return $regimens->toArray();
                }
                return DrugRegimen::generateRegimens($drugs[0]);
            }
        }

        return [];
    }
}
