<?php

namespace App\Models\Lists;

use App\Contracts\AutoId;
use App\Traits\AutoIdInsertable;
use App\Traits\DataImportable;
use Illuminate\Database\Eloquent\Model;

class NoteType extends Model implements AutoId
{
    use AutoIdInsertable, DataImportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'division_id',
        'name',
        'class', // admission/discharge/service.
        'resource_name',
        'view_path',
        'gender', // 0 => female only/ 1 => male only/ 2 => all gender.
        'table_name',
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
}
