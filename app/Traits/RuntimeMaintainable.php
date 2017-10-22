<?php

namespace App\Traits;

trait RuntimeMaintainable
{
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
    public static function foundOrNew(array $data, $key, $mode = 'id')
    {
        // search table by name.
        $model = static::where($key, $data[$key])->first();
        if (!$model) {
            // if not found insert record.
            $model = static::insert($data);
        }
        return $mode == 'id' ? $model->id : $model;
    }
}
