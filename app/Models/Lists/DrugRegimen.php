<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Contracts\ListItem;
use App\Models\Lists\Drug;
use App\Traits\AutoIdInsertable;
use App\Traits\ListQueryable;
use Illuminate\Database\Eloquent\Model;

class DrugRegimen extends Model implements AutoId, ListItem
{
    use AutoIdInsertable, ListQueryable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'drug_id',
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

    /**
     * Generate regimes of given drug.
     *
     * @param App\Models\Lists\Drug $drug
     * @return Array
     *
     */
    public static function generateRegimens(Drug $drug)
    {
        if (static::where('drug_id', $drug->id)->count() == 0) {
            foreach(static::regimen() as $index => $regimen) {
                static::insert([
                    'drug_id' => $drug->id,
                    'name' => $drug->name . ' ' . $regimen
                ]);
            }
        }

        return static::getList($drug->name);
    }

    /**
     * Basic regimens.
     *
     * @return Array
     */
    protected static function regimen()
    {
        return ['1x1', '1x3', '2x1', '2x3', '3x1', '3x3', 'prn'];
    }
}
