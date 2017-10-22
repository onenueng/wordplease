<?php

namespace App\Models\Lists;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\DataImportable;
use App\Traits\RuntimeMaintainable;

class Postcode extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable, RuntimeMaintainable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'postcode',
        'province_id',
        'location'
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
     *
     * Maintain model table.
     * Search table by $name if not found insert new record.
     * Return id or model instance depend on mode.
     *
     * @param   array  $data
     * @param   string  $key
     * @param   string  $mode
     * @return  int|Illuminate\Database\Eloquent\Model
     *
     */
    public static function foundOrNew(array $data, $mode = 'id')
    {

        // find postcode by location. if found return by mode.
        $model = static::where('postcode', $data['postcode'])
                                ->where('location', 'like', '%' . $data['key_location'] . '%')
                                ->first();
        if (!$model) {
            // if not found insert record.
            $locationParts = explode(' ', $data['location']);
            $data['province_id'] = (count($locationParts) < 3) ? 0 : Province::foundOrNew(['name' => $locationParts[2]], 'name');
            $model = static::insert($data);
        }
        return $mode == 'id' ? $model->id : $model;
    }
}
